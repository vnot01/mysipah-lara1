<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processing extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function sources()
    {
        return $this->belongsTo(Source::class, 'sources_id');
    }

    // public function products()
    // {
    //     return $this->belongsTo(Product::class, 'products_id');
    // }

    public function types()
    {
        return $this->belongsTo(Type::class, 'types_id');
    }

    public function manufactures()
    {
        return $this->belongsTo(Manufacture::class, 'manufactures_id');
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'locations_id');
    }
}
