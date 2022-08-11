<?php

namespace App\Rules;

use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;
use App\Models\Contract;

class ApartmentAvailable implements Rule, DataAwareRule
{
    protected $start_var_name, $end_var_name, $apartment_var_name;
    protected $start_date, $end_date, $apartment_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start_var_name, $end_var_name, $apartment_var_name = "apartment_id")
    {
        $this->start_var_name = $start_var_name;
        $this->end_var_name = $end_var_name;
        $this->apartment_var_name = $apartment_var_name;
    }

    /**
     * Extract and return a value from and array with the given key.
     *
     * @param  array  $data
     * @param  string  $key
     * @return mixed
     */
    private function extractFrom($data, $key)
    {
        if(key_exists($key, $data)) {
            return $data[$key];
        }
        else {
            throw new Exception("Can't find the key \"$key\" in the data passed.");
        }
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->start_date = $this->extractFrom($data, $this->start_var_name);
        $this->end_date = $this->extractFrom($data, $this->end_var_name);
        $this->apartment_id = $this->extractFrom($data, $this->apartment_var_name);
        
        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        #dd($this);
        $res = Contract::where("apartment_id", $this->apartment_id)
            ->whereNull("cancelled_at")
            ->whereDate("start_at", "<", $this->end_date)
            ->whereDate("end_at", ">" , $this->start_date)
            ->exists();
            
        return !$res;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans("validation.apartment_available");
    }
}
