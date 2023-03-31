@extends('admin.admin')
@section('content')
    <div class="container-sm" style="margin: 0 auto;width: 50%">
        <!-- Page Heading -->
        <form action="{{'admin.book.handleUpdateBook'}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Tên sách</label>
                <input type="text" class="form-control" name="title" value="{{$book->title ?? old('title')}}">
                @error("title")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Tác giả</label>
                <input type="text" class="form-control" name="author" value="{{$book->author ?? old('author')}}">
                @error("author")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Năm xuất bản</label>
                <input type="number" min="0" class="form-control" name="year" value="{{$book->year ?? old('year')}}">
                @error("year")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá tiền</label>
                <input type="number" min="0" class="form-control" name="price" value="{{number_format($book->price, 0, ',', '') ?? old('price')}}">
                @error("price")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" min="0" class="form-control" name="quantity" value="{{$book->quantity ?? old('quantity')}}">
                @error("quantity")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="floatingTextarea">Mô tả</label>
                <textarea class="form-control" placeholder="Mô tả...." id="floatingTextarea"
                          name="description">{{$book->description ?? old('description')}}</textarea>
                @error("description")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3 d-flex align-items-center justify-content-between">
                <button type="submit" class="btn btn-success">Cập nhật</button>
                <a href="{{route('admin.book.deleteBook')}}" style="color: #ee0202"><i class="fas fa-trash"></i></a>
            </div>
        </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
