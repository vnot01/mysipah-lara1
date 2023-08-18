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

    public function nasabahs()
    {
        return $this->belongsTo(Nasabah::class, 'nasabahs_id');
    }

    public function namaNasabah()
    {
        return $this->belongsTo(User::class, Nasabah::class);
    }

    public function types()
    {
        return $this->belongsTo(Type::class, 'types_id');
    }

    public function manufactures()
    {
        return $this->belongsTo(Manufacture::class, 'manufactures_id');
    }

    public function inventories()
    {
        return $this->belongsTo(Inventory::class, 'inventories_id');
    }
}
