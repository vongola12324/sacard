<?php

namespace App\Http\Controllers;

use App\Position;
use App\Shop;
use Carbon\Carbon;
use App\Services\LocationService;
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
        $shops = Shop::with('positions')->paginate();

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
            'name' => 'required|unique:shops,name',
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
            'name' => 'required|unique:shops,name,' . $shop->id . ',id',
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePosition(Request $request, Shop $shop)
    {
        // Error Collection
        $errorCounter = 0;
        $errorPosition = '';

        // Delete all position belongsTo $shop
        Position::where('shop_id', $shop->id)->delete();

        // Add all position to $shop
        $keys = array_keys($request->get('address'));
        foreach ($keys as $key) {
            // Check address is not null
            if ($request->get('address')[$key]) {
                $location = LocationService::getLocation($request->get('address')[$key]);
                // Check get location
                if (count($location)) {
                    Position::create([
                        'shop_id'     => $shop->id,
                        'description' => $request->get('description')[$key],
                        'address'     => $request->get('address')[$key],
                        'longitude'   => $location[0],
                        'latitude'    => $location[1],
                    ]);
                } else {
                    $errorCounter++;
                    $errorPosition = $errorPosition . $request->get('description') . '<br/>';
                }
            }
        }
        if ($errorCounter > 0) {
            return redirect()->route('shop.show', $shop)->with('warning', '以下商店位置更新失敗，請稍後再試<br/>' . $errorPosition);
        } else {
            return redirect()->route('shop.show', $shop)->with('global', '商店位置已更新');
        }
    }
}
