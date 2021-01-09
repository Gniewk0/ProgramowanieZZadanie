<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use App\Models\ProductList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ProductList::with('listitem')->where('user_id', '=', Auth::user()->id)->where('pending', '=', 1)->get();
    }

    public function archiveindex(Request $request)
    {
        return ProductList::with('listitem')->where('user_id', '=', Auth::user()->id)->where('pending', '=', 0)->get();
    }

    public function search(Request $request)
    {
        return ProductList::with('listitem')->where('user_id', '=', Auth::user()->id)->where('pending', '=', 1)->where('name', 'like', $request->data.'%')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $list = new ProductList;
        $list->user_id = $user_id;
        $list->name = $request->name;
        $list->date = $request->date;
        $list->pending = 1;
        $list->save();

        $list_id = $list->id;

        for($i=0;$i<count($request->list);$i++){
            $item = new ListItem;
            $item->product_list_id = $list_id;
            $item->product_name = $request->list[$i];
            $item->save();
        }

        return ['message' => 'list created'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductList  $productList
     * @return \Illuminate\Http\Response
     */
    public function show(ProductList $productList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductList  $productList
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductList $productList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductList  $productList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        ProductList::where('id', '=',  $request->id)->delete();

        $user_id = Auth::user()->id;

        $list = new ProductList;
        $list->user_id = $user_id;
        $list->name = $request->name;
        $list->date = $request->date;
        $list->pending = 1;
        $list->save();

        $list_id = $list->id;

        for($i=0;$i<count($request->list);$i++){
            $item = new ListItem;
            $item->product_list_id = $list_id;
            $item->product_name = $request->list[$i];
            $item->save();
        }

        return ['message' => 'list created'];
    }

    public function archiveupdate(Request $request)
    {
        ProductList::where('id', '=',  $request->id)->update([
            'pending' => 0,
        ]);
        return[ 'mesage' => 'list was added to archives'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductList  $productList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ProductList::where('id', '=',  $request->id)->delete();

        return[ 'mesage' => 'list was deleted'];
    }
}
