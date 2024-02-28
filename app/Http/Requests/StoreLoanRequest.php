<?php

namespace App\Http\Requests;

use App\Models\BookLoan;
use App\Traits\Tables;
use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
        $status_list = implode(",", BookLoan::LOAN_STATUSES);
        $users_rule = 'exists:'. $this->usersTable() .',id';
        $books_rule = 'exists:'. $this->booksTable() .',id';
        return [
            'user_id' => 'required|integer|'.$users_rule,
            'book_id'=> 'required|integer|'.$books_rule,
            'loan_status' => 'nullable|in:'.$status_list,
            'loan_date' => 'nullable|date|after:1970-01-01',
            'due_date' => 'required|date|after:1970-01-01',
            'added_by' => 'required|integer|'.$users_rule,
        ];
    }
}
