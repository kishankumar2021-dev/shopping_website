@extends('admin.adminlayout.main')
@section('content')

<div class="admin-content-container">
    <h2 class="admin-heading">All Brands</h2>
    <span id="response_msg"></span>

    <a class="add-new pull-right" href="{{route('brand.create')}}">Add New</a>

        <table class="table table-striped table-hover table-bordered">
            <thead>
            <th>Title</th>
            <th>Category</th>
            <th>Action</th>
            </thead>
            <tbody>
                @php
                    //dd($BrandData);
                @endphp
                @forelse ($BrandData as $Brand)
                @php
                    // dd($Brand['Category']);
                 @endphp

                    <tr>
                        <td>{{$Brand['Brand']->brand_title}}</td>
                        <td>{{$Brand['Category']->cat_title}}</td>
                        <td>
                            <a class="" href="{{route('brand.edit',['brand_id'=>$Brand['Brand']->brand_id])}}"  data-id="{{$Brand['Brand']->brand_id }}"><i class="fa fa-edit"></i></a>
                            <a class="delete_brands"  data-id="{{$Brand['Brand']->brand_id}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="not-found">!!! No Barnds Found !!!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    <?php //}else{ ?>
    <?php    //} ?>
    <div class="pagination-outer">
        <?php //echo $db->pagination('brands','categories ON brands.brand_cat=categories.cat_id',null,$limit); ?>
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
        $('.edit_brand').on('click',function(event){
            event.preventDefault();
            var brand_id = $(this).data('id');
            //alert(id);
                $.ajax({
                    type:"GET",
                    url: "{{ route('brand.edit',['brand_id'=>':brand_id']) }}".replace(':brand_id',brand_id),
                    data: {
                        brand_id:brand_id,
                    },
                    success: function (response) {
                        console.log(response)
                        //return false;
                         if(response.message){
                            $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>');
                         }
                         //return false;
                         window.location.href=response.redirect_url;
                    },
                    error : function(error){
                        console.log(error)
                        //return false;
                        //console.ReadKey(true)
                        $('#response_msg').html('<div class=" alert alert-danger">'+error+'</div>');
                    }
                });


        });
    });

    //Delete Brand
    $(document).ready(function(){
        $('.delete_brands').on('click',function(event){
            event.preventDefault();
            var brand_id = $(this).data('id');
            var Confirmed = confirm('Are You Sure Want To Delete Records!!');
            if(Confirmed)
            {
                $.ajax({
                    type:"GET",
                    url: "{{ route('brand.destroy',['brand_id'=>':brand_id']) }}".replace(':brand_id',brand_id),
                    data: {
                        brand_id:brand_id,
                    },
                    success: function (response) {
                        // console.log(response)
                        // return false;
                         if(response.message){
                            $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>');
                         }
                         //return false;
                         window.location.href=response.redirect_url;
                    },
                    error : function(error){
                        //console.log(error)
                        //return false;
                        $('#response_msg').html('<div class=" alert alert-danger">'+error+'</div>');
                    }
                });

            }
            //alert(id);


        });
    });



</script>

@endsection
