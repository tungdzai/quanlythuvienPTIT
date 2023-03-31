@extends('users.user')
@section('content')
    <div class="container-sm" style="margin: 0 auto;width: 50%">
        <!-- Page Heading -->
        <form action="{{route('user.reader.handleBarcode')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="barcode" class="form-label" >Barcode</label>
                <input type="text"  class="form-control" name="barcode" value="{{old('barcode')}}">
                @error("barcode")
                <span style="color: #ff0000">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-facebook">Tìm kiếm </button>
        </form>
    </div>

@endsection
