<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ProcessingStatus extends Model
{
    use HasFactory, Notifiable,SoftDeletes;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
