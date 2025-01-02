<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoresAddRequest extends FormRequest
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
            'category_id' => 'required',
            'name' => 'required|min:3|max:60',
            'description' => 'required|min:10|max:120',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Mağazanın Kategori Alanı Zorunludur.',
            'name.required' => 'Mağazanın İsim Alanı Zorunludur.',
            'name.min' => 'Mağazanın İsim Alanı Minumum 3 Karakter İçermelidir.',
            'name.max' => 'Mağazanın İsim Alanı Maximum 60 Karakter İçermelidir.',
            'description.required' => 'Mağazanın Açıklama Alanı Zorunludur.',
            'description.min' => 'Mağazanın Açıklama Alanı Minumum 10 Karakter İçermelidir.',
            'description.max' => 'Mağazanın Açıklama Alanı Maximum 120 Karakter İçermelidir.',
            'image.required' => 'Bir resim dosyası yüklemeniz gerekiyor.',
            'image.image' => 'Yüklenen dosya bir resim olmalıdır.',
            'image.mimes' => 'Yalnızca jpeg, png, jpg, gif, svg formatları kabul edilir.',
        ];
    }
}
