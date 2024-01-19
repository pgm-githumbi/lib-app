<?php

namespace App\Rules;

use App\Traits\Tables;
use Closure;
use App\Models\BookLoan;
use Illuminate\Contracts\Validation\ValidationRule;

class AfterLoanDate implements ValidationRule
{
    use Tables;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $loanId = request()->input($this->extensionsLoan); 
        $loan = BookLoan::find($loanId);

        // Check if the given date is after the loan_date
        if($loan && $value > $loan->due_date){
            return;
        }
        $fail('Extension date must be after the loan due date');
    }
}
