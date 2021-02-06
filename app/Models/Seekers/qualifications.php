<?php

namespace App\Models\Seekers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seekers\degrees;
use App\Helpers\OwnerHelpers;

class qualifications extends Model
{
    //
    public function degree(){
        return $this->belongsTo(degrees::class,"degree_id");
    }
    public function activity(){
        return $this->belongsTo(OwnerHelpers::activity, "activity_id");
    }
}
