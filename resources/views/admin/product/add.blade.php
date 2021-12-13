@extends('admin.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('amin/product/insert-product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="category_id" >
                            <option value="">Select a category</option>
                                @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                          </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="user_id" >
                            <option value="">Select a user</option>
                                @foreach ($user as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                          </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" id="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Sale</label>
                        <input type="number" class="form-control" name="sale">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" name="amount">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control" id="">
                    </div>
                    <div class="col-md-12 ">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection