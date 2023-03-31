@extends('users.user')
@section('content')
    <div class="container-sm" style="margin: 0 auto;width: 50%">
        <!-- Page Heading -->
        <form action="{{route('user.return.handleReturnBook')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label" >Tên sách</label>
                <input type="text" class="form-control" name="title" value="{{$bookReturn['borrowingReturn']->book_name}}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label" >Giá bìa</label>
                <input type="text" class="form-control" name="title" value="{{number_format($bookReturn['borrowingReturn']->book_price, 0, ',', '.') }} VND">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label" >Ngày mượn</label>
                <input type="text" class="form-control" name="title" value="{{\Carbon\Carbon::parse($bookReturn['borrowingReturn']->borrowing_details_borrowed_date)->format('d-m-Y')}}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label" >Hạn trả </label>
                <input type="text" class="form-control" name="title" value="{{\Carbon\Carbon::parse($bookReturn['borrowingReturn']->borrowing_details_due_date)->format('d-m-Y')}}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label" >Ngày trả</label>
                <input type="text" class="form-control" name="title" value="{{\Carbon\Carbon::parse($bookReturn['borrowingReturn']->borrowing_details_returned_date)->format('d-m-Y')}}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label"
                       style="
                       color:{{$bookReturn['borrowingReturn']->borrowing_details_returned_date > $bookReturn['borrowingReturn']
                       ->borrowing_details_due_date ? '#f10404' : "#1cc88a"}}"
                >
                    Trạng thái: {{$bookReturn['borrowingReturn']->borrowing_details_returned_date > $bookReturn['borrowingReturn']->borrowing_details_due_date ? 'Quá hạn' : "Đúng hạn"}}
                </label>
            </div>
            @if($bookReturn['borrowingReturn']->borrowing_details_returned_date > $bookReturn['borrowingReturn']->borrowing_details_due_date)
                <div class="mb-3">
                    <label for="title" class="form-label"> Tiền phạt :{{number_format(($bookReturn['borrowingReturn']->book_price)/5, 0, ',', '.') }} VND</label>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Trả sách</button>
        </form>
    </div>
@endsection
