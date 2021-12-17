@extends('admin.master')
@section('content')
@if (session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
@endif

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">DataTables</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">DataTables</li>
      </ol>
    </div>
    <form action="" method="get" class="form-inline mb-3">
      <div class="form-group">
          <input class="form-control" name="search" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-primary">
          <i class="fas fa-search"></i>
      </button>
    </form>

    <!-- Row -->
    <div class="row">
      <!-- Datatables -->
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Product page</h6>
          </div>
          <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                      <th>STT</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Sale</th>
                      <th>Amount</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($product as $item)

                    <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->category->name}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->sale}}</td>
                      <td>{{$item->amount}}</td>
                      <td><img src="{{asset('assets1/upload/product/'.$item->image)}}" alt="Image hero" height="70px" width="70px"></td>
                      <td>
                        <a href="{{url('amin/product/edit-product/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{url('amin/product/delete-product/'.$item->id)}}" class="btn btn-danger btn-sm">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
            {{$product->appends(request()->all())->links()}}
          </div>
        </div>
      </div>
    </div>
</div>


@endsection