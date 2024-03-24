<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    protected $table="families";
//    protected $primaryKey = 'families_id';
    protected $fillable=[
        'name',
        'mother_name',
        'area_id',
        'church_id',
        'district_id',
        'street_id',
        'address_id',
        'address',
        'first_phone',
        'second_phone',
        'status',
        'father_image',
        'mother_image'
    ];
    public function area(){
        return $this->belongsTo(Area::class);
    }
    public function church(){
        return $this->belongsTo(Church::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function street(){
        return $this->belongsTo(Street::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public  function children()
    {
        return $this->hasMany(Child::class);
    }  public  function childreen()
    {
        return $this->hasMany(Child::class);
    }

}
