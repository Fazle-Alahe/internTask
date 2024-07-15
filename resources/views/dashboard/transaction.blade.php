@extends('dashboard.dashboard')
@section('content')
    <div class="row">

        <div class="col-lg-4">
            <input type="text" id="search_input" placeholder="Search..." class="form-control inputt">
            <button type="submit" class="btnn search-btn"><i class="fa fa-search"></i></button>
        </div>
        @can('admin_transaction')
            <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3>All Transaction</h3>
                    </div>
                    @if (session('delete'))
                        <div class="alert alert-danger mt-2">{{session('delete')}}</div>
                    @endif
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Customer Name</th>
                                <th>Transaction No</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($admin_transactions as $sl=>$admin_transaction)
                                <tr>
                                    <td>{{$sl+1}}</td>
                                    <td>{{$admin_transaction->product_name}}</td>
                                    <td>{{$admin_transaction->customer_name}}</td>
                                    <td>{{$admin_transaction->transaction_no}}</td>
                                    @can('admin_transaction')
                                        <td>
                                            <a class="btn btn-danger" href="{{route('delete.transaction', $admin_transaction->id)}}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="mt-1">
                    {{$admin_transactions->links()}}
                </div>
            </div>
        @endcan

        @can('user_transaction')
            
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3>All Transaction</h3>
                </div>
                @if (session('delete'))
                    <div class="alert alert-danger mt-2">{{session('delete')}}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Transaction No</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($transactions as $sl=>$transaction)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$transaction->product_name}}</td>
                                <td>{{$transaction->customer_name}}</td>
                                <td>{{$transaction->transaction_no}}</td>
                                @can('admin_transaction')
                                    <td>
                                        <a class="btn btn-danger" href="{{route('delete.transaction', $transaction->id)}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="mt-1">
                {{$transactions->links()}}
            </div>
        </div>
        @endcan
    </div>
    
@endsection
@section('footer_script')
    <script>
        $('.search-btn').click(function(){
            var search_input = $('#search_input').val();
            var link = "{{route('transaction.list')}}"+"?search_input="+search_input;
            window.location.href = link;
        });
    </script>
@endsection