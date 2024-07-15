@extends('dashboard.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header  d-flex justify-content-between">
                <h3>Update Product</h3>
                {{-- <a href="{{route('product.list')}}" class="btn btn-primary"><i data-feather="list"></i>Product List</a> --}}
            </div>
            <div class="card-body">
                <form action="{{route('product.update',$products->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-control category" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option {{$category->id == $products->category_id ? 'selected' : ''}} 
                                        value="{{$category->id == $products->category_id ? $category->id : ''}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Subcategory</label>
                                <select class="form-control subcategory" name="subcategory_id">
                                    @foreach ($subcategories as $subcategory)
                                        <option {{$subcategory->id == $products->subcategory_id ? 'selected' : ''}} 
                                            value="{{$subcategory->id == $products->subcategory_id ? $subcategory->id : ''}}">{{$subcategory->subcategory_name}}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product_name" value="{{$products->product_name}}">
                                @error('product_name')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Product Price</label>
                                <input type="number" class="form-control" name="product_price" value="{{$products->product_price}}">
                                @error('product_price')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Discount (%)</label>
                                <input type="number" class="form-control" name="discount">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Short Description</label>
                                <input type="text" class="form-control" name="short_desp" value="{{$products->short_desp}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Preview Image</label>
                                <input type="file" class="form-control" name="prev_img" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                <img width="150" src="{{asset('uploads/products/')}}/{{$products->prev_img}}" id="blah" alt="">
                                @error('prev_img')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 m-auto">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100">Update Product</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    <script>
        $('.category').change(function() {
            let category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'/getsubcategory',
                type: 'POST',
                data:{'category_id': category_id},

                success:function(data){
                    $('.subcategory').html(data);
                }
            });

        })
    </script>
@endsection