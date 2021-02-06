<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use App\User;
class companies extends Model
{
    protected $fillable = ["name",'nif','activity_id'];
    public function user(){
        return $this->morphMany(User::class,"owner");
    }
    //
    
}
