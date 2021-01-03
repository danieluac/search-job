<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\OwnerHelpers;
class job_seekers extends Model
{
    public function job(){
        return $this->belongsTo(OwnerHelpers::jobs,'job_id');
    }
    public function seeker(){
        return $this->belongsTo(OwnerHelpers::seeker_type,'seeker_id');
    }
}
