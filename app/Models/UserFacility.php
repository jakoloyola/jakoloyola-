<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFacility extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'facility_id',
    ];
    
    
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }  
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }  
}
