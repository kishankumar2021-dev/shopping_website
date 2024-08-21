@extends('admin.adminlayout.main')
@section('content')
    <div class="admin-content-container">
        <h2 class="admin-heading">@if($brand_id!='' && $brand_id>0) Edit @else Add New  @endif  Brand</h2>
        <span id="response_msg"></span>
        <div class="row">
            @if ($brand_id!='' && $brand_id>0)
                <form id="Edit_Brand" class="add-post-form col-md-6" autocomplete="off">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="hidden" id="brand_id"  value="{{$brand_id}}">
                        <input type="text" value="{{$Brand->brand_title}}" name="brand_name" class="form-control brand_name" placeholder="Brand Name"/>
                    </div>
                    <div class="form-group">
                        <label for="">Brand Category</label>
                        <select class="form-control brand_category" name="brand_cat">
                            <option value="" selected disabled>Select Category</option>
                            @forelse ($CategoryArr as $Category)
                                <option @if ($Brand->brand_cat==$Category->cat_id)
                                    selected
                                @else

                                @endif value="{{$Category->cat_id}}">{{$Category->cat_title}}</option>
                            @empty
                                <option value="">!!Not Found Category!!</option>
                            @endforelse
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn add-new" value="Submit"/></button>
                </form>
            @else
                <form id="create_Brand" class="add-post-form col-md-6" autocomplete="off">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="brand_name" class="form-control brand_name" placeholder="Brand Name"/>
                    </div>
                    <div class="form-group">
                        <label for="">Brand Category</label>
                        <select class="form-control brand_category" name="brand_cat">
                            <option value="" selected disabled>Select Category</option>
                            @forelse ($CategoryArr as $Category)
                                <option value="{{$Category->cat_id}}">{{$Category->cat_title}}</option>
                            @empty
                                <option value="">!!Not Found Category!!</option>
                            @endforelse
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn add-new" value="Submit"/></button>
                </form>
            @endif
            <!-- /Form -->
        </div>
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

    //Add Brands
    $(document).ready(function(){
        $('#create_Brand').on('submit',function(event){
            event.preventDefault();
            //alert('hello');
            var brand_category = $('.brand_category').val();
            var brand_name = $('.brand_name').val();
            if(brand_name!='' && brand_category!=''){
                $.ajax({
                    type:"POST",
                    url: "{{ route('brand.store') }}",
                    data: {
                        brand_category:brand_category,
                        brand_name:brand_name,
                    },
                    success: function (response) {
                        console.log(response)
                        //return false;
                         $('.brand_category').val('');
                         $('.brand_name').val('');
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

    //Edit Brand
    $(document).ready(function(){
        $('#Edit_Brand').on('submit',function(event){
            event.preventDefault();
            //alert('hello');
            var brand_id = $('#brand_id').val();
            var brand_category = $('.brand_category').val();
            var brand_name = $('.brand_name').val();
            if(brand_name!='' && brand_category!=''){
                $.ajax({
                    type:"PUT",
                    url: "{{ route('brand.update') }}",
                    data: {
                        brand_id:brand_id,
                        brand_category:brand_category,
                        brand_name:brand_name,
                    },
                    success: function (response) {
                        console.log(response)
                        //return false;
                         $('.brand_category').val('');
                         $('.brand_name').val('');
                         if(response.message){
                            $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>');
                         }
                         window.location.href=response.redirect_url;
                        // return false;
                    },
                    error : function(error){
                        console.log(error)
                        //return false;
                        $('#response_msg').html('<div class=" alert alert-danger">'+error+'</div>');
                    }
                });
            }

        });
    });



</script>

@endsection
