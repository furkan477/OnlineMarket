<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|min:6|max:125',
        ];
    }

    public function messages(): array
    {
        return [
            'rating.required' => 'Değerlendirme alanı zorunludur.',
            'rating.integer' => 'Değerlendirme tam sayı olmalıdır.',
            'rating.between' => 'Değerlendirme 1 ile 5 arasında olmalıdır.',
            'comment.required' => 'Yorum alanı zorunludur.',
            'comment.min' => 'Yorum minumum 6 karakterden olmalıdır.',
            'comment.max' => 'Yorum maximum 125 karakterden olmalıdır.',
        ];
    }
}
