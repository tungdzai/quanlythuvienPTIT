@extends('admin.admin')
@section('content')
    <div class="container-sm mt-5">
        <div class="card">
            <div class="card-header border-0 pt-3">
                <h5>Danh sách đọc giả mượn sách:{{$historyReader['book_name']->title}}</h5>
            </div>
        </div>
        <div class="card border-top-0 mb">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th scope="col">STT</th>
                    <th scope="col">Ngày mượn</th>
                    <th scope="col">Độc giả </th>
                    <th scope="col">Ngày trả</th>
                    <th scope="col">Tiền phạt</th>
                </tr>
                </thead>
                <tbody>
                @foreach($historyReader['reader_list'] as $index => $reader)
                    <tr class="text-center">
                        <td>{{$index+1}}</td>
                        <td>{{$reader->name}}</td>
                        <td>{{$reader->borrowed_date}}</td>
                        <td>{{$reader->returned_date}}</td>
                        <td>{{$reader->penalty_fee}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ url()->previous() }}" class="mt-5" style="text-decoration: none"><i class="fas fa-backward"></i>&nbsp;Quay lại</a>
    </div>
@endsection
