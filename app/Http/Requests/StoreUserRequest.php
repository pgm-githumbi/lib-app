<?php

namespace App\Http\Requests;

use App\Traits\Tables;
use Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    use Tables;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        Log::info("Authorizing user");
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        Log::info("Giving validation rules");
        return [
            'name' => ['required','string','min:2', 'max:255'],
            'email' => ['required', 'email', 
                        'unique:'.$this->usersTable().',email'],
            'password' => ['required','string', 'max:255', 'min:5',
                            'confirmed', Rule::notIn(['name', 'email'])],
            //
        ];
    }
}
