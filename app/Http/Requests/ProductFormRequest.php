<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'category_id'=>['required','integer'],
            'name'=>['required','string'],
            'slug'=>['required','string'],
            'brand'=>['required','string','max:255'],
            'small_description'=>['required','string','max:255'],
            'description'=>['required'],
            'original_price'=>['required','integer'],
            'selling_price'=>['integer'],
            'quantity'=>['required','integer'],
            'trending'=>['required'],
            'status'=>['required'],
            'image'=>['nullable'],
            'meta_title'=>['required','string'],
            'meta_keyword'=>['required','string'],
            'meta_description'=>['required','string']
        ];
    }
}
