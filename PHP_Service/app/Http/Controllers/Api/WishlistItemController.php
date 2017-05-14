<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\WishlistItem;
use Exception;
use Illuminate\Http\Request;

class WishlistItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = $request->get('limit');
        $perPage = empty($perPage) ? 25 : $perPage;

        if (!empty($keyword)) {
            $wishlistItem = WishlistItem::where('title', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('image_url', 'LIKE', "%$keyword%")
                ->orWhere('product_url', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $wishlistItem = WishlistItem::paginate($perPage);
        }

        return $wishlistItem;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {

        $requestData = $request->all();

        return WishlistItem::create($requestData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \App\WishlistItem
     */
    public function show($id)
    {
        $wishlistItem = WishlistItem::findOrFail($id);
        $wishlistItem->user;
        return $wishlistItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int                     $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {

        $requestData = $request->all();

        try {
            $wishlistItem = WishlistItem::findOrFail($id);
            if (empty($wishlistItem)){
                throw new Exception('');
            }
            $wishlistItem->update($requestData);
            return response()->json(['status' => '200']);
        } catch (Exception $e) {
            return response()->json(['status' => '400']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        WishlistItem::destroy($id);

        return response()->json(['status' => '200']);
    }
}
