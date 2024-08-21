@extends('admin.adminlayout.main')
@section('content')

    <div class="admin-content-container">
        <h2 class="admin-heading">All Products</h2>
        @if (session('Message'))
            <div class="alert alert-success" id="flash-message">
                {{ session('Message') }}
            </div>
        @endif
        <span id="response_msg"></span>
        <a class="add-new pull-right" href="{{route('product.create')}}">Add New</a>
            <table id="productsTable" class="table table-striped table-hover table-bordered">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th width="100px">Action</th>
                </thead>
                <tbody>
                    @forelse ($AllProductArr as $key=>$Product)
                    <tr>
                        @php
                            // echo '<pre>';
                            //     print_r($Product);
                            // echo '</pre>';
                            // die;
                        @endphp
                        <td><b>{{$key+1}}</b></td>
                        <td>{{$Product['Product']->product_title}}</td>
                        <td>{{$Product['Category']->cat_title}}</td>
                        <td>{{($Product['Brand']!=NULL) ? $Product['Brand']->brand_title : '!!No Brands!!'}}</td>
                        <td>{{$Product['Product']->product_price}}</td>
                        <td>{{$Product['Product']->qty}}</td>
                        <td>
                            @if($Product['Product']->featured_image!='')
                                <img src="{{asset('images/Products/'.$Product['Product']->featured_image)}}" alt="<?php //echo $row['featured_image']; ?>" width="50px"/>
                            @else
                                <img src="{{asset('images/index.png')}}" alt="" width="50px"/>
                            @endif
                        </td>
                        <td>
                             @if($Product['Product']->product_status == 1)
                                <span class="label label-success">Active</span>
                             @else
                                <span class="label label-danger">Inactive</span>
                             @endif
                        </td>
                        <td>
                            <a class="EditProduct" href="{{route('product.edit',['id'=>$Product['Product']->product_id])}}" data-id="{{$Product['Product']->product_id}}"><i class="fa fa-edit"></i></a>
                            <a class="delete_productData" href="javascript:void()" data-id="{{$Product['Product']->product_id}}" data-subcat=" "><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="10"><div class="not-found clearfix">!!! No Products Found !!!</div></td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        <div class="pagination-outer">
        <?php   //show pagination
        //echo $db->pagination('products','sub_categories ON products.product_sub_cat=sub_categories.sub_cat_id LEFT JOIN brands ON products.product_brand=brands.brand_id',null,$limit);
        ?>
        </div>
    </div>
    <script src="{{asset('adminasset/js/jquery.js')}}"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).ready(function(){
            $('.delete_productData').on('click', function(event){
                event.preventDefault();
                var confirmed = confirm('Are You Sure Wnat To delete!!');
                if(confirmed){
                    var cat_id = $(this).data('id');
                    //alert(cat_id);

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('product.destroy') }}",
                        data: {id:cat_id},
                        success: function (response) {
                            // console.log(response);
                            // return false;
                            if(response.message){
                                $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>')
                            }
                            //return false;
                            setTimeout(function(){ window.location.href = response.redirect_url },1000);
                        },
                        error: function(xhr, status, error) {
                            $('#response_msg').html('<div class=" alert alert-danger">'+'!!Product Not Deleted!!'+'</div>');
                            //console.error(xhr.responseText);
                        }
                    });

                }
            });
        });



    </script>
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                var flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.style.display = 'none';
                }
            }, 3000); // 5000 milliseconds = 5 seconds
        });
    </script>

@endsection
