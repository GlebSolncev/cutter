<?php

namespace App\Http\Requests;

use App\Rules\DateTimeCustomHoursRule;
use Illuminate\Foundation\Http\FormRequest;

class CutterRequest extends FormRequest
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
            'link' => [
                'required',
                'max:500',
                'active_url'
            ],
            'limit' => [
                'required',
                'numeric',
            ],
            'life_time' => [
                'after:now',
                'required',
                new DateTimeCustomHoursRule(24)
            ],
        ];
    }
}
