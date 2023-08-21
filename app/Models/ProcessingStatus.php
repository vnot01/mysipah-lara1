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
    public function processingHasProducts(){
        return $this->hasManyThrough(ProcessingStatus::class,Processing::class,'id','processing_id');
    }

    public function processings(){
        return $this->belongsTo(Processing::class,'processing_id');
    }
    
    // public function processing()
    // {
    //     return $this->belongsToMany(Processing::class, 'processings_id');
    // }
}
