<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected  $fillable = [
        'name' , 'email','address' ,'company','phone','group_id','user_id'
    ];

    public function groups(){
        return $this->belongsTo('App\Group');
    }
    // note
    public function users(){
        return $this->belongsTo('App\User');
    }
}
