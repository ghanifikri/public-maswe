<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'judul' => ['required','string','max:60'],
            'slug' => ['required','string',Rule::unique('posts', 'slug')->ignore($this->post)],
            'description' => ['required'],
            'thumbnail' => ['required'],
            'content' => ['required'],
            'category' => ['required'],
            'status' => ['required']
        ];
    }
}
