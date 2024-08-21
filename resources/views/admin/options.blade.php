@extends('admin.adminlayout.main')
@section('content')

<div class="admin-content-container">
    <h2 class="admin-heading">Options</h2>
    <span id="response_msg"></span>


    <form  method="post" action="{{route('option.store')}}" class="add-post-form row"  enctype="multipart/form-data">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Site Name</label>
                <input type="text" class="form-control site_name" name="site_name" value="{{$optionData->site_name}}" placeholder="Site Name"/>
                <input type="hidden" class="option_id" value="{{$optionData->s_no}}">
                <span class="name_err"></span>
            </div>
            <div class="form-group">
                <label for="">Site Title</label>
                <input type="text" class="form-control site_title" name="site_title" value="{{$optionData->site_title}}" placeholder="Site Title"/>
                <span class="title_err"></span>
            </div>
            <div class="form-group">
                <label>Site Description</label>
                <textarea name="site_desc" class="form-control site_desc" cols="30" rows="3">{{$optionData->site_desc}}</textarea>
            </div>
            <div class="form-group">
                <label>Contact Email</label>
                <input type="email" class="form-control email" name="contact_email" value="{{$optionData->contact_email}}">
            </div>
            <div class="form-group">
                <label>Contact Phone Number</label>
                <input type="text" class="form-control phone" name="contact_phone" value="{{$optionData->contact_phone}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Site Logo</label>
                <input type="file" class="new_logo image" name="new_logo" />
                <input type="hidden" class="old_logo image" name="old_logo" value="{{$optionData->site_logo}}">
                <img id="image" src="{{asset('images/Sitelogo/'.$optionData->site_logo)}}" alt="" width="100px"/>
            </div>
            <div class="form-group">
                <label for="">Footer Text</label>
                <input type="text" class="form-control footer_text" name="footer_text" value="{{$optionData->footer_text}}">
            </div>
            <div class="form-group">
                <label>Currency Format</label>
                <input type="text" class="form-control currency" name="currency_format" value="{{$optionData->currency_format}}">
            </div>
            <div class="form-group">
                <label>Contact Address</label>
                <textarea name="contact_address" class="form-control address" cols="30" rows="3">{{$optionData->contact_address}}</textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <input type="submit" class="btn add-new" name="submit" value="Update">
            </div>
        </div>
    </form>






</div>
<script src="{{asset('adminasset/js/jquery.js')}}"></script>
<script>
    //csrf Token
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    //Add Options
    // $(document).ready(function(){
    //     $('#Create_Options').on('submit',function(event){
    //         event.preventDefault();
    //         //alert('hello');
    //         var option_id = $('.option_id').val();
    //         var site_name = $('.site_name').val();
    //         var site_title = $('.site_title').val();
    //         var site_desc = $('.site_desc').val();
    //         var email = $('.email').val();
    //         var phone = $('.phone').val();
    //         var new_logo = $('.new_logo').val();
    //         var old_logo = $('.old_logo').val();
    //         var footer_text = $('.footer_text').val();
    //         var currency = $('.currency').val();
    //         var address = $('.address').val();


    //         var formdata = new FormData(this);
    //         formdata.append('create',1);
    //         if(site_title!='' && site_desc!=''){
    //             $.ajax({
    //                 type:"POST",
    //                 url: "{{ route('option.store') }}",
    //                 data   : formdata,//{
    //                     // option_id : option_id,
    //                     // site_name : site_name,
    //                     // site_title : site_title,
    //                     // site_desc : site_desc,
    //                     // email : email,
    //                     // phone : phone,
    //                     // new_logo : new_logo,
    //                     // old_logo : old_logo,
    //                     // footer_text : footer_text,
    //                     // currency : currency,
    //                     // address : address
    //                 //},
    //                 processData: false,
    //                 contentType: false,
    //                 dataType: 'json',
    //                 success: function (response) {
    //                     //console.log(response)
    //                    // return false;
    //                     $('.site_name').val('');
    //                     $('.site_title').val('');
    //                     $('.site_desc').val('');
    //                     $('.email').val('');
    //                     $('.phone').val('');
    //                     $('.new_logo').val('');
    //                     $('.footer_text').val('');
    //                     $('.currency').val('');
    //                     $('.address').val('');

    //                     if(response.message){
    //                         $('#response_msg').html('<div class="alert alert-success">'+response.message+'</div>');

    //                         setTimeout(function(){ window.location.href=response.redirect_url; }, 1000);

    //                     }
    //                 },


    //             });
    //         }

    //     });
    // });


    //update Option
    // $(document).ready(function(){
    //     $('#Create_Option').on('submit',function(event){
    //         event.preventDefault();
    //         //alert('hello');
    //         var site_title = $('.site_title').val();
    //         var site_desc = $('.site_desc').val();
    //         var email = $('.email').val();
    //         var phone = $('.phone').val();
    //         var new_logo = $('.new_logo').val();
    //         var old_logo = $('.old_logo').val();
    //         var footer_text = $('.footer_text').val();
    //         var currency = $('.currency').val();
    //         var address = $('.address').val();
    //         if(new_logo!='')
    //         {
    //             var site_logo = new_logo;
    //         }
    //         else{
    //             var site_logo = old_logo;
    //         }

    //         if(brand_name!='' && brand_category!=''){
    //             $.ajax({
    //                 type:"PUT",
    //                 url: "{{ route('option.update') }}",
    //                 data: {
    //                     site_title:site_title,
    //                     site_desc:site_desc,
    //                     email:email,
    //                     phone:phone,
    //                     site_logo:site_logo,
    //                     footer_text:footer_text,
    //                     currency:currency,
    //                     address:address,
    //                 },
    //                 success: function (response) {
    //                     console.log(response)
    //                     //return false;
    //                     $('.site_title').val('');
    //                     $('.site_desc').val('');
    //                     $('.email').val('');
    //                     $('.phone').val('');
    //                     $('.new_logo').val('');
    //                     $('.footer_text').val('');
    //                     $('.currency').val('');
    //                     $('.address').val('');
    //                      if(response.message){
    //                         $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>');
    //                      }
    //                      window.location.href=response.redirect_url;
    //                     // return false;
    //                 },
    //                 error : function(error){
    //                     console.log(error)
    //                     //return false;
    //                     console.ReadKey(true)
    //                     $('#response_msg').html('<div class=" alert alert-danger">'+error+'</div>');
    //                 }
    //             });
    //         }

    //     });
    // });


</script>
@endsection
