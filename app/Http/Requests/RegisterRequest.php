<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:60',
            'email' => 'required|email|min:3|max:60',
            'role' => 'required|in:sales,buyer',
            'password' => 'required|min:3|max:60',
            'phone' => 'required|integer|digits:11',
            'address' => 'required|min:6|max:250',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'İsim Alanı Zorunludur',
            'name.string' => 'İsim Alanı Sayı ve Özel Karakter İçermez',
            'name.min' => 'İsim Alanı en az 3 harften oluşmalıdır.',
            'name.max' => 'İsim Alanı en fazla 60 harften oluşmalıdır.',
            'email.required' => 'Email Alanı Zorunludur',
            'email.email' => 'Email Alanına Uygun Giriniz',
            'email.min' => 'Email Alanı en az 3 harften oluşmalıdır.',
            'email.max' => 'Email Alanı en fazla 60 harften oluşmalıdır.',
            'role.required' => 'Rol Alanı Zorunludur',
            'role.in' => 'Role Alanı Satıcı ve Alıcı olarak seçilmelidir',
            'password.min' => 'Şifre Alanı en az 3 harften oluşmalıdır.',
            'password.max' => 'Şifre Alanı en fazla 60 harften oluşmalıdır.',
            'password.required' => 'Şifre Alanı Zorunludur',
            'phone.required' => 'Telefon Alanı Zorunludur',
            'phone.integer' => 'Telefon Alanı Sayı ve Özel Karakter İçermez',
            'phone.digits' => 'Telefon Alanı 11 sayıdan oluşmalıdır.',
            'address.required' => 'Adres Alanı Zorunludur',
            'address.min' => 'Adres Alanı en az 6 harften oluşmalıdır.',
            'address.max' => 'Adres Alanı en fazla 250 harften oluşmalıdır.',
        ];
    }
}
