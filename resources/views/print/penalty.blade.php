<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Phiếu phạt</title>
    <style>
        body {
            font-family: Arial, serif;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            font-size: 12px;
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }
    </style>
</head>
<body>
<h1>Phiếu phạt</h1>
<h2>Thông tin đọc giả</h2>
<table>
    <tr>
        <th>Mã đọc giả</th>
        <td>{{$reader->reader_barcode}}</td>
    </tr>
    <tr>
        <th>Họ tên</th>
        <td>{{$reader->reader_name}}</td>
    </tr>

</table>
<h2>Danh sách sách còn mượn</h2>
<table>
    <tr>
        <th>STT</th>
        <th>Tên sách</th>
        <th>Tác giả</th>
        <th>Mã sách</th>
        <th>Ngày mượn</th>
        <th>Ngày phải trả</th>
        <th>Ngày trả</th>
        <th>Số tiền phạt</th>
    </tr>
    @foreach($penalty_lists as $index => $penalty_list)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{$penalty_list->book_name}}</td>
            <td>{{$penalty_list->book_author}}</td>
            <td>{{$penalty_list->book_barcode}}</td>
            <td>{{\Carbon\Carbon::parse($penalty_list->borrowing_details_borrowed_date)->format('d-m-Y')}}</td>
            <td>{{\Carbon\Carbon::parse($penalty_list->borrowing_details_due_date)->format('d-m-Y')}}</td>
            <td>{{\Carbon\Carbon::parse($penalty_list->borrowing_details_returned_date)->format('d-m-Y')}}</td>
            <td>{{number_format(($penalty_list->borrowing_details_penalty_fee), 0, ',', '.') }} VND</td>
        </tr>
    @endforeach
</table>
@php
    $sum_penalty= 0;
    foreach ($penalty_lists as $index => $penalty_list) {
        if (!empty($penalty_list->borrowing_details_penalty_fee)){
            $sum_penalty+=$penalty_list->borrowing_details_penalty_fee;
        }
    }
    echo 'Tổng tiền phạt :'.number_format(($sum_penalty), 0, ',', '.'). ' VND '
@endphp
</body>
</html>
