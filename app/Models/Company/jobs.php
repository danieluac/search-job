<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\OwnerHelpers;
class jobs extends Model
{
    public function company(){
        return $this->belongsTo(OwnerHelpers::company_type, "company_id");
    }
    public function activity(){
        return $this->belongsTo(OwnerHelpers::activity, "activity_id");
    }
    public function degree(){
        return $this->belongsTo(OwnerHelpers::degrees, "degree_id");
    }
}
