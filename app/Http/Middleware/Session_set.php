<?php

namespace App\Http\Middleware;

use App\Problem;
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

        $exam_id = $request->route()->parameter('exam_id');
        $block_id = $request->route()->parameter('block_id');

        $problem_count=Problem::where('exam_id',$exam_id)->where('block_id',$block_id)->get()->count();



        if(empty($answers)) {
            for ($i = 0; $i < $problem_count; $i++) {
                $answers[$i] = "-";
            }
        }
        session()->put('answers',$answers);

        $answers_test=session()->get('answers_test',[]);

        if(empty($answers_test)) {
            for ($i = 0; $i < $problem_count; $i++) {
                $answers_test[$i] = "-";
            }
        }
        session()->put('answers_test',$answers_test);
        return $next($request);
    }
}
