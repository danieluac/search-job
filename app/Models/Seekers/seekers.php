<?php

namespace App\Models\Seekers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seekers\expiriences;
use App\Models\Seekers\qualifications;
use App\Models\Seekers\skills;
use App\User;
class seekers extends Model
{
    protected $fillable = ["email"];
    //
    public function expirience(){
        return $this->hasMany(expiriences::class,'seeker_id');
    }
    public function qualification(){
        return $this->hasMany(qualifications::class,'seeker_id');
    }
    public function skill(){
        return $this->hasMany(skills::class,'seeker_id');
    }
    public function user(){
        return $this->morphMany(User::class,"owner");
    }
}
