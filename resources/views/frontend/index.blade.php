
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('frontend')}}/index.css">
    <title>Internship</title>
</head>
<body>
    <section class="top_section">
        <!-- header -->
        <!-- <div class="container"> -->
            <div class="row">
                <!-- <div class="col-lg-12"> -->
                    <div class="col-lg-6 text-start top_left">
                        <p><i class="fa-solid fa-location-dot me-1" style="color: #ff6229;"></i>Demo, Mirpur, Dhaka 1200</p>
                    </div>
                    <div class="col-lg-6 text-end top_left">
                        <p><i class="fa-solid fa-envelope me-1" style="color: #ff6229;"></i>demo@mailnator.com</p>
                    </div>
                <!-- </div> -->
            </div>
            <div class="main">
                <div class="row d-flex">
                    <div class="col-lg-4">
                        <a href="" style=" text-decoration: none;"><h1 style="color: #ff6229; font-weight: 700; font-size: 3em;">Ecommerce</h1></a>
                    </div>
                    <div class="col-lg-8 navvbar mt-3 text-end">
                        <a href="{{route('index')}}" style="color: #ff6229;"><i class="fa-solid fa-house me-1" style="color: #ff6229;"></i>Home</a>
                        @auth
                            <strong>{{Auth::user()->name}}</strong>
                        @else
                            <a href="{{route('login')}}">Sign In</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="containerr">
                <div class="row">
                    <div class="col-lg-12">
                        @if (session('success'))
                            <div class="alert alert-success mt-2">{{session('success')}}</div>
                        @endif
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-3 mb-4">
                                    <div class="card text-center">
                                        <div class="photo mt-2">
                                            <img width="200" height="200" src="{{asset('uploads/products')}}/{{$product->prev_img}}" alt="">
                                        </div>
                                        <h4 class="mt-2">{{$product->product_name}}</h4>
                                        <p>Category: {{$product->rel_to_category->category_name}}</p>
                                        <p>Subcategory: {{$product->rel_to_subcategory->subcategory_name}}</p>
                                        <strong class="mb-2">Price: {{$product->product_price}} &#2547;</strong>
                                        @auth
                                            <a href="{{route('purchase',$product->id)}}" class="btn btn-primary w-100">Buy Now</a>
                                        @else
                                            <a href="{{route('login')}}" class="btn btn-primary w-100">Buy Now</a>
                                        @endauth 
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </section>

    <!-- footer part -->
    <div class="top_footer my-5 w-100">
        <div class="bottom-footer">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <p>Copyright © 2024 • demo • All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- javascript section -->
    <script src="https://kit.fontawesome.com/9f826ef9c2.js" crossorigin="anonymous"></script>
</body>
</html>