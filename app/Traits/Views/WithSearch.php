<?php

namespace App\Traits\Views;

trait WithSearch
{
    public $search = '';

    protected $queryStringWithSearch = [
        'search' => ['except' => ''],
    ];

    public function keyWords()
    {
        return preg_split("/[\s,]+/", $this->search);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}