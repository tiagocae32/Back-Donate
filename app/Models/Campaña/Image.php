<?php

namespace App\Models\Campaña;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'campania_id'
    ];

    public function campania(){
        return $this->belongsTo('App\Models\Campaña\Campaña', 'campania_id', 'id');
    }
}
