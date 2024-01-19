<?php

namespace App\Http\Requests;

use App\Rules\AfterLoanDate;
use App\Traits\Tables;
use Illuminate\Foundation\Http\FormRequest;

class PostExtensionRequest extends FormRequest
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
        $loan = "exists:".$this->bookLoansTable().",".$this->loanId;
        $date = ["date", "after:1970-0-0", new AfterLoanDate];
       
        return [
            $this->extensionsPenalty => ["required", 'integer', 
                        "exists:".$this->penaltiesTable().",".$this->penaltiesId],
            $this->extensionsLoan => ['required', $loan],
            $this->extensionsReturnDate => $date,
        ];
    }
}
