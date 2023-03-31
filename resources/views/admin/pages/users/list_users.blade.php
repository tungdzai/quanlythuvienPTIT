@extends('admin.admin')
@section('content')
    <div class="d;-sm-flex align-items-center justify-content-between mb-4 py-2">
        <a href="{{route('admin.user.add')}}" class="btn btn-success m-2">Thêm nhân viên</a>
        <table class="table">
            <thead>
            <tr class="text-center">
                <th scope="col">STT</th>
                <th scope="col">Email</th>
                <th scope="col">Họ và tên</th>
                <th scope="col">Ngày sinh </th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Chi tiết</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $index => $user)
                <tr class="text-center">
                    <td>{{$index+1}}</td>
                    <td class="text-left">{{$user->email}}</td>
                    <td>{{$user->full_name}}</td>
                    <td>{{\Carbon\Carbon::parse($user->birthday)->format('d-m-Y')}}</td>
                    <td style="{{$user->status == 1 ? "color:#1cc88a" : "color:#be0a0a "}}">{{$user->status == 1 ? "Hoạt động":"Tạm khóa"}}</td>
                    <td>
                        <a href="#"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
