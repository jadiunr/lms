<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThreadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'bbs/create') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'comment' => 'required|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルが未入力です',
            'title.max' => 'タイトルは最大100文字まで入力できます。',
            'comment.required' => '本文が未入力です',
            'comment.max' => '本文は最大1000文字まで入力できます。'
        ];
    }
}
