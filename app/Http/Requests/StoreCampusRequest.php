<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampusRequest extends FormRequest
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
            'school_id' => $this->route('school'),
            'country_id' => $this->route('country')
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
            'school_id' => 'required|exists:schools,id',
            'country_id' => 'required|exists:countries,id'
        ];

    }
}
