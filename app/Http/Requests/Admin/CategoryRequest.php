<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Category;

class CategoryRequest extends FormRequest
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
            'category_name' => 'required',
            'url' => 'required|regex:/^[\pL\-]+$/u'
        ];
    }

    // custom error messages for validation
    public function messages()
    {
        return [
            'category_name.required' => 'Category Name is required',
            'url.required' => 'Category URL is required',
        ];
    }

    // prepare request before validation
    protected function prepareForValidation()
    {
        if ($this->route('category')) {
            $this->merge([
                'id' => $this->route('category'),
            ]);
        }
    }

    // custom validator logic for checking URL uniqueness
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $categgoryCount = Category::where('url', $this->input('url'));
            if ($this->filled('id')) {
                $categgoryCount->where('id', '!=', $this->input('id'));
            }
            if ($categgoryCount->count() > 0) {
                $validator->errors()->add('url', 'Category already exists!');
            }
        });
    }

    // customize validation failure response
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($validator)
                ->withInput()
        );
    }
}
