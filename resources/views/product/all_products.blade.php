@extends('dashboard.dashboard')
@section('content')
    <div class="row">

        <div class="col-lg-4">
            <input type="text" id="search_input" placeholder="Search..." class="form-control inputt">
            <button type="submit" class="btnn search-btn"><i class="fa fa-search"></i></button>
        </div>

        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3>All Products</h3>
                </div>
                @if (session('delete'))
                    <div class="alert alert-danger mt-2">{{session('delete')}}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Price(TK)</th>
                            <th>Preview</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($products as $sl=>$product)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_price}}&#2547;</td>
                                <td>
                                    <img width="50" src="{{asset('uploads/products/')}}/{{$product->prev_img}}">
                                </td>
                                @can('product_action')
                                    <td>
                                        <a class="btn btn-primary" href="{{route('edit.product', $product->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        
                                        <a class="btn btn-danger" href="{{route('delete.product', $product->id)}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-1">
        {{$products->links()}}
    </div>
@endsection
@section('footer_script')
    <script>
        $('.search-btn').click(function(){
            var search_input = $('#search_input').val();
            var link = "{{route('all.products')}}"+"?search_input="+search_input;
            window.location.href = link;
        });
    </script>
@endsection