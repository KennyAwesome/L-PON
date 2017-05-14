<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\WishlistItem;
use Illuminate\Http\Request;
use Session;

class WishlistItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $wishlistitem = WishlistItem::where('title', 'LIKE', "%$keyword%")
				->orWhere('price', 'LIKE', "%$keyword%")
				->orWhere('image_url', 'LIKE', "%$keyword%")
				->orWhere('product_url', 'LIKE', "%$keyword%")
				->orWhere('user_id', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $wishlistitem = WishlistItem::paginate($perPage);
        }

        return view('admin.wishlist-item.index', compact('wishlistitem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.wishlist-item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        WishlistItem::create($requestData);

        Session::flash('flash_message', 'WishlistItem added!');

        return redirect('admin/wishlist-item');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $wishlistitem = WishlistItem::findOrFail($id);

        return view('admin.wishlist-item.show', compact('wishlistitem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $wishlistitem = WishlistItem::findOrFail($id);

        return view('admin.wishlist-item.edit', compact('wishlistitem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $wishlistitem = WishlistItem::findOrFail($id);
        $wishlistitem->update($requestData);

        Session::flash('flash_message', 'WishlistItem updated!');

        return redirect('admin/wishlist-item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        WishlistItem::destroy($id);

        Session::flash('flash_message', 'WishlistItem deleted!');

        return redirect('admin/wishlist-item');
    }
}
