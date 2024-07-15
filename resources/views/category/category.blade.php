@extends('dashboard.dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Categories</h3>
                </div>
                <div class="card-body">
                    
                    @if (session('delete'))
                        <strong class="text-danger">{{session('delete')}}</strong>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $sl=>$category)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>
                                    @if ($category->icon == null)
                                        <img width="50" src="{{asset('uploads/null.jpg')}}">
                                    @else
                                      <img width="70" src="{{asset('uploads/category/')}}/{{$category->icon}}">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('category.delete',$category->id)}}" class="btn btn-danger" title="delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add new category</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('add.category')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (session('success'))
                            <strong class="text-success">{{session('success')}}</strong>
                        @endif

                        <div class="form-group mb-3">
                            <label class="form-label">Category name</label>
                            <input class="form-control" type="text" name="category_name">
                            @error('category_name')
                                <strong class="text-danger">Enter category name.</strong>
                            @enderror
                        </div>
    
                        <div class="form-group mb-3">
                            <label class="form-label">Icon</label>
                            <input class="form-control" type="file" name="icon" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <div class="my-3">
                                <img width="100" id="blah"/>
                            </div>
                            @error('icon')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
    
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary w-100" type="submit"> Add category </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection