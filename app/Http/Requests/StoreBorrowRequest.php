<?php

namespace App\Http\Requests;

use App\Traits\Tables;
use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowRequest extends FormRequest
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
        return [
            "user_id" => ["required", "integer", "exists:".$this->usersTable().','.$this->userId],
            "book_id" => ["required", "integer", "exists:".$this->booksTable().','.$this->bookId],
        ];
    }

    public function filter(){
        return [
            "user_id" => ["trim|strip_tags|cast:int"],
            "book_id" => ["trim|strip_tags|cast:int"],
        ];
    }
}
