<?php

namespace App\Exceptions;

use Psr\Log\LoggerInterface;
use Exception;
use Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
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
        //parent::report($exception);
        if ($this->shouldntReport($exception)) {
            return;
        }

        try {
            $logger = $this->container->make(LoggerInterface::class);

        } catch (Exception $ex) {
            throw $exception; // throw the original exception
        }

        app('sentry')->captureException($exception);
        
        $logger->error($exception);
        if ($exception instanceof Exception && env('APP_DEBUG') !== true) {
            //dd(session());
            $lines = explode("\n", $exception->getMessage());

            $destinataires = explode(',', env('EXCEPTIONS_MAILTO'));

            foreach ($destinataires as $destinataire)
            {
                mail($destinataire, env('EXCEPTIONS_SUBJECT') . ' ' .  substr($lines[0],0,255), '
USER : ' . ((Auth::user()) ? Auth::user()->username : '-') . '
URL : ' . ((isset($_SERVER['SCRIPT_URI'])) ? $_SERVER['SCRIPT_URI'] : '') . '
EXCEPTION:
' . substr(print_r($exception->getMessage(),1),0,8192) . '

---------------------------------------
STACK TRACE :
' . $exception->getTraceAsString() . '

---------------------------------------
CONTEXT :
' . print_r($_SERVER,1));
            }
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
        return parent::render($request, $exception);
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
        $login = (minimum_version('0.9.2')) ? 'prehome' : 'login';
    
        return redirect()->guest($login);
    }
}
