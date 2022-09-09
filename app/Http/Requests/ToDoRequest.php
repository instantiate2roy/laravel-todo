<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToDoRequest extends FormRequest
{
    var $titleMaxLength = 150;
    var $descMaxLength = 2000;

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
            'title' => 'required|max:' . $this->titleMaxLength,
            'description' => 'required|max:' . $this->descMaxLength,
            'due_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The Title should not be empty !',
            'description.required' => 'The Description should not be empty !',
            'due_date.required' => 'The Due date should not be empty !',
            'title.max' => 'The title should not be longer than ' . $this->nameMaxLength . ' characters !',
            'description.max' => 'The description should not be longer then ' . $this->emailMaxLength . 'characters !'
        ];
    }
}
