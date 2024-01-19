<?php

namespace App\Http\Requests;

use App\Traits\Tables;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePenaltyRequest extends FormRequest
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
            $this->penaltiesAmount => 'required|numeric|integer|min:0',
            $this->penaltiesLoan => 'required|integer|min:0|exists:'.$this->bookLoansTable().','.$this->loanId,
            $this->penaltiesAmountPaid => 'required|numeric|integer|lte:penalty_amount_ksh',
        ];
    }
}
