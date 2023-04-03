@extends('admin.admin')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h5 mb-0 text-gray-800">Thống kê sách theo lượt mượn</h3>
    </div>
    <div class="container-sm">
        <!-- Page Heading -->
        <form action="{{route('admin.histories.handleBookBorrow')}}" method="post">
            @csrf
            <div class="card mb-7">
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col-lg-5">
                            <label class="d-flex align-items-center mb-2">Từ ngày</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control-solid ps-12 flatpickr-input" name="start_date"
                                       type="date" value="{{$start_date??null}}"
                                >
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label class="d-flex align-items-center mb-2">Đến ngày</label>
                            <div class="position-relative d-flex align-items-center">
                                <input class="form-control form-control-solid ps-12 flatpickr-input" name="end_date"
                                       type="date" value="{{$end_date??null}}"
                                >
                            </div>
                        </div>
                        <div class="col-lg-2 d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container-sm mt-5 mb-3">
        <div class="card">
            <div class="card-header border-0 pt-3">
                <h5>Danh sách sách được mượn :</h5>
            </div>
        </div>
        <div class="card border-top-0">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th scope="col">STT</th>
                    <th scope="col">Mã sách</th>
                    <th scope="col"> Tên sách</th>
                    <th scope="col">Tác giả</th>
                    <th scope="col">Tổng số lượt mượn</th>
                </tr>
                </thead>
                @foreach($historyBooksBorrow as $index =>$historyBookBorrow)
                    <tr class="text-center">
                        <td>{{$index+1}}</td>
                        <td class="text-left">{{$historyBookBorrow->book_barcode}}</td>
                        <td class="text-left pl-lg-5">
                            <a href="{{route('admin.histories.listReader',['barcode'=>$historyBookBorrow->book_barcode])}}" style="text-decoration: none">{{$historyBookBorrow->book_name}}</a>
                        </td>
                        <td class="text-left pl-lg-5">{{$historyBookBorrow->book_author}}</td>
                        <td>{{$historyBookBorrow->borrow_count}}</td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="mt-5" style="text-decoration: none"><i class="fas fa-backward"></i>&nbsp;Quay lại</a>

@endsection
