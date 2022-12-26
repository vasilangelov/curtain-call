<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerformanceRequest extends FormRequest
{
    private $maxImageSizeInKilobytes = 3 * 1024;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'required|max:1000',
            'poster' => "nullable|image|max:$this->maxImageSizeInKilobytes"
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $imageSizeInMegabytes = $this->maxImageSizeInKilobytes / 1024;

        return [
            'poster.max' => "The :attribute must not be greater than $imageSizeInMegabytes MB.",
        ];
    }
}
