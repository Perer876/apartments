<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Rules\ApartmentAvailable;
use App\Utilities\Helpers;

class StoreContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->validate([
            'start_at' => [
                'required',
                'date_format:Y/m/d',
            ],
            'amount' => [
                'required', 
                'integer', 
                'min:1',
            ],
            'period' => [
                'required', 
                Rule::in(['months', 'years']),
            ],
        ]);

        $this->merge([
            'tenant_id' => $this->route('tenant')->id,
            'user_id' => Auth::id(),
            'end_at' => Helpers::calc_date($this->start_at, $this->amount, $this->period)->format('Y/m/d'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'apartment_id' => [
                'required', 
                'integer', 
                new ApartmentAvailable("start_at", "end_at"),
            ],
            'start_at' => ['required'],
            'end_at' => ['required'],
            'tenant_id' => ['required'],
            'user_id' => ['required'],
            'amount' => ['required'],
            'period' => ['required'],
        ];
    } 
}
