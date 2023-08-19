<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Inventory extends Model
{
    use HasFactory,SoftDeletes, Notifiable;
    protected $guarded = [];

    public function types()
    {
        return $this->belongsTo(Type::class, 'types_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
