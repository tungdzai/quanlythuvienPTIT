<?php
return [
    'errors' => [
        'required' => ':attribute không được để trống ! ',
        'min' => ':attribute tối thiểu :min kí tự !',
        'max' => ':attribute tối đa :max kí tự ! ',
        'unique' => ':attribute đã tồn tại trên hệ thống !',
        'format' => ':attribute chưa đúng định dạng!',
        'image' => ':attribute là file png , jpg ,jpeg !',
        'exists' => ":attribute không tồi tại trên hệ thống !",
        'confirmed' => ":attribute không trùng khớp !",
        'regex' => ":attribute chưa đúng định dạng !",
        'birthday_18'=>" Nhân viên  :attribute chưa đủ 18 tuổi !",
    ],
    'attributesLogin' => [
        'email'=>"Email",
        'password'=>'Mật khẩu '
    ],
    'attributes'=>[
        'book'=>[
            'title'=>'Tên sách',
            'author'=>'Tác giả',
            'year'=>'Năm xuất bản',
            'price'=>'Giá ',
            'quantity'=>'Số lượng ',
            'description'=>'Mô tả ',

        ],
        'user'=>[
            'email'=>'Email',
            'name' =>"Họ và tên ",
            'birthday'=>"Ngày sinh",
        ]
    ]
];
