<?php

namespace App\Http\Requests;

use App\Models\Apartment;
use App\Models\Tenant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $this->merge([
            'tenant_id' => $this->route('tenant'),
            'user_id' => Auth::id(),
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
                Rule::in(Apartment::available()->ofCurrentUser()->pluck('id')),
            ],
            'start_at' => ['required', 'after_or_equal:' . today()->format('Y/m/d')],
            'amount' => ['required', 'integer', 'min:1'],
            'period' => [
                'required', 
                Rule::in(['months', 'years'])
            ],
            'tenant_id' => 'required',
            'user_id' => 'required',
        ];
    }
}
