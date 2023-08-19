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
    public function sources()
    {
        return $this->belongsTo(Source::class, 'sources_id');
    }

    public function manufactures()
    {
        return $this->belongsTo(Manufacture::class, 'manufactures_id');
    }

    public function inventories(){
        return $this->hasMany(Processing::class,'inventories_id');
    }
    // public function inventories()
    // {
    //     return $this->belongsTo(Inventory::class, 'inventories_id');
    // }
}
