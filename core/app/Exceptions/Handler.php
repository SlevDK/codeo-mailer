<?php

namespace App\Exceptions;

use App\Exceptions\Api\AlreadyExistException;
use App\Exceptions\Api\ApiBaseException;
use App\Exceptions\Api\AuthenticationException;
use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\ErrorException;
use App\Exceptions\Api\NotFoundException;
use App\Exceptions\Api\UnauthorizedException;
use App\Exceptions\Api\ValidationException;
use Exception;
use Illuminate\Auth\AuthenticationException as AuthentException;
use Illuminate\Auth\Access\AuthorizationException as AuthorizException;
use Illuminate\Validation\ValidationException as ValidateException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        AlreadyExistException::class,
        AuthenticationException::class,
        BadRequestException::class,
        NotFoundException::class,
        UnauthorizedException::class,
        ValidationException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * A list of the regular exceptions, that associated with ApiBaseException
     * ['baseExClass' => 'apiTwinkClass']
     *
     * Ordering matters! Parent must be under child:
     * (n)      NotFoundHttpException
     * (n + 1)  HttpException
     *
     * @var array
     *
     * TODO:
     *      Authentication vs Authorization
     */
    protected $assocExceptionList = [
        AuthentException::class         => AuthenticationException::class,
        AuthorizException::class        => UnauthorizedException::class,
        ModelNotFoundException::class   => NotFoundException::class,
        NotFoundHttpException::class    => NotFoundException::class,
        BadRequestHttpException::class  => BadRequestException::class,
        HttpException::class            => BadRequestException::class,
        MethodNotAllowedException::class => BadRequestException::class,
        ValidateException::class        => ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     * @throws ErrorException
     */
    public function render($request, Exception $exception)
    {
        $e = $exception;

        /** Auth exception response has unique format*/
        if($e instanceof AuthenticationException) {
            return response($e->failAuthMessage, $e->responseHttpCode);
        }



        /** Handle all api-based exceptions */
        if($e instanceof ApiBaseException) {
            return response([
                'code'      => $e->responseErrorCode,
                'message'   => ($e->getMessage())?: $e->standardMessage
            ], $e->responseHttpCode);
        }

        if($request->expectsJson())
            $this->catchNonApiExceptions($e);

        return parent::render($request, $exception);
    }

    /**
     * Catch and convert non ApiBaseException objects
     *
     * @param Exception $exception
     * @throws ErrorException
     */
    protected function catchNonApiExceptions(Exception $exception)
    {
        $e = $exception;

        foreach($this->assocExceptionList as $baseEx => $apiTwinkEx) {
            if($e instanceof $baseEx) {
                throw new $apiTwinkEx($e->getMessage());
            }
        }

        // If exception not in associative list
        throw new ErrorException('Unprocessed error');
    }
}
