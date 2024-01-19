<?php

namespace App\Http\Requests;

use App\Traits\Tables;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    use Tables;
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
        $catTable = $this->categoriesTable();
        $catId = $this->categoryId;
        $catName = $this->categoryName;
        return [
            $this->categoryName => ['required', 'string', 'max:255', 'min:3',
             'unique:'.$catTable.",".$catName],
            $this->categoryCategory => ['nullable', 'integer', 'exists:'.$catTable.','.$catId],
        ];
    }
}
