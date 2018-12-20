<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class SpacesController extends Controller
{
    //
    public function getSpaces(Request $request){

        $v = Validator::make($request->all(), $rules);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
    }
}
