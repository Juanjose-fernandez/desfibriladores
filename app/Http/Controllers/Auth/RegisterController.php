<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\UserRepo;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $userRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepo $userRepo)
    {
        $this->middleware('guest');
        $this->userRepo=$userRepo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'same:password'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data){
        $user= new User();
        $user->setUsername($data['username']);
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword(bcrypt($data['password']));
        $user->setConfirmationCode(md5(microtime().config('app.key')));
        return $this->userRepo->updateWithoutData($user);

    }

    protected function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);

        if($validator->passes())
        {
            $data = $this->create($input)->toArray();

            $data['token'] = str_random(25);

            $user = User::find($data['id']);
            $user->confirmation_code = $data['token'];
            $user->save();

            Mail::send('mails.confirmation', $data, function ($message) use($data){
               $message->to($data['email']);
               $message->subject('Registration Confirmation');
            });
            return redirect(route('login'))->with('success', Lang::get('auth.email.verification'));
        }
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    public function getConfirmationUser($token)
    {
        $user = User::where('confirmation_code', $token)->first();

        if(!is_null($user))
        {
            $user->setConfirmed(1);
            $user->setConfirmationCode('');
            $user->save();
            return redirect('/login')->with('success', 'Your activation is completed');
        }
        return redirect('/login')->with('error', 'Something went wrong');
    }
}
