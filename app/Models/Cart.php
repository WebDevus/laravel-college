<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'user_id', 'count', 'status', 'reason'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currentStatus()
    {
        return [
            1 => 'Новый',
            2 => 'Подтвержденный',
            3 => 'Отмененный'
        ][$this->status];
    }
}
