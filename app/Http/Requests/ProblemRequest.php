<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProblemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'problem_number' => 'required|numeric|max:999',
            'question' => 'required|max:1000',
            'answer1' => 'required|max:100',
            'answer2' => 'required|max:100',
            'answer3' => 'required|max:100',
            'answer4' => 'required|max:100',
            'pic_que' => 'max:100',
            'pic_ans' => 'max:100',
            'explain' => 'max:1000'
        ];
    }
}
