@extends('admin.adminlayout.main')
@section('content')

    <div class="admin-content-container">
        <h2 class="admin-heading">@if($id!='' && $id>0)Edit @else Add New @endif  Product</h2>
            @if($id!='' && $id>0)
                <form  action="{{route('product.update',['id'=>$id])}}" method="POST" class="add-post-form row"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="">Product Title</label>
                            <input type="hidden" id="edit_id" name="edit_id" class="edit_id" value="{{$id}}">
                            <input type="text" class="form-control product_title" value="{{$Product->product_title}}" name="product_title" placeholder="Product Title" requried/>
                        </div>
                        <div class="form-group category">
                            <label for="">Product Category</label>
                            <select class="form-control productcategory" name="product_cat">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($CatagoryArr as $Catagory)
                                    <option @if($Product->product_cat == $Catagory->cat_id) selected  @else  @endif   value="{{$Catagory->cat_id}}">{{$Catagory->cat_title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group sub_category">
                            <label for="">Product Sub-Category</label>
                            <select class="form-control product_sub_category" name="product_sub_cat">
                                <option value="" selected disabled>First Select Category</option>
                                @foreach($SubCategoris as $SubCategory)
                                    <option @if($Product->product_sub_cat == $SubCategory->sub_cat_id) selected  @else   @endif   value="{{$SubCategory->sub_cat_id}}">{{$SubCategory->sub_cat_title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group brand">
                            <label for="">Product Brand</label>
                            <select class="form-control product_brands" name="product_brand">
                                <option value="" selected disabled>First Select Sub Category</option>
                                @foreach($Brands as $Brand)
                                    <option @if($Product->product_brand == $Brand->brand_id) selected  @else   @endif   value="{{$Brand->brand_id}}">{{$Brand->brand_title}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Product Description</label>
                            <textarea class="form-control product_description" name="product_desc" rows="8"
                                  cols="80">{{$Product->product_desc}}</textarea>
                        </div>
                        <div class="show-error"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Featured Image</label>
                            <input type="file" class="product_image" requried name="featured_img">
                            <input type="hidden" name="Old_image" value="{{$Product->featured_image}}">
                            <img id="image" src="{{asset('images/Products/'.$Product->featured_image)}}" width="150px"/>
                        </div>
                        <div class="form-group">
                            <label for="">Product Price</label>
                            <input type="text" class="form-control product_price" value="{{$Product->product_price}}" name="product_price" requried value="">
                        </div>
                        <div class="form-group">
                            <label for="">Available Quantity</label>
                            <input type="number" class="form-control product_qty" value="{{$Product->qty}}" name="product_qty" requried value="">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control product_status" name="product_status">
                                <option @if($Product->product_status == 1) selected @else @endif  value="1">Publish</option>
                                <option @if($Product->product_status == 0) selected @else @endif  value="0">Draft</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn add-new" id="UpdateProduct" name="submit" value="Update">
                        </div>
                    </div>
                </form>
            @else
                <form id="createProduct" class="add-post-form row" method="post" enctype="multipart/form-data">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="">Product Title</label>
                            <input type="text" class="form-control product_title" name="product_title" placeholder="Product Title" requried/>
                        </div>
                        <div class="form-group category">
                            <label for="">Product Category</label>
                            <select class="form-control productcategory" name="product_cat">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($CatagoryArr as $Catagory)
                                    <option value="{{$Catagory->cat_id}}">{{$Catagory->cat_title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group sub_category">
                            <label for="">Product Sub-Category</label>
                            <select class="form-control product_sub_category" name="product_sub_cat">
                                <option value="" selected disabled>First Select Category</option>
                            </select>
                        </div>
                        <div class="form-group brand">
                            <label for="">Product Brand</label>
                            <select class="form-control product_brands" name="product_brand">
                                <option value="" selected disabled>First Select Sub Category</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Product Description</label>
                            <textarea class="form-control product_description" name="product_desc" rows="8" cols="80" requried></textarea>
                        </div>
                        <div class="show-error"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Featured Image</label>
                            <input type="file" class="product_image" requried name="featured_img">
                            <img id="image" src="" width="150px"/>
                        </div>
                        <div class="form-group">
                            <label for="">Product Price</label>
                            <input type="text" class="form-control product_price" name="product_price" requried value="">
                        </div>
                        <div class="form-group">
                            <label for="">Available Quantity</label>
                            <input type="number" class="form-control product_qty" name="product_qty" requried value="">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control product_status" name="product_status">
                                <option selected value="1">Publish</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn add-new" name="submit" value="Submit">
                        </div>
                    </div>
                </form>
            @endif

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


    $(document).ready(function(){

        //Get Category and Brand
        $('.productcategory').on('change',function(event){
            event.preventDefault();
            var id = $('.productcategory option:selected').val();
            //alert(id);
            $.ajax({
                type: "POST",
                url: "{{route('product.getsubcategoryandbrand')}}",
                data: {Cat_id:id},
                success: function (response) {
                    // console.log(response);
                    // return false;
                    var res = (response);
                    if(res.hasOwnProperty('sub_category')){
                        var sub_cat = '<option value="" selected disabled>Select Sub Category</option>';
                        var sub_cat_length = res.sub_category.length;
                        for(var i = 0;i<sub_cat_length;i++){
                            sub_cat += '<option value="'+res.sub_category[i].sub_cat_id+'">'+res.sub_category[i].sub_cat_title+'</option>';
                        }
                        $('.product_sub_category').html(sub_cat);
                    }
                    if(res.hasOwnProperty('brands')){
                        var brand = '<option value="" selected disabled>Select Brand</option>';
                        var brand_length = res.brands.length;
                        if(brand_length > 0){
                            for(var j = 0;j<brand_length;j++){
                                brand += '<option value="'+res.brands[j].brand_id+'">'+res.brands[j].brand_title+'</option>';
                            }
                        }else{
                            brand = '<option value="" selected disabled>No Brands Found</option>';
                        }

                        $('.product_brands').html(brand);
                    }
                },
                error : function(){

                }
            });

        })

        //Add Product
        $('#createProduct').submit(function(e){
            e.preventDefault();
            $('.alert').hide();
            var title = $('.product_title').val();
            var cat = $('.product_category option:selected').val();
            var sub_cat = $('.product_sub_category option:selected').val();
            var des = $('.product_description').val();
            var price = $('.product_price').val();
            var qty = $('.product_qty').val();
            var status = $('.product_status').val();
            var image = $('.product_image').val();
            var brand = $('.product_brands').val();
            if(title == ''){
                $('#createProduct').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
            }else if(cat == ''){
                $('#createProduct').prepend('<div class="alert alert-danger">Category Field is Empty.</div>');
            }else if(sub_cat == ''){
                $('#createProduct').prepend('<div class="alert alert-danger">Sub Category Field is Empty.</div>');
            }else if(des == ''){
                $('#createProduct').prepend('<div class="alert alert-danger">Description Field is Empty.</div>');
            }else if(price == ''){
                $('#createProduct').prepend('<div class="alert alert-danger">Price Field is Empty.</div>');
            }else if(qty == ''){
                $('#createProduct').prepend('<div class="alert alert-danger">Quantity Field is Empty.</div>');
            }else if(image == ''){
                $('#createProduct').prepend('<div class="alert alert-danger">Image Field is Empty.</div>');
            }else{
                var formdata = new FormData(this);
                formdata.append('create',1);
                $.ajax({
                    url    : "{{route('product.store')}}",
                    type   : "POST",
                    data   : formdata,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response){
                        $('.alert').hide();
                        $('.product_title').val('');
                        $('.product_category option:selected').val('');
                        $('.product_sub_category option:selected').val('');
                        $('.product_description').val('');
                        $('.product_price').val('');
                        $('.product_qty').val('');
                        $('.product_status').val('');
                        $('.product_image').val('');
                        $('.product_brands').val('');

                        var res = response;
                        if(res.hasOwnProperty('message')){
                            $('#createProduct').prepend('<div class="alert alert-success">'+res.message+'.</div>');
                            setTimeout(function(){ window.location = res.redirect_url; }, 1000);

                        }else if(res.hasOwnProperty('error')){
                            $('#createProduct').prepend('<div class="alert alert-danger">'+res.error+'</div>');
                        }
                    }
                });
            }

        });

        //Update Product
        // $('#UpdateProducts').submit(function(){
        //     //event.preventDefault();
        //     $('.alert').hide();
        //     var title = $('.product_title').val();
        //     var cat = $('.product_category option:selected').val();
        //     var sub_cat = $('.product_sub_category option:selected').val();
        //     var des = $('.product_description').val();
        //     var price = $('.product_price').val();
        //     var qty = $('.product_qty').val();
        //     var status = $('.product_status').val();
        //     var image = $('.product_image').val();
        //     var brand = $('.product_brands').val();
        //     if(title == ''){
        //         $('#createProduct').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
        //     }else if(cat == ''){
        //         $('#createProduct').prepend('<div class="alert alert-danger">Category Field is Empty.</div>');
        //     }else if(sub_cat == ''){
        //         $('#createProduct').prepend('<div class="alert alert-danger">Sub Category Field is Empty.</div>');
        //     }else if(des == ''){
        //         $('#createProduct').prepend('<div class="alert alert-danger">Description Field is Empty.</div>');
        //     }else if(price == ''){
        //         $('#createProduct').prepend('<div class="alert alert-danger">Price Field is Empty.</div>');
        //     }else if(qty == ''){
        //         $('#createProduct').prepend('<div class="alert alert-danger">Quantity Field is Empty.</div>');
        //     }else if(image == ''){
        //         $('#createProduct').prepend('<div class="alert alert-danger">Image Field is Empty.</div>');
        //     }else{
        //         var formdata = new FormData(this);
        //         formdata.append('create',1);
        //         $.ajax({
        //             type   : "PUT",
        //             data   : formdata,
        //             //processData: false,
        //             //contentType: false,
        //             //dataType: 'json',
        //             success: function(response){
        //                 console.log(response);
        //                // return false;
        //                 $('.alert').hide();
        //                 $('.product_title').val('');
        //                 $('.product_category option:selected').val('');
        //                 $('.product_sub_category option:selected').val('');
        //                 $('.product_description').val('');
        //                 $('.product_price').val('');
        //                 $('.product_qty').val('');
        //                 $('.product_status').val('');
        //                 $('.product_image').val('');
        //                 $('.product_brands').val('');


        //             },
        //             error : function(error){
        //                 console.log(error);
        //                 return false;

        //             }
        //         });
        //     }

        // });
    });
</script>
@endsection
