<?php

namespace App\Traits\Views;

trait WithViewTypes
{
    public $view;

    public function queryStringWithViewTypes()
    {
        return [
            'view' => ['except' => $this->defaultView()],
        ];
    }

    public function mountWithViewTypes()
    {
        if ($this->view)
        {
            if (!in_array($this->view, $this->validViewValues))
            {
                $this->resetView();
            }
        }
        else if (!$this->view)
        {
            $this->resetView();
        }
    }

    /**
     * Get default view value
     * 
     * @return string
     */
    public function defaultView()
    {
        return $this->defaultValue['view'] ?? '';
    }

    /**
     * Reset the view to his default value
     */
    public function resetView()
    {
        $this->view = $this->defaultView();
    }

    /**
     * Change current view
     */
    public function view($type)
    {
        if (in_array($type, $this->validViewValues))
        {
            $this->view = $type;
        }
    }
    
    /**
     * Check if the view passed is the current view
     * 
     * @param string $type
     * @param mixed $returnValue
     */
    public function viewIs($type, $returnValue = true)
    {
        if ($this->view == $type) 
        {
            return $returnValue;
        }
    }
}
