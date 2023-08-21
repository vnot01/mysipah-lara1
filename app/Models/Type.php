<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Type extends Model
{
    use HasFactory, Notifiable,SoftDeletes;
    protected $guarded = [];

    public function processingHasTypes(){
        return $this->hasManyThrough(ProcessingStatus::class,Processing::class,'id','processing_id');
    }
}
