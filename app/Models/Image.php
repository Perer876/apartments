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

    public static function fromFile($file, $path = null, $options = [])
    {
        $image = new Image();

        $image->file_name = $file->getClientOriginalName();
        $image->file_extension = $file->extension();
        $image->file_path = $file->store($path, $options);

        return $image;
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
