<?php

namespace App\Exceptions;

use App\Helpers\Api\V1\MakeResponse;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exception\HttpResponseException;

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
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (strpos($request->url(), 'api/v') != false) {
            return $this->responseApiV1($request, $exception);
        }

        return parent::render($request, $exception);
    }


    /**
     * @param $request
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function responseApiV1($request, Exception $exception)
    {
        // api v1 - ValidationException
        if ($exception instanceof ValidationException) {
            $data = MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Fail,
                MakeResponse::Tag => 'errorInParameters',
                MakeResponse::Data => $exception->validator->errors()->toArray()
            ]);
            return response()->json($data, 400);
        }

        if (!$exception instanceof HttpResponseException) {
            $data = MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Error,
                MakeResponse::Tag => 'errorInServer',
                MakeResponse::Data => [
                    'errorFile' => $exception->getFile(),
                    'errorLine' => $exception->getLine(),
                    'errorMessage' => $exception->getMessage()
                ],
            ]);
            return response()->json($data, 500);
        }

        // api v1 - general
        $data = MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Error,
            MakeResponse::Tag => 'errorInServer',
            MakeResponse::Data => [
                'errorFile' => $exception->getFile(),
                'errorLine' => $exception->getLine(),
                'errorMessage' => $exception->getMessage()
            ],
        ]);
        return response()->json($data, 500);

    }


    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
