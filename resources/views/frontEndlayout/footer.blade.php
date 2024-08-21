<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>SUPER MARKET</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, perspiciatis quia repudiandae sapiente sed sunt.</p>
            </div>
            <div class="col-md-3">
                <h3>Categories</h3>
                <ul class="menu-list">
                    <li><a href="">LAPTOP</a></li>
                    <li><a href="">KURTI'S</a></li>
                    <li><a href="">MOBILES</a></li>
                    <li><a href="">MEN'S T-SHIRTS</a></li>
                    <li><a href="">BEDS</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Useful Links</h3>
                <ul class="menu-list">
                    <li><a href="">Home</a></li>
                    <li><a href="all_products.php">All Products</a></li>
                    <li><a href="latest_products.php">Latest Products</a></li>
                    <li><a href="popular_products.php">Popular Products</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Contact Us</h3>
                <ul class="menu-list">
                    <li><i class="fa fa-home" ></i><span>: Azamgarh U.P.</span></li>
                    <li><i class="fa fa-phone" ></i><span>: 9889104576</span></li>
                    <li><i class="fa fa-envelope" ></i><span>: Kishan276288@Gmail.Com</span></li>
                </ul>
            </div>
            <div class="col-md-12">
                <span> | Created by <a href="#" target="">kishan kumar</a></span>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('frontEndasset/js/jquery-1.10.2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('frontEndasset/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontEndasset/js/actions.js')}}"></script>
<!--okzoom Plugin-->
<script src="{{asset('frontEndasset/js/okzoom.min.js')}}" type="text/javascript"></script>
<!--owl carousel plugin-->
<script type="text/javascript" src="{{asset('frontEndasset/js/owl.carousel.js')}}"></script>

<script>
    $(document).ready(function(){

        $('#product-img').okzoom({
            width: 200,
            height: 200,
            scaleWidth: 800
        });

        $('.banner-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 1,
                    nav: true
                },
                1000: {
                    items: 1,
                    nav: true,
                    loop: false,
                    margin: 10
                }
            }
        });

        $('.popular-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 2,
                    nav: true
                },
                800: {
                    items: 4,
                    nav: true
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false,
                    margin: 10
                }
            }
        });

        $('.latest-carousel').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            navText : ["",""],
            responsive: {
                0: {
                    items: 1,
                    nav: true

                },
                600: {
                    items: 2,
                    nav: true
                },
                800: {
                    items: 3,
                    nav: true
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: false,
                    margin: 5
                }
            }
        });
    });

</script>

</body>
</html>
