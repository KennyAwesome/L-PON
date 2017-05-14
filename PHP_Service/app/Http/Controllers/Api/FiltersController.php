<?php

namespace App\Http\Controllers\Api;

use App\Filter;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;

class FiltersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = $request->get('limit');
        $perPage = empty($perPage) ? 25 : $perPage;

        if (!empty($keyword)) {
            $filters = Filter::where('sl_gender', 'LIKE', "%$keyword%")
                ->orWhere('sl_min_price', 'LIKE', "%$keyword%")
                ->orWhere('sl_max_price', 'LIKE', "%$keyword%")
                ->orWhere('sl_color', 'LIKE', "%$keyword%")
                ->orWhere('sl_occasion', 'LIKE', "%$keyword%")
                ->orWhere('sl_style', 'LIKE', "%$keyword%")
                ->orWhere('wg_age', 'LIKE', "%$keyword%")
                ->orWhere('wg_min_price', 'LIKE', "%$keyword%")
                ->orWhere('wg_max_price', 'LIKE', "%$keyword%")
                ->orWhere('wg_date_from', 'LIKE', "%$keyword%")
                ->orWhere('wg_date_to', 'LIKE', "%$keyword%")
                ->orWhere('wg_city_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $filters = Filter::paginate($perPage);
        }

        return $filters;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.filters.create');
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

        Filter::create($requestData);

        return redirect('admin/filters');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $filter = Filter::findOrFail($id);
        $filter->user;

        return $filter;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $filter = Filter::findOrFail($id);

        return $filter;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int                     $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $requestData = $request->all();
        try {
            $filter = Filter::findOrFail($id);
            if (empty($filter)) {
                throw new Exception('');
            }
            $filter->update($requestData);
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Filter::destroy($id);

        return response()->json(['status' => '200']);
    }
}
