<?php

namespace App\Models\Campaña;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'campaña_id'
    ];

    public function campaña(){
        return $this->belongsTo('App\Models\Campaña\Campaña', 'campaña_id', 'id');
    }

    public function imageable(){
        return $this->morphTo();
    }
}
