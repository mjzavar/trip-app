<?php

namespace App\Http\Middleware;

use App\Enums\ResponseType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ApiResponse;
use Inertia\Response as WebResponse;
use function PHPUnit\Framework\matches;

class RenderHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (ApiResponse|WebResponse)  $next
     */
    public function handle(Request $request, Closure $next , string $responseType): ApiResponse|WebResponse
    {

        $response = $next($request);

        throw_if( $response->exception instanceof  \Throwable , $response->exception)   ;

        $responseData  = $response->getData(true) ;

        return match(ResponseType::from($responseType)){
            ResponseType::WEB => inertia(  $this->getViewName()  ,$responseData ) ,
            ResponseType::API => response()->json($responseData)
        };
    }

    private function getViewName()
    {
        return str(
            str(request()->route()->getName())
                ->explode('.')
                ->last()
        )
            ->ucfirst()
            ->toString();
    }
}
