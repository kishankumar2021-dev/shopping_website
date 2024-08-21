<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $optionData = Option::orderByDesc('created_at')->first();
        //dd($optionData);
        return view('admin.options',compact('optionData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // dd($request);

       $rules = [
        'site_name'=>'required',
        'site_title'=>'required',
        'site_desc'=>'required',
        'footer_text'=>'required',
        'currency_format'=>'required',
        'option_id'=> 'required'
       ];

       $validator = Validator::make($request->all(), $rules);
       // echo 'A';
      // dd($validator);

       if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);

        }
       // echo 'A';die;

        $options = Option::findOrFail($request->option_id);
        $options->site_name = $request->site_name;
        $options->site_title = $request->site_title;
        $options->site_desc = $request->site_desc;
        $options->footer_text = $request->footer_text;
        $options->currency_format = $request->currency;
        $options->contact_phone = $request->phone;
        $options->contact_email = $request->email;
        $options->contact_address = $request->address;


         if($request->hasFile('new_logo')){

            $image_name = time().'.'.$request->new_logo->getClientOriginalExtension();
            //echo $image_name; die;
            //$request->image->move(public_path('/Products'),$image_name);
            $request->new_logo->move(public_path('images/Sitelogo'), $image_name);
            $options->site_logo = $image_name;

        }

        $options->save();

        $data = ['redirect_url' => route('option.create'), 'message' => '!!!!Option Data Added!!!!'];

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
