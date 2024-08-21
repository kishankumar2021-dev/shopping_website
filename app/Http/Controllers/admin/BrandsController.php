<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subcategory;
use App\Models\Brand;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Brand = new Brand;
        $Brandarr = $Brand->get();
        $BrandData=[];
        foreach($Brandarr as $Brands){
            $CatregoryArr = New  Category;
            $BrandData[]= [
                'Brand' => $Brands,
                'Category'=> $CatregoryArr->find($Brands->brand_cat)

            ];
        }
        //dd($BrandData['Category']);
        return view('admin.brands',compact('BrandData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand_id ='';
        $Category = new Category;
        $CategoryArr = $Category->get();
        return view('admin.add_brand',compact('CategoryArr','brand_id'));
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
        $request->validate([
            'brand_category' =>'required',
            'brand_name' =>'required',
        ]);
        $Brand = new Brand;
        $Brand->brand_title = $request->brand_name;
        $Brand->brand_cat = $request->brand_category;
        $Brand->save();
        $data = ['redirect_url'=>route('brand.index'),'message'=>'!!Brand Added!!'];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($brand_id)
    {
        $brand_id = $brand_id;
        $Brand = Brand::where('brand_id', $brand_id)->first();
        $CategoryArr = Category::all();
        return view('admin.add_brand',compact('CategoryArr','Brand','brand_id'));
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
        $request->validate([
            'brand_category' =>'required',
            'brand_name' =>'required',
        ]);
        $Brand = Brand::find($request->brand_id);
        $Brand->brand_title = $request->brand_name;
        $Brand->brand_cat = $request->brand_category;
        $Brand->save();
        $data = ['redirect_url'=>route('brand.index'),'message'=>'!!Brand Updated!!'];
        return response()->json($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($brand_id)
    {
        $Brand =  Brand::findOrFail($brand_id);
        $Brand->delete();
        $data = ['redirect_url'=>route('brand.index'),'message'=>'!!Brand Deleted!!'];
        return response()->json($data);

    }
}
