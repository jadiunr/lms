<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BbsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'bbs/store') {
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
            'comment' => 'required|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => '本文が未入力です。',
            'comment.max' => '本文は最大1000文字まで入力できます。'
        ];
    }
}
