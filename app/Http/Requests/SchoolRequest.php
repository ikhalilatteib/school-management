<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize(): bool
    {
        if (!$this->user()) {
            return false;
        }
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id'=>$this->user()->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'user_id'=>'required|exists:users,id'
        ];
    }
}
