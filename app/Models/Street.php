<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;
    protected $table="streets";
    protected $fillable=['name'];

    public function family()
    {
        return $this->hasMany(Family::class);
    }
}
