@extends('admin.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('amin/product/update-product/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="category_id" >
                            <option value="">{{$product->category->name}}</option>
                          </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="user_id" >
                            <option value="">{{$product->user->name}}</option>
                          </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" value="{{$product->name}}" name="name" id="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Price</label>
                        <input type="number" class="form-control" value="{{$product->price}}" name="price">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Sale</label>
                        <input type="number" class="form-control" value="{{$product->sale}}" name="sale">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" value="{{$product->amount}}" name="amount">
                    </div>
                    @if ($product->image)
                    <img src="{{asset('assets1/upload/product/'.$product->image)}}" alt="">
                    @endif
                    <div class="col-md-3 mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control" id="">
                    </div>
                    <div class="col-md-12 ">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection