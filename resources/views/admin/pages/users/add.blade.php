@extends('admin.admin')
@section('content')
    <div class="container-sm" style="margin: 0 auto;width: 50%">
        <!-- Page Heading -->
        <form action="{{route('admin.user.handleAddUser')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label" >Email</label>
                <input type="text" class="form-control" name="email" value="{{old('email')}}">
                @error("email")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label" >Họ và tên</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}">
                @error("name")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label" >Ngày sinh</label>
                <input type="date" class="form-control" name="birthday" value="{{old('birthday')}}">
                @error("birthday")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
        </form>
    </div>
@endsection
