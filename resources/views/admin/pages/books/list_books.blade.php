@extends('admin.admin')
@section('content')
    <div class="d;-sm-flex align-items-center justify-content-between mb-4 py-2">
        <a href="{{route('admin.book.add')}}" class="btn btn-success m-2">Thêm sách</a>
        <table class="table">
            <thead>
            <tr class="text-center">
                <th scope="col">STT</th>
                <th scope="col">Tên sách</th>
                <th scope="col">Tác giả</th>
                <th scope="col">Năm xuất bản</th>
                <th scope="col">Giá tiền</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Mô tả</th>
                <th>Chi tiết</th>
            </tr>
            </thead>
            <tbody>
{{--            @if(count($books))--}}
{{--                <tr class="text-center">--}}
{{--                    <td colspan="6"> Không tìm thấy sách nào !</td>--}}
{{--                </tr>--}}
{{--            @else--}}
                @foreach($books as $index => $book)
                    <tr class="text-center">
                        <td>{{((request()->get('page') != null ? request()->get('page'):1)-1)*(count($books))+$index+1}}</td>
                        <td class="text-left">{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td>{{$book->year}}</td>
                        <td>{{ number_format($book->price, 0, ',', '.') }} VND</td>
                        <td>{{$book->quantity}}</td>
                        <td class="text-left">{{$book->description}}</td>
                        <td>
                            <a href="{{route('admin.book.update',['id_book'=>$book->id])}}"><i
                                    class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
{{--            @endif--}}
            </tbody>
        </table>
        {!! $books->links() !!}
    </div>
    @if(session('successAdd') || session('errorAdd') )
        <script>
            Swal.fire({
                position: 'top-end',
                icon: '{{!empty(session('successAdd')) ? 'success':'error'}}',
                title: '{{!empty(session('successAdd')) ? session('successAdd'):session('errorAdd')}}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if(session('successUpdate') || session('errorUpdate') )
        <script>
            Swal.fire({
                position: 'top-end',
                icon: '{{!empty(session('successUpdate')) ? 'success':'error'}}',
                title: '{{!empty(session('successUpdate')) ? session('successUpdate'):session('errorUpdate')}}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if(session('successDelete') || session('errorDelete') )
        <script>
            Swal.fire({
                position: 'top-end',
                icon: '{{!empty(session('successDelete')) ? 'success':'error'}}',
                title: '{{!empty(session('successDelete')) ? session('successDelete'):session('errorDelete')}}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
