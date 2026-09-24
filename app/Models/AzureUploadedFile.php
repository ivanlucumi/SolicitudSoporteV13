<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzureUploadedFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'azure_folder_id',
        'file_path',
        'file_hash',
        'uploaded_at'
    ];

    public function folder()
    {
        return $this->belongsTo(AzureFolder::class, 'azure_folder_id');
    }
}
