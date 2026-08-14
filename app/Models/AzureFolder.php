<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzureFolder extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'is_active'];

    public function uploadedFiles()
    {
        return $this->hasMany(AzureUploadedFile::class);
    }
}
