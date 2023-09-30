<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToppingRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
        ];
        if ($this->isMethod('post')) {
            $rules['image'] = ['required','image','mimes:jpeg,png,jpg,gif','max:2048'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.max' => 'Name should not exceed 255 characters.',
            'description.required' => 'Description is required.',
            'price.required' => 'Price is required.',
            'price.integer' => 'Price must be an integer.',
            'image.required' => 'Image is required.',
            'image.image' => 'Image must be a valid image file.',
            'image.mimes' => 'Image must be in jpeg, png, jpg, or gif format.',
            'image.max' => 'Image size should not exceed 2MB.',
        ];
    }
}
