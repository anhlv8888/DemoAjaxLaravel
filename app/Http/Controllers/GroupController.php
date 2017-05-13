<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class GroupController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:groups'
        ]);
        return Group::create($request->all());

    }
}
