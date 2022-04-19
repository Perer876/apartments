<?php 

namespace App\Traits\Views;

trait WithSorting
{
    /**
     * Recive a column name to sort
     * 
     * @param string $column
     * @return void
     */
    public function sort($column)
    {
        if ($this->sortBy == $column) {
            $this->sortDesc = $this->sortDesc ? false : true;
        } else {
            $this->sortBy = $column;
            $this->sortDesc = false;
            $this->resetPage();
        }
    }

    /**
     * Indicate the current sorting column state and returns the icon name
     * 
     * @param string $column
     * @return string
     */
    public function sortIcon($column)
    {
        if ($this->sortBy == $column) {
            if ($this->sortDesc) {
                return 'bi-sort-alpha-up';
            }
            return 'bi-sort-alpha-down';
        }
        return 'bi-arrow-down-up';
    }
}
