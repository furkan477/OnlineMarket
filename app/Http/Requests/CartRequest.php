<?php

namespace App\Http\Requests;

use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'qty' => 'required|integer|min:1|max:5',
        ];
    }

    public function messages(){
        return [
            'qty.required' => 'Adet Seçiniz !',
            'qty.integer' => 'Adet Bölümünde Sayısal İşlem Yapınız !',
            'qty.min' => 'En Az 1 Adet Seçiniz !',
            'qty.max' => '5 Adet den fazla seçemezsiniz !',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $userId = auth()->id();
            $productId = $this->product_id;
            $qty = $this->qty;

            $currentQuantity = Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->sum('qty');

            if ($currentQuantity + $qty > 5) {
                $validator->errors()->add('qty', 'Bu üründen toplamda en fazla 5 adet alabilirsiniz.');
            }
        });
    }
}
