<?php

namespace App\Traits\Forms;

trait WithValidateChanges
{   
    public $changed = [];
    public $validateAll = false;

    public function updatedWithValidateChanges($propertyName)
    {
        array_push($this->changed, $propertyName);
        $this->validateOnly($propertyName);
    }

    public function showValidate($propertyName)
    {
        return in_array($propertyName, $this->changed) || $this->validateAll;
    }
}
