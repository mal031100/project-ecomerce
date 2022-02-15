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
                        @error('category_id')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <select name="user_id">
                            <option value="{{Auth::User()->id}}">{{Auth::User()->name}}</option>
                        </select>
                        @error('user_id')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" id="">
                        @error('name')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price">
                        @error('price')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Sale</label>
                        <input type="number" class="form-control" name="sale">
                        @error('sale')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" name="amount">
                        @error('amount')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control" id="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Specifications</label>
                        <textarea class="form-control" name="summernote" id="summernote"></textarea>
                    </div>
                    <div class="col-md-12 " >
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection