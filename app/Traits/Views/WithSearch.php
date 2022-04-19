<?php

namespace App\Traits\Views;

trait WithSearch
{
    public $search = '';

    protected $queryStringWithSearch = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }
}