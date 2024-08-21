@extends('admin.adminlayout.main')
@section('content')

<div class="admin-content-container">
    <h2 class="admin-heading">@if ($sub_cat_id!='' && $sub_cat_id>0) Edit @else Add New @endif  Sub Category</h2>
    <span id="response_msg"></span>
    <div class="row">
    <!--Edit Sub-Category Form -->
    @if ($sub_cat_id!='' && $sub_cat_id>0)
        <form id="EditSubCategory" class="add-post-form col-md-6" >
            <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
            <input type="hidden" id="Sub_cat_id" value="{{$sub_cat_id}}">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="sub_cat_name" value="{{$SubCategoryData->sub_cat_title}}" class="form-control sub_category" placeholder="Sub Category Name" />
            </div>
            <div class="form-group">
                <label for="">Parent Category</label>
                <select class="form-control parent_cat" name="parent_cat">
                    <option value="" selected disabled>Select Category</option>
                    @forelse ($CategoryData as $Category)
                        <option @if($SubCategoryData->cat_parent == $Category->cat_id) selected   @else   @endif  value="{{$Category->cat_id}}">{{$Category->cat_title}}</option>
                    @empty
                        <option>Not Category!!</option>
                    @endforelse
                </select>
            </div>
            <input type="submit" name="save" class="btn add-new" value="Update" />
        </form>
    @else
    <!--Add Sub-Category Form-->
        <form id="AddSubCategory" class="add-post-form col-md-6" >
            <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="sub_cat_name" class="form-control sub_category" placeholder="Sub Category Name" />
            </div>
            <div class="form-group">
                <label for="">Parent Category</label>
                <select class="form-control parent_cat" name="parent_cat">
                    <option value="" selected disabled>Select Category</option>
                    @forelse ($CategoryData as $Category)
                        <option value="{{$Category->cat_id}}">{{$Category->cat_title}}</option>
                    @empty
                        <option>Not Category!!</option>
                    @endforelse
                </select>
            </div>
            <input type="submit" name="save" class="btn add-new" value="Submit" />
        </form>
    @endif
    <!--  Form -->
    </div>
</div>
<script src="{{asset('adminasset/js/jquery.js')}}"></script>
<script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
                }
            })
        });

    //Add Sub-Category
    $(document).ready(function(){
        $('#AddSubCategory').on('submit',function(event){
            event.preventDefault();
            var sub_category = $('.sub_category').val();
            var parent_cat = $('.parent_cat').val();
            //alert(sub_category+parent_cat);
            if(sub_category!='' && parent_cat!=''){
                $.ajax({
                    type: "POST",
                    url: "{{ route('sub-category.store') }}",
                    data: {
                        sub_category:sub_category,
                        parent_cat:parent_cat,
                    },
                    //dataType: "dataType",
                    success: function (response) {
                        console.log(response)
                        //return false;
                         $('.sub_category').val('');
                         $('.parent_cat').val('');
                         if(response.message){
                            $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>');
                         }
                         window.location.href=response.redirect_url;
                        // return false;


                    },
                    error : function(error){
                        console.log(error)
                        //return false;
                        console.ReadKey(true)

                        $('#response_msg').html('<div class=" alert alert-danger">'+error+'</div>');


                    }
                });
            }

        });
    });

    //Edit Sub-CateGory
    $(document).ready(function(){
        $('#EditSubCategory').on('submit',function(event){
            //alert('hello');
            event.preventDefault();
            var sub_category = $('.sub_category').val();
            var parent_cat = $('.parent_cat').val();
            var Sub_cat_id = $('#Sub_cat_id').val();
            //alert(sub_category+parent_cat);
            if(sub_category!='' && parent_cat!=''){
                $.ajax({
                    type: "PUT",
                    url: "{{ route('sub-category.update') }}",
                    data: {
                        sub_category:sub_category,
                        parent_cat:parent_cat,
                        Sub_cat_id : Sub_cat_id
                    },
                    //dataType: "dataType",
                    success: function (response) {
                        console.log(response)
                        //return false;
                         $('.sub_category').val('');
                         $('.parent_cat').val('');
                         $('#Sub_cat_id').val('');
                         if(response.message){
                            $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>');
                         }
                         window.location.href=response.redirect_url;
                        // return false;
                    },
                    error : function(error){
                        console.log(error)
                        //return false;
                        console.ReadKey(true)

                        $('#response_msg').html('<div class=" alert alert-danger">'+error+'</div>');


                    }
                });
            }

        });
    });

    //Delete Sub-Category
    $(document).ready(function(){
        $('#EditSubCategory').on('submit',function(event){
            //alert('hello');
            event.preventDefault();
            var sub_category = $('.sub_category').val();
            var parent_cat = $('.parent_cat').val();
            var Sub_cat_id = $('#Sub_cat_id').val();
            //alert(sub_category+parent_cat);
            if(sub_category!='' && parent_cat!=''){
                $.ajax({
                    type: "PUT",
                    url: "{{ route('sub-category.update') }}",
                    data: {
                        sub_category:sub_category,
                        parent_cat:parent_cat,
                        Sub_cat_id : Sub_cat_id
                    },
                    //dataType: "dataType",
                    success: function (response) {
                        console.log(response)
                        //return false;
                         $('.sub_category').val('');
                         $('.parent_cat').val('');
                         $('#Sub_cat_id').val('');
                         if(response.message){
                            $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>');
                         }
                         window.location.href=response.redirect_url;
                        // return false;
                    },
                    error : function(error){
                        console.log(error)
                        //return false;
                        console.ReadKey(true)

                        $('#response_msg').html('<div class=" alert alert-danger">'+error+'</div>');


                    }
                });
            }

        });
    });
</script>
@endsection
