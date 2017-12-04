<?php

namespace App\Http\Middleware;

use Closure;

class session_set
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $answers=session()->get('answers',[]);

        if(empty($answers)) {
            for ($i = 0; $i < 80; $i++) {
                $answers[$i] = "-";
            }
        }
        session()->put('answers',$answers);

        $answers_test=session()->get('answers_test',[]);

        if(empty($answers_test)) {
            for ($i = 0; $i < 80; $i++) {
                $answers_test[$i] = "-";
            }
        }
        session()->put('answers_test',$answers_test);
        return $next($request);
    }
}
