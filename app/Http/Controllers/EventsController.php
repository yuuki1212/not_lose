<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class EventsController extends Controller
{
    //
    public function getEvents(Request $request){
        $lat = $request->get("lat");
        $lng = $request->get("lng");
        $range = $request->get("range");
        $category = $request->get("category");
        $limit = $request->get("limit");
        $sort = $request->get("sort");

        $rules = [
            'lat' => 'required',
            'lng' => 'required',
            'range' => 'numeric',
            'category' => 'required|string',
            'limit' => 'required|numeric',
            'sort' => 'required|string'
        ];
        $v = Validator::make($request->all(), $rules);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
    }
}
