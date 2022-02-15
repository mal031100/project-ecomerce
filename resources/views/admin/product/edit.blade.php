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
                                @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                          </select>
                          @error('category_id')
                              <small class="help-block">{{ $message }}</small>
                          @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="user_id" >
                            <option value="{{Auth::User()->id}}">{{Auth::User()->name}}</option>
                          </select>
                        @error('user_id')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" value="{{$product->name}}" name="name" id="">
                        @error('name')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Price</label>
                        <input type="number" class="form-control" value="{{$product->price}}" name="price">
                        @error('price')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Sale</label>
                        <input type="number" class="form-control" value="{{$product->sale}}" name="sale">
                        @error('sale')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" value="{{$product->amount}}" name="amount">
                        @error('amount')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    @if ($product->image)
                    <img src="{{asset('assets1/upload/product/'.$product->image)}}" width="200px" height="200px" alt="">
                    @endif
                    <div class="col-md-3 mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control" id="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Specifications</label>
                        <textarea class="form-control" name="summernote" id="summernote"></textarea>
                    </div>
                    <div class="col-md-12 ">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection