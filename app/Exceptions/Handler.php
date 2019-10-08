<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        //\Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if ($this->shouldntReport($exception)) {
            return;
        }


        try {
            $logger = $this->container->make(LoggerInterface::class);
        } catch (Exception $ex) {
            throw $exception; // throw the original exception
        }


        $logger->error($exception);

        //if( config('app.env', 'production')=='production'){
        if(false){
            Bugsnag::notifyException($exception);
        }


    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        // handle 403 errors
        if ($exception instanceof HttpException && $exception->getStatusCode() == 403) {
            return redirect('/login');
        }
        if ($exception instanceof TokenMismatchException) {
            return redirect()->back();
        }

        $exception = $this->prepareException($exception);


        if ($exception instanceof HttpResponseException) {

            return $exception->getResponse();
        } elseif ($exception instanceof AuthenticationException) {

            return $this->unauthenticated($request, $exception);
        } elseif ($exception instanceof ValidationException) {

            return $this->convertValidationExceptionToResponse($exception, $request);
        } elseif ($exception instanceof AccessDeniedHttpException){

            return response()->view('errors.' . $exception->getStatusCode(), ['message'=>'Acceso denegado.'], $exception->getStatusCode());
        }


        return $this->prepareResponse($request, $exception);

    }


    protected function prepareResponse($request, Exception $e)
    {
        if ($this->isHttpException($e)) {
            return $this->toIlluminateResponse($this->renderHttpException($e), $e);
        } else {

            if(config('app.env', 'production')=='production'){
                $response=$this->convertExceptionToResponse($e);
                $status = $response->getStatusCode();
                $formatted_exception=$response->getContent();
                dd($formatted_exception);
                return \View::make('errors.500',compact('formatted_exception'));

            }
            return $this->toIlluminateResponse($this->convertExceptionToResponse($e), $e);
        }
    }



    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }

    protected function renderHttpException(HttpException $e)
    {
        $status = $e->getStatusCode();
        view()->replaceNamespace('errors', [
            resource_path('views/errors'),
            __DIR__.'/views',
        ]);

        if (view()->exists("errors::{$status}") && config('app.env', 'production')=='production') {
            $formatted_exception=$this->convertExceptionToResponse($e);
            return response()->view("errors::{$status}", ['exception' => $e,'formatted_exception' =>$formatted_exception], $status, $e->getHeaders());
        } else {
            return $this->convertExceptionToResponse($e);
        }
    }
}
