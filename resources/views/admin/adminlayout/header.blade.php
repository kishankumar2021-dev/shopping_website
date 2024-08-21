
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{asset('frontEndasset/css/bootstrap.min.css')}}" />
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900|Montserrat:400,500,700,900" rel="stylesheet">
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="{{asset('frontEndasset/css/font-awesome.css')}}">
        <!-- Jquery textEditor -->
        <link rel="stylesheet" href="{{asset('adminasset/css/jquery-te-1.4.0.css')}}">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="{{asset('frontEndasset/css/style.css')}}">
        <script src="{{asset('adminasset/js/jquery.js')}}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <!-- HEADER -->
        <div id="admin-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <?php
                       // if(!empty($result[0]['site_logo'])){ ?>
                            {{-- <a href="dashboard.php" class="logo-img"><img src="../images/<?php //echo $result[0]['site_logo']; ?>" alt=""></a> --}}
                        <?php //}else{ ?>
                            {{-- <a href="dashboard.php" class="logo"><?php //echo $result[0]['site_name']; ?></a> --}}
                        <?php //} ?>
                    </div>
                    <div class="col-md-offset-8 col-md-2">
                        <div class="dropdown">
                            <a href="" class="dropdown-toggle logout" data-toggle="dropdown">
                                <?php
                                // if(!session_id()){
                                //     session_start();
                                // }
                                // echo 'Hi '.$_SESSION['admin_name']; ?>
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="change_password.php">Change Password</a></li>
                                <li><a href="php_files/logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <div id="admin-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <!-- Menu Bar Start -->
                    <div class="col-md-2 col-sm-3" id="admin-menu">
                         <ul class="menu-list">
                            <li ><a href="{{route('admin.index')}}">Dashboard</a></li>
                            <li><a href="{{route('product.index')}}">Products</a></li>
                            <li ><a href="{{route('category.index')}}">Categories</a></li>
                            <li><a href="{{route('sub-category.index')}}">Sub-Categories</a></li>
                            <li ><a href="{{route('brand.index')}}">Brands</a></li>
                            <li ><a href="{{route('orders.index')}}">Orders</a></li>
                            <li ><a href="{{route('user.index')}}">Users</a></li>
                            <li ><a href="{{route('option.create')}}">Options</a></li>
                        </ul>
                    </div>
                    <!-- Menu Bar End -->
                    <!-- Content Start -->
                    <div class="col-md-10 col-sm-9 clearfix" id="admin-content">
