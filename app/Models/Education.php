<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table="education";
    protected $fillable=[
        'name'
    ];

    public  function childreen()
    {
        return $this->hasMany(Child::class);
    }
    public  function children()
    {
        return $this->hasMany(Child::class);
    }
}
