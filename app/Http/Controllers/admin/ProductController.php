<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\subcategory;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo 'fjdfjdfjd';die;
        $Product = new Product;
        $ProductArr = $Product->get();
        $AllProductArr = [];
        foreach($ProductArr as $key=> $Product){
            //$AllProductArr = $ProductArr;
            $CategoryArr = Category::where('cat_id','=',$Product->product_cat)->first();
            $Subcategory = subcategory::where('sub_cat_id','=',$Product->product_sub_cat)->first();
            $Brand       = Brand::where('brand_id','=',$Product->product_brand)->first();
            $AllProductArr[] =[
                'Product' => $Product,
                'Category' =>$CategoryArr,
                'Subcategory' => $Subcategory,
                'Brand' => $Brand
            ];
        }
        //dd($AllProductArr);
        return view('admin.products',compact('AllProductArr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id='';
        $Category = new Category;
        $CatagoryArr = $Category->get();
        return view('admin.add_product',compact('CatagoryArr','id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getsubcategoryandbrand(Request $request)
    {
        $Cat_id = $request->Cat_id;
        $Subcategory = New subcategory;
        $Brand = New Brand;
        $brands = $Brand->where('brand_cat','=',$Cat_id)->get();
        $sub_category = $Subcategory->where('cat_parent','=', $Cat_id)->get();

        $data = ['sub_category'=>$sub_category,'brands'=>$brands];
        return response()->json($data);

    }
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'product_title' =>'required',
            'product_cat' =>'required',
            'product_sub_cat' =>'required',
            'product_desc' =>'required',
            'product_price' =>'required',
            'product_qty' =>'required',
            'product_status' =>'required'
        ]);

        // if($validator->fails()){
        //     return response()->json(['error'=>$validator->errors()]);
        // }

        $Productfield = New Product;

        $Productfield->product_cat = $request->product_cat;
        $Productfield->product_sub_cat = $request->product_sub_cat ;
        $Productfield->product_brand = $request->brand;
        $Productfield->product_title = $request->product_title;
        $Productfield->product_price = $request->product_price;
        $Productfield->product_desc = $request->product_desc;
        $Productfield->qty = $request->product_qty;
        $Productfield->product_keywords = NULL;
        $Productfield->product_views = 0;
        $Productfield->product_status = $request->product_status;

        $product_code = rand(10000,100000);
        $Productfield->product_code = $product_code;

        if($request->hasFile('featured_img')){
            $image_name = time().'.'.$request->featured_img->getClientOriginalExtension();
            //echo $image_name; die;
            //$request->image->move(public_path('/Products'),$image_name);
            $request->featured_img->move(public_path('images/Products'), $image_name);
            $Productfield->featured_image = $image_name;

        }

        $data = ['redirect_url'=>route('product.index'),'message'=>'!!Product Added!!'];
        $Productfield->save();
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
    public function edit($id)
    {
        //dd($id);
        $id = $id;
        $CatagoryArr = Category::get();
        $Product = Product::find($id);
        $SubCategoris = subcategory::get();
        $Brands = Brand::get();
        //dd($Product);
        return view('admin.add_product',compact('Product','CatagoryArr','SubCategoris','Brands','id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

       // dd($request);
        $request->validate([
            'product_title' =>'required',
            'product_cat' =>'required',
            'product_sub_cat' =>'required',
            'product_desc' =>'required',
            'product_price' =>'required',
            'product_qty' =>'required',
            'product_status' =>'required'
        ]);

        $Productfield = Product::find($id);
        $Productfield->product_cat = $request->product_cat;
        $Productfield->product_sub_cat = $request->product_sub_cat ;
        $Productfield->product_brand = $request->brand;
        $Productfield->product_title = $request->product_title;
        $Productfield->product_price = $request->product_price;
        $Productfield->product_desc = $request->product_desc;
        $Productfield->qty = $request->product_qty;
        $Productfield->product_keywords = NULL;
        $Productfield->product_views = 0;
        $Productfield->product_status = $request->product_status;

        // $product_code = rand(10000,100000);
        // $Productfield->product_code = $product_code;

        if($request->hasFile('featured_img')){
            $image_name = time().'.'.$request->featured_img->getClientOriginalExtension();
            $request->featured_img->move(public_path('images/Products'), $image_name);
            $Productfield->featured_image = $image_name;
            //delete old Image
            if($Productfield->featured_image == $request->featured_image){
                $oldImage = public_path('images/Products').$Productfield->featured_image;
                //dd($oldImage);
                unlink($oldImage);
            }
        }

        // $data = ['redirect_url'=>route('product.index'),'message'=>'!!Product Updated!!'];
         $Productfield->save();
        // return response()->json($data);

        return redirect()->route('product.index')->with('Message','Data Updated Successfully!!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $Productdata = Product::findOrFail($request->id);
        $Productdata->delete();
        $data = ['redirect_url'=>route('product.index'),'message'=>'!!Product Deleted!!'];
        return response()->json($data);

    }
}
