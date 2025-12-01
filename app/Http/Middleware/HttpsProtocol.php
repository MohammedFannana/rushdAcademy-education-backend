<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Manager\CommonFunctionTrait;
use Closure;
use Illuminate\Http\Request;

class HttpsProtocol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    use CommonFunctionTrait;

    public function handle(Request $request, Closure $next)
    {
        if($request->get('token')){
            $token = $request->get('token');

         //   $this->decodeKey($token);

          //  try{
                if(!$this->decodeKey($token)){

                    abort(404);
                }

          /* } catch (\Throwable $e) {
               return redirect()->route('home');
           }*/

        }

        if (env('FORCE_HTTPS') == "On" && !$request->secure()) {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
