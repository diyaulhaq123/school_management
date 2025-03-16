<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonPlanRequest extends FormRequest
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
            'staff_id' => 'required|integer',
            'session_id' => 'required|integer',
            'term_id' => 'required|integer',
            'date' => 'required|date|date_format:Y-m-d',
            'class_id' => 'required|integer',
            'no_in_class' => 'required|integer',
            'average_age' => 'nullable|integer',
            'subject_id' => 'required|integer',
            'topic' => 'required',
            'sub_topic' => 'required',
            'time_from' => 'nullable|date_format:H:i',
            'time_to' => 'nullable|date_format:H:i',
            'duration' => 'required|string',
            'objective' => 'required',
            'mode_1' => 'required|integer',
            'teachers_activity_1' =>  'required',
            'student_activity_1' => 'required',
            'mode_2' => 'required|integer',
            'teachers_activity_2' =>  'required',
            'student_activity_2' => 'required',
            'mode_3' => 'required|integer',
            'teachers_activity_3' =>  'required',
            'student_activity_3' => 'required',
            'mode_4' => 'required|integer',
            'teachers_activity_4' =>  'required',
            'student_activity_4' => 'required',
            'mode_5' => 'required|integer',
            'teachers_activity_5' =>  'required',
            'student_activity_5' => 'required',
        ];
    }

    public function messages(){
        return [
            'time_from.required' => 'The time from field is required.',
            'time_from.date_format' => 'The time from must be in the format HH:MM.',
            'time_to.required' => 'The time to field is required.',
            'time_to.date_format' => 'The time to must be in the format HH:MM.',
            'date.required' => 'The date field is required.',
            'date.date_format' => 'The date must be in the format YYYY-MM-DD.',
        ];
    }


}
