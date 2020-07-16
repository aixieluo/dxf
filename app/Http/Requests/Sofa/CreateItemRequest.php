<?php

namespace App\Http\Requests\Sofa;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemRequest extends FormRequest
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
            'name' => 'required',
            'uid' => 'required',
            'color' => 'required',
            'fid' => 'required',
            'price' => 'required',
            'preview' => 'required',
        ];
    }
}
