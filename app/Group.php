<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = ['name'];
    public function  contacts(){
        return $this->hasMany('App\Contact');
    }
}
