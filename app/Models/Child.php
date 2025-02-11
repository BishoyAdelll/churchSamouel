<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $table='children';
    protected $fillable=[
        'family_id',
        'name',
        'education_id',
    ];
    public function family(){
        return $this->belongsTo(Family::class);
    }
    public function education(){
        return $this->belongsTo(Education::class);
    }
}
