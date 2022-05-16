<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $fillable = [
        'file_name',
        'file_extension',
        'file_path',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
