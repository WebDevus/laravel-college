<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'desc',
        'image',
        'year',
        'country',
        'price',
        'count'
    ];

    public function scopeName($query, $name)
    {
        if (!is_null($name)) {
            return $query->where('name', 'like', '%'.$name.'%');
        }

        return $query;
    }

    public function scopeYear($query, $year)
    {
        if (!is_null($year)) {
            return $query->where('year', $year);
        }

        return $query;
    }

    public function scopeCategory($query, $category)
    {
        if (!is_null($category)) {
            return $query->where('category_id', $category);
        }

        return $query;
    }
}
