<?php

namespace App\Http\Controllers;

use App\Position;
use App\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();

        return view('shop.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.create-or-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:shops,name'
        ]);

        $shop = Shop::create([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
            'url'         => $request->get('url'),
            'tel'         => $request->get('tel'),
            'open_at'     => Carbon::createFromFormat('H:i', $request->get('open_at')),
            'close_at'    => Carbon::createFromFormat('H:i', $request->get('close_at')),
        ]);

        return redirect()->route('shop.index')->with('global', '商店已建立');

    }

    /**
     * Display the specified resource.
     *
     * @param Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return view('shop.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view('shop.create-or-edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $this->validate($request, [
            'name' => 'required|unique:shops,name,' . $shop->id . ',id'
        ]);

        $shop->update([
            'name'        => $request->get('name'),
            'description' => $request->get('description'),
            'url'         => $request->get('url'),
            'tel'         => $request->get('tel'),
            'open_at'     => Carbon::createFromFormat('H:i', $request->get('open_at')),
            'close_at'    => Carbon::createFromFormat('H:i', $request->get('close_at')),
        ]);

        return redirect()->route('shop.index')->with('global', '商店已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('shop.index')->with('global', '商店已刪除');
    }

    /**
     * Edit the positions of the shop
     *
     * @param Shop $shop
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPosition(Shop $shop)
    {
        return view('shop.edit-position', compact('shop'));
    }

    /**
     * Update positions of the shop
     *
     * @param Request $request
     * @param Shop $shop
     */
    public function updatePosition(Request $request, Shop $shop){

    }
}