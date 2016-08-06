<?php

namespace App\Http\Controllers;

use App\Position;
use App\Shop;

class MapController extends Controller
{
    public function getIndex()
    {
        $shops = Shop::all();
        $positions = Position::all();
        return view('map', compact(['shops', 'positions']));
    }
}
