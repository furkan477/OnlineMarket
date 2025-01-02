<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'

        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Ürün Kategori Alanı Zorunludur.',
            'name.required' => 'Ürün İsim Alanı Zorunludur.',
            'name.min' => 'Ürün İsim Alanı Minumum 3 Karakter İçermelidir.',
            'name.max' => 'Ürün İsim Alanı Maximum 60 Karakter İçermelidir.',
            'description.required' => 'Ürün Açıklama Alanı Zorunludur.',
            'description.min' => 'Ürün Açıklama Alanı Minumum 10 Karakter İçermelidir.',
            'description.max' => 'Ürün Açıklama Alanı Maximum 120 Karakter İçermelidir.',
            'price.required' => 'Ürün Fiyat Alanı Zorunludur.',
            'price.integer' => 'Ürün Fiyat Alanı Sayılardan Oluşmalıdır.',
            'stock.required' => 'Ürün Stok Alanı Zorunludur.',
            'stock.integer' => 'Ürün Stok Alanı SAyılardan Oluşmalıdır.',
            'image.required' => 'Bir resim dosyası yüklemeniz gerekiyor.',
            'image.image' => 'Yüklenen dosya bir resim olmalıdır.',
            'image.mimes' => 'Yalnızca jpeg, png, jpg, gif, svg formatları kabul edilir.',
        ];
    }
}
