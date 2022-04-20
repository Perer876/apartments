<?php 

namespace App\Traits\Views;

trait WithSorting
{
    public $sortBy;
    public $sortDesc;

    public function queryStringWithSorting()
    {
        return [
            'sortBy' => ['except' => $this->defaultSortBy()],
            'sortDesc' => ['except' => $this->defaultSortDesc()],
        ];
    }

    public function mountWithSorting()
    {
        if ($this->sortBy)
        {
            if (!in_array($this->sortBy, $this->validSortByValues))
            {
                $this->sortBy = $this->defaultSortBy();
            }
        }
        else if (!$this->sortBy)
        {
            $this->sortBy = $this->defaultSortBy();
        }
    }

    /**
     * Get default value sort by column
     * 
     * @return string
     */
    public function defaultSortBy()
    {
        return $this->defaultValue['sortBy'] ?? 'id';
    }

    /**
     * Get default value for sort descending
     * 
     * @return boolean
     */
    public function defaultSortDesc()
    {
        return $this->defaultValue['sortDesc'] ?? false;
    }

    /**
     * Change sort direcction from current state
     */
    public function swapSortDirection()
    {
        $this->sortDesc = $this->sortDesc ? false : true;
    }

    /**
     * Get the actual sorting direccion 
     * 
     * @return string
     */
    public function sortDirection()
    {
        return $this->sortDesc ? 'desc' : 'asc';
    }

    /**
     * Recive a column name to sort
     * 
     * @param string $column
     * @return void
     */
    public function sort($column)
    {
        if ($this->sortBy == $column) {
            $this->swapSortDirection();
        } else {
            if (in_array($column, $this->validSortByValues))
            {
                $this->sortBy = $column;
                $this->sortDesc = $this->defaultSortDesc();
                $this->resetPage();
            }
        }
    }

    /**
     * Indicate the current sorting column state and returns the icon name
     * 
     * @param string $column
     * @return string
     */
    public function sortIcon($column = null)
    {
        if ($this->sortBy == $column || !$column) {
            if ($this->sortDesc) {
                return 'bi-sort-alpha-up';
            }
            return 'bi-sort-alpha-down';
        }
        return 'bi-arrow-down-up';
    }

    /**
     * Reset sorting propieties to their default value
     */
    public function resetSort()
    {
        $this->sortBy = $this->defaultSortBy();
        $this->sortDesc = $this->defaultSortDesc();
    }
}
