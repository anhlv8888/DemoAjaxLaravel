<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    public function groups(){
        return $this->belongsTo('App\Group');
    }
}
