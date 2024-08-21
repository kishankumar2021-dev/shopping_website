<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Category = new Category;
        $CategoryData = $Category->all();
        // echo '<pre>';
        // print_r($CategoryData);
        // die;
        return view('admin.category',compact('CategoryData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = '';
        return view('admin.add_category',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        // echo '<pre>';
        // print_r($request);
        // echo '</pre>';
        // die;
        $request->validate([
            'Category' => 'required|unique:categories,cat_title',
        ]);
        $Category = new Category;
        $Category->cat_title = $request->Category;
        $Category->products = 0;
        $Category->save();
        $data = ['message'=>'Category Created Successfully!!','redirect_url'=>route('category.index')];
        return response()->json($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cat_id)
    {
        //dd($cat_id);
        $Category = new Category;
        $CategoryData = $Category->find($cat_id);
        //dd($CategoryData);
        $id = $cat_id;
        return view('admin.add_category',compact('CategoryData','id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $CategoryColumn = Category::find($request->cat_id);
        // Ensure $CategoryColumn exists before attempting to update
        if ($CategoryColumn) {
            $CategoryColumn->cat_title = $request->Category;
            $CategoryColumn->save();
            $data = ['message' => 'Category Updated Successfully!!', 'redirect_url' => route('category.index')];
            return response()->json($data);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Category = Category::find($request->cat_id);
        $Category->delete();
        $data = ['message'=>'Category Deleted Successfully!!','redirect_url'=> route('category.index')];
        return response()->json($data);
    }
}
