@extends('users.user')
@section('content')
    <div class="d-flex mb-4 py-2">
        <!-- Page Heading -->
        <div class="readerInfo border-right px-3 ">
            <h5>Thông tin đọc giả</h5>
            <div class="mb-1">
                <label for="title" class="form-label"> Họ và tên </label>
                <p class="form-control">{{$readerInfo['reader']->readers_name}}</p>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Ngày sinh</label>
                <p class="form-control">{{\Carbon\Carbon::parse($readerInfo['reader']->readers_date_of_birth)->format('d-m-Y')}}</p>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label"> Địa chỉ </label>
                <p class="form-control">{{$readerInfo['reader']->readers_address}}</p>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label"> Số điên thoại </label>
                <p class="form-control">{{$readerInfo['reader']->readers_phone}}</p>
            </div>
            <div class="mb-4">
                <form class="d-none d-sm-inline-block form-inline navbar-search" method="post"
                      action="{{route('user.book.bookBarcodes')}}">
                    <div class="input-group rounded border ">
                        @csrf
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Thêm sách...."
                               aria-label="bookBarcode" aria-describedby="basic-addon2" name="bookBarcode"
                        >
                        @error("bookBarcode")
                        <span style="color: #ff0000">{{$message}}</span>
                        @enderror
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-4">
                <form class="d-none d-sm-inline-block form-inline navbar-search" method="get"
                      action="{{route('user.return.showBook')}}">
                    <div class="input-group rounded border">
                        @csrf
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Trả sách...."
                               aria-label="bookBarcode" aria-describedby="basic-addon2" name="bookBarcode"
                        >
                        @error("bookBarcode")
                        <span style="color: #ff0000">{{$message}}</span>
                        @enderror
                        <div class="input-group-append">
                            <button class="btn btn-danger" type="submit">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-3">
                <a href="{{route('user.print.bookBill',['reader_id'=>$readerInfo['reader']->readers_id,'borrowing_id'=>$readerInfo['reader']->borrowing_id])}}"
                   class="btn btn-success">In hóa đơn</a>
            </div>
            <div class="mb-3">
                <a href="{{route('user.print.penaltyBill',['reader_id'=>$readerInfo['reader']->readers_id,'borrowing_id'=>$readerInfo['reader']->borrowing_id])}}"
                   class="btn btn-danger">In phiếu phạt </a>
            </div>
        </div>
        <div class="borrowingDetail flex-grow-1 px-2">
            <h5 class="text-center">Danh sách sách đang mượn</h5>
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th scope="col">STT</th>
                    <th scope="col">Tên sách</th>
                    <th scope="col">Giá bìa</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Ngày mượn</th>
                    <th scope="col">Hạn trả</th>
                </tr>
                </thead>
                <tbody>
                @if(count($readerInfo['borrowingDetail']) == 0)
                    <tr class="text-center">
                        <td colspan="6">Chưa có sách nào được mượn !</td>
                    </tr>x`
                @else
                    @foreach($readerInfo['borrowingDetail'] as $index => $borrowingDetail)
                        <tr class="text-center">
                            <td class="col-1">{{$index+1}}</td>
                            <td>{{$borrowingDetail->book_name}}</td>
                            <td>{{number_format($borrowingDetail->book_price, 0, ',', '.') }}</td>
                            <td>{{$borrowingDetail->borrowing_details_quantity}}</td>
                            <td>{{\Carbon\Carbon::parse($borrowingDetail->borrowing_details_borrowed_date)->format('d-m-Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($borrowingDetail->borrowing_details_due_date)->format('d-m-Y')}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @if(session('successAdd') || session('errorAdd') )
        <script>
            Swal.fire({
                position: 'top',
                icon: '{{!empty(session('successAdd')) ? 'success':'error'}}',
                title: '{{!empty(session('successAdd')) ? session('successAdd'):session('errorAdd')}}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if(session('successDelete'))
        <script>
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: '{{session('successDelete')}}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
