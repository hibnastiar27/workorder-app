<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            function ($app) {
                return new class($app) extends \Illuminate\Foundation\Exceptions\Handler {
                    public function render($request, \Throwable $e)
                    {
                        if ($request->is('api/*') || $request->expectsJson()) {
                            $status = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

                            return response()->json([
                                'message' => $e->getMessage(),
                                'status' => $status
                            ], $status);
                        }

                        return parent::render($request, $e);
                    }
                };
            }
        );
    }
}
