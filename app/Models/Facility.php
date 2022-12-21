<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip',
        'contact',
    ];
    
    public function user_facilities()
    {
        return $this->hasMany(UserFacility::class);
    }  
}
