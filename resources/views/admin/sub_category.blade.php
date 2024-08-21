@extends('admin.adminlayout.main')
@section('content')

<div class="admin-content-container">
    <h2 class="admin-heading">All SubCategory</h2>
    <span id="response_msg"></span>
    <a class="add-new pull-right" href="{{route('sub-category.create')}}">Add New</a>
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <th>Title</th>
            <th>Category</th>
            <th>Show in Header</th>
            <th>Show in Footer</th>
            <th>Action</th>
            </thead>
            <tbody>
                {{-- @php
                    echo '<pre>';print_r($SubCategoryData);
                    die;
                @endphp --}}
                @forelse ($SubCategoryData as $SubCategory)
                <tr>
                    <td>{{$SubCategory['subcategory']->sub_cat_title}}</td>
                    <td>{{$SubCategory['category']->cat_title}}</td>
                    <td>
                        <input type="checkbox" class="toggle-checkbox showCat_Headers" data-id="{{$SubCategory['subcategory']->sub_cat_id}}" @if ($SubCategory['subcategory']->show_in_header==1) checked @else  @endif />
                        {{-- <input type="checkbox" class="toggle-checkbox showCat_Header" data-id="" /> --}}

                    </td>
                    <td>
                        <input type="checkbox" class="toggle-checkbox showCat_Footers" data-id="{{$SubCategory['subcategory']->sub_cat_id}}" @if ($SubCategory['subcategory']->show_in_footer==1) checked @else  @endif  />

                        {{-- <input type="checkbox" class="toggle-checkbox showCat_Footer" data-id="" /> --}}

                    </td>
                    <td>
                        <a href="{{route('sub-category.edit',['sub_cat_id'=>$SubCategory['subcategory']->sub_cat_id])}}"><i class="fa fa-edit"></i></a>
                        <a class="delete_subCategoryData" href="{{route('sub-category.destroy',['sub_cat_id'=>$SubCategory['subcategory']->sub_cat_id])}}" data-id="{{$SubCategory['subcategory']->sub_cat_id}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @empty

                    <tr>
                        <td class="not-found" colspan="6">!!! No Sub Categories Available !!!</td>
                        {{-- <div class="not-found">!!! No Sub Categories Available !!!</div> --}}
                    </tr>

                @endforelse
            </tbody>
        </table>
    <div class="pagination-outer">
    </div>
</div>
<script src="{{asset('adminasset/js/jquery.js')}}"></script>
<script>
        //start Csrf Token
        $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
                    }

                })
            });
        //End Csrf Token

            $(document).ready(function(){
                //Delete Sub-Category
                $('.delete_subCategoryData').on('click',function(event){
                    //alert($id);
                    event.preventDefault();
                    //alert(sub_category+parent_cat);
                    var Confirmed = confirm('Are You Sure Want To Delete Records!!');
                    var sub_cat_id = $(this).data('id');
                    //alert(sub_cat_id);
                    if(Confirmed){
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('sub-category.destroy', ['sub_cat_id' => ':sub_cat_id']) }}".replace(':sub_cat_id', sub_cat_id),
                            data: {
                                Sub_cat_id : sub_cat_id
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

                //Show header
                $('.showCat_Headers').on('change',function(event){
                    event.preventDefault();
                    //alert('hello');
                    var sub_cat_id = $(this).data('id');
                    //alert(headers);
                    $.ajax({
                        type: "POST",
                        url: "{{route('sub-category.header_status')}}",
                        data: {
                            sub_cat_id : sub_cat_id
                        },
                        //dataType: "dataType",
                        success: function (response) {
                            console.log(response);

                        }
                    });

                });

                //show Footer
                $('.showCat_Footers').on('change',function(event){
                    event.preventDefault();
                    //alert('hello');
                    var sub_cat_id = $(this).data('id');
                    //alert(sub_cat_id);
                    $.ajax({
                        type: "PUT",
                        url: "{{route('sub-category.footer_status')}}",
                        data: {
                            sub_cat_id : sub_cat_id
                        },
                        //dataType: "dataType",
                        success: function (response) {
                            console.log(response)
                        },
                        error : function(response){

                        }
                    });

                });


            });



</script>

@endsection

