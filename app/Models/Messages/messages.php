<?php

namespace App\Models\Messages;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\OwnerHelpers;
class messages extends Model
{
    public function sent_from(){
        return $this->belongsTo(OwnerHelpers::user,"from");
    }
    public function sent_to(){
        return $this->belongsTo(OwnerHelpers::user,"to");
    }
}
