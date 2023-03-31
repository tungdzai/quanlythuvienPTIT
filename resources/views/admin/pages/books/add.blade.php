@extends('admin.admin')
@section('content')
    <div class="container-sm" style="margin: 0 auto;width: 50%">
        <!-- Page Heading -->
        <form action="{{route('admin.book.handleAddBook')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label" >Tên sách</label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}">
                @error("title")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="author" class="form-label" >Tác giả</label>
                <input type="text" class="form-control" name="author" value="{{old('author')}}">
                @error("author")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="year" class="form-label" >Năm xuất bản</label>
                <input type="number" min="0" class="form-control" name="year" value="{{old('year')}}">

            </div>
            <div class="mb-3">
                <label for="price" class="form-label" >Giá tiền</label>
                <input type="number" min="0" class="form-control" name="price" value="{{old('price')}}">
                @error("price")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label" >Số lượng</label>
                <input type="number" min="0" class="form-control" name="quantity" value="{{old('quantity')}}">
                @error("quantity")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="floatingTextarea">Mô tả</label>
                <textarea class="form-control" placeholder="Mô tả...." id="floatingTextarea" name="description">{{old('description')}}</textarea>
                @error("description")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Thêm sách</button>
        </form>
    </div>
@endsection
