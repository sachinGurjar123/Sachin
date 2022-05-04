<?php

namespace App\Models;

use App\Services\HelperService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
    ];

    public static function getNameAttribute($value)
    {
        return  HelperService::getFileUrl('files/products/', $value);
    }
}
