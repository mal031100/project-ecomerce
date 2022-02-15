@extends('admin.master')
@section('content')
{{-- {{dd($categories)}} --}}
<div class="card">
    <div class="card-header">
        <h4>Edit Category</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('amin/category/update-category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="">father theme</label>
                    <select name="category_id" class="form-control" style="width:50%">
                        <option value = "">[--Chọn danh mục--]</option>
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}" {{$category->category_id == $item->id? 'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" value="{{$category->name}}" name="name" id="">
                    @error('name')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Description</label>
                    <input type="text" class="form-control" value="{{$category->description}}" name="description">
                    @error('description')
                        <small class="help-block">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-12 ">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection