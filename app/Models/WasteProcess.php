<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class WasteProcess extends Model
{
    use HasFactory, Notifiable,SoftDeletes;
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

    public function processingStatus(){
        return $this->belongsTo(ProcessingStatus::class,'processings_id');
    }

    public function processingHasProducts(){
        return $this->hasManyThrough(ProcessingStatus::class,Processing::class,'id','processing_id');
    }
}
