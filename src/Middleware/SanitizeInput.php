<?php

namespace LaravelSanitize\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SanitizeInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->all()){
            foreach($request->all() as $key => $requestParamData){
                if (array_key_exists($request->path(), config('sanitize_input.NOT_SANITIZE')) && in_array($key, config('sanitize_input.NOT_SANITIZE')[$request->path()])) {
                    $afterSanitizeData[$key] = $requestParamData;
                    continue;
                }
                $afterSanitizeData[$key] = preg_replace("/([\;\#(\-\-)\:\(\)\=])/", '\\\$1', $requestParamData);
            }

            $request->query->replace($afterSanitizeData);
        }

        return $next($request);
    }
}
