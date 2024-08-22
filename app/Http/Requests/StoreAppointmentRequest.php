<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'frequency' => 'required|string|in:recurring,one-time',
            'start_date' => 'required|date|after_or_equal:today',
            'days' => 'required|array',
            'days.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'time_of_day' => 'required|array',
            'time_of_day.*' => 'in:morning,afternoon,evening',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'frequency.required' => 'The frequency field is required.',
            'start_date.required' => 'The start date field is required.',
            'days.required' => 'Please select at least one day.',
            'days.array' => 'The days field must be an array.',
            'days.*.in' => 'One or more selected days are invalid. Please choose from Monday to Sunday.',
            'time_of_day.required' => 'Please select at least one time of day.',
            'time_of_day.array' => 'The time of day field must be an array.',
            'time_of_day.*.in' => 'One or more selected times of day are invalid. Please choose from morning, afternoon, or evening.',
            'notes.string' => 'The notes field must be a string.',
        ];
    }

     /**
     * Return JSON response the validated fields.
     *
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}
