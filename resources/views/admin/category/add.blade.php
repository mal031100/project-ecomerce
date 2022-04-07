@extends('admin.master')
@section('content')
    <div class="cart">
        <div class="card-header">
            <h3>Add Category</h3>
        </div>
        <div class="card-body">
            <form action="{{url('amin/category/insert-category')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">father theme</label>
                        <select name="category_id" class="form-control" style="width:50%">
                            <option value = "">[--Chọn danh mục--]</option>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description">
                        @error('description')
                            <small class="help-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>    
@endsection