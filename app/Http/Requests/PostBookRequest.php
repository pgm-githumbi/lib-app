<?php

namespace App\Http\Requests;

use App\Traits\Tables;
use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;
use Intervention\Validation\Rules\Isbn;
use Elegant\Sanitizer\Filters\Enum;


class PostBookRequest extends FormRequest
{
    use Tables, SanitizesInput;

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
            "name"=> "required|string|max:255|min:2",
            "publisher" => "required|string|max:255|min:2",
            "isbn" => ["required", "string", "max:17", "min:10", new Isbn()],
            "description"=> "required|string|max:4096|min:1",
            "image" => "string|max:8092|min:5",
            "category_id" => "required|numeric|exists:" . $this->categoriesTable() . ",id",
        ];
    }

    public function filters(): array{
        $dry_filters = "trim|strip_tags";
        return [
            "name" => $dry_filters."|capitalize",
            "publisher" => $dry_filters,
            "isbn" => $dry_filters,
            "description" => $dry_filters,
            "category_id" =>  $dry_filters."|cast:int",
        ];
    }
}
