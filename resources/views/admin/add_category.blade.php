@extends('admin.adminlayout.main')
@section('content')

<div class="admin-content-container">
    <h2 class="admin-heading">@if ($id!='' && $id>0) Edit @else Add New @endif  Category</h2>

    <!-- Form -->
    @if ($id!='' && $id>0)
        <div class="row">
            <form class="add-post-form col-md-6" id="EditCategory">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="cat_id" id="cat_id" value="{{ $id }}">
                <div class="form-group">
                    <label>Category Name</label>
                    <span id="response_msg"></span>
                    <input type="text" name="cat" value="{{$CategoryData->cat_title}}" class="form-control category" placeholder="Category Name" autocomplete="off" />
                </div>
                <input type="submit" name="save" class="btn add-new" id="save-data" value="Update">
            </form>
        </div>
    @else
        <div class="row">
            <form class="add-post-form col-md-6" id="CreateCategory">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                    <label>Category Name</label>
                    <span id="response_msg"></span>
                    <input type="text" name="cat" class="form-control category" placeholder="Category Name" autocomplete="off" />
                </div>
                <input type="submit" name="save" class="btn add-new" id="save-data" value="Submit">
            </form>
        </div>
    @endif
    <!-- /Form -->
</div>
<script src="{{asset('adminasset/js/jquery.js')}}"></script>
<script>

$(document).ready(function(){
    // Include CSRF token in AJAX setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //add category
    $('#CreateCategory').on('submit', function(e){
        e.preventDefault();
        var category = $('.category').val();
        $.ajax({
            type: "POST",
            url: "{{ route('category.store') }}",
            data: {
                Category: category,
            },
            success: function (response) {
                //console.log(response);
                //return false;
                if(response.message){
                    $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>')
                }
                $('.category').val('');
                //return false;
                window.location.href = response.redirect_url;
            },
            error: function(xhr, status, error) {
                $('#response_msg').html('<div class=" alert alert-danger">'+error+'</div>');
                //console.error(xhr.responseText);
            }
        });
    });

    //Edit Category
    $('#EditCategory').on('submit', function(e){
        e.preventDefault();
        var category = $('.category').val();
        var cat_id = $('#cat_id').val();
        $.ajax({
            type: "PUT",
            url: "{{ route('category.update') }}",
            data: {
                Category: category,
                cat_id:cat_id
            },
            success: function (response) {
                console.log(response);
                //return false;
                if(response.message){
                    $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>')
                }
                $('.category').val('');
                //return false;
                window.location.href = response.redirect_url;
            },
            error: function(xhr, status, error) {
                $('#response_msg').html('<div class=" alert alert-danger">'+'Category Not Updated!!'+'</div>');
                //console.error(xhr.responseText);
            }
        });
    });

});
</script>
@endsection

