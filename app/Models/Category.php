<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApiModel;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['category_name', 'category_image'];

    function apiModel(){
        return $this->hasMany(ApiModel::class, 'category_id', 'id');
    }
}
