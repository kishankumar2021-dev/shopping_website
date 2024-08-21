@extends('admin.adminlayout.main')
@section('content')

    <div class="admin-content-container">
        <h2 class="admin-heading">Dashboard</h2>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr class="active"><td colspan="2">OUT OF Stock</td></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Product Code</td>
                            <td>400</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="detail-box">
                    <span class="count">{{$ProductCount}}</span>
                    <span class="count-tag">Products</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-box">
                    <span class="count">{{$CategoryCount}}</span>
                    <span class="count-tag">Categories</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-box">
                    <span class="count">{{$SubcategoryCount}}</span>
                    <span class="count-tag">Sub Categories</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-box">
                    <span class="count">{{$BrandCount}}</span>
                    <span class="count-tag">Brands</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-box">
                    <span class="count">400</span>
                    <span class="count-tag">Orders</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-box">
                    <span class="count">400</span>
                    <span class="count-tag">Users</span>
                </div>
            </div>
        </div>

    </div>

@endsection
