<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required'],
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:500'],
            'category' => ['required'],
            'reward' => ['required', 'numeric', 'min:0'],
            'is_done' => ['nullable', 'boolean'],
            'associated_day' => ['required'],
            'path_icon_todo' => ['required']
        ];
    }
}
