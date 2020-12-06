<?php

namespace App\Models\Seekers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seekers\degrees;

class qualifications extends Model
{
    //
    public function degree(){
        return $this->belongsTo(degrees::class,"degree_id");
    }
}
