<?php

namespace App\Exceptions;

use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    //dato no existete validacion handler
    public function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'response'=>('Los Datos proporcionados no son válidos.'),
            'errores'=>$exception->errors(),
        ],$exception->status);
    }
    //cuando no se  encuentre el modelo
    public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json(
                [
                    'res'=>false,
                    "error"=>"error registro no encontrado"
            ],400);
        }
        return parent::render($request,$exception);
    }
}
