@extends('admin.adminlayout.main')
@section('content')

<div class="admin-content-container">
    <h2 class="admin-heading">All Categories</h2>
    <a class="add-new pull-right" href="{{route('category.create')}}">Add New</a>
    <span id="response_msg"></span>
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <th>Title</th>
            <th>Action</th>
            </thead>
            <tbody>
            @forelse ($CategoryData as $CategoryVal)
                <tr>
                    <td>{{$CategoryVal->cat_title}}</td>
                    <td>
                        <a href="{{route('category.edit',['cat_id'=>$CategoryVal->cat_id])}}"><i class="fa fa-edit"></i></a>
                        <a class="delete_categoryData"  href="javascript:void()" data-id="{{$CategoryVal->cat_id}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @empty
                <div class="not-found">!!! No Category Available !!!</div>
            @endforelse
            </tbody>
        </table>
    <div class="pagination-outer">
        <?php //echo $db->pagination('categories',null,null,$limit); ?>
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

        $('.delete_categoryData').on('click', function(e){
            e.preventDefault();
            var confirmed = confirm('Are You Sure Wnat To delete!!');
            if(confirmed){
                var cat_id = $(this).data('id');
                //alert(cat_id);

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('category.destroy') }}",
                    data: {
                        cat_id:cat_id
                    },
                    success: function (response) {
                        console.log(response);
                        //return false;
                        if(response.message){
                            $('#response_msg').html('<div class=" alert alert-success">'+response.message+'</div>')
                        }
                        //return false;
                        window.location.href = response.redirect_url;
                    },
                    error: function(xhr, status, error) {
                        $('#response_msg').html('<div class=" alert alert-danger">'+'Category Not Updated!!'+'</div>');
                        //console.error(xhr.responseText);
                    }
                });

            }
        });


});
</script>

@endsection
