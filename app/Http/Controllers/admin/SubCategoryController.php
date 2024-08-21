<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $SubCategories = SubCategory::get();
        $SubCategoryData = [];

        foreach ($SubCategories as $SubCategory) {
            $CategoryName = Category::where('cat_id', $SubCategory->cat_parent)->first();
            $SubCategoryData[] = [
                'subcategory' => $SubCategory,
                'category' => $CategoryName
            ];
        }
        // dd($SubCategoryData); // Uncomment this line if you want to debug

        return view('admin.sub_category', compact('SubCategoryData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_cat_id ='';
        $Category = new Category;
        $CategoryData = $Category->all();;
        return view('admin.add_sub_category',compact('CategoryData','sub_cat_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sub_category' => 'required',
            'parent_cat' =>'required'
        ]);
        $SubCategory = new subcategory;
        $SubCategory->sub_cat_title = $request->sub_category;
        $SubCategory->cat_parent = $request->parent_cat;
        $SubCategory->cat_products = 1;
        $SubCategory->show_in_header =1;
        $SubCategory->show_in_footer =1;
        $SubCategory->save();
        $data = ['redirect_url'=>route('sub-category.index'),'message'=>'Sub-Category Added!!'];

        return response()->json($data);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function header(Request $request)
    {
        $SubCategory = new subcategory;
        $SubCategoryData = $SubCategory->find($request->sub_cat_id);
        //echo $SubCategoryData;die;

        if($SubCategoryData->show_in_header==1)
        {
            $status=0;
        }
        else{
            $status=1;
        }
       // echo $status;die;

        $SubCategoryData->show_in_header = $status;
        $SubCategoryData->save();
        $data = ['redirect_url'=>route('sub-category.index'),'messages'=>'!!status Updated!!'];
        return response()->json($data);

    }

    public function footer(Request $request)
    {
        $SubCategory = new subcategory;
        $SubCategoryData = $SubCategory->find($request->sub_cat_id);
       // dd($SubCategoryData);
        if($SubCategoryData->show_in_footer==1)
        {
            $status=0;
        }
        else{
            $status=1;
        }
        $SubCategoryData->show_in_footer = $status;
        $SubCategoryData->save();
        $data = ['redirect_url'=>route('sub-category.index'),'messages'=>'!!status Updated!!'];
        return response()->json($data);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_cat_id =$id;
        $Category = new Category;
        $CategoryData = $Category->all();;

        $SubCategoryData =  SubCategory::find($id);
        //dd($SubCategoryData);
        return view('admin.add_sub_category',compact('CategoryData','sub_cat_id','SubCategoryData'));

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
            'sub_category' => 'required',
            'parent_cat' =>'required'
        ]);
        $SubCategory =  subcategory::find($request->Sub_cat_id);
        $SubCategory->sub_cat_title = $request->sub_category;
        $SubCategory->cat_parent = $request->parent_cat;
        $SubCategory->save();
        $data = ['redirect_url'=>route('sub-category.index'),'message'=>'Sub-Category Updated!!'];

        return response()->json($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SubCategory =  subcategory::findOrFail($id);
        $SubCategory->delete();
        $data = ['redirect_url'=>route('sub-category.index'),'message'=>'Sub-Category Deleted!!'];
        return response()->json($data);


    }
}
