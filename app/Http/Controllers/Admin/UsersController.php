<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RegisterUser;
use Illuminate\Http\Request;
use App\Repositories\Admin\Users\UsersRepositoryInterface;
use App\Http\Requests\Users\PostRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public $usersRepository;

    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function index()
    {
        $users = $this->usersRepository->allUsers();
        $data['users'] = $users;
        return view('admin.pages.users.list_users', $data);
    }

    public function addUser()
    {
        return view('admin.pages.users.add');
    }

    public function handleAddUser(PostRequest $request)
    {
        $password=Str::random(20);
        $user = [
            "email" => $request->input('email'),
            "full_name" => $request->input('name'),
            "birthday" => $request->input('birthday'),
            'password'=>bcrypt($password),
            'status'=>true,
            'created_at' => Date(Carbon::now('Asia/Ho_Chi_Minh')),
        ];
        $status = $this->usersRepository->addUser($user);
        if ($status) {
            session()->flash("successAdd", 'Thêm mới thành công');
        }

        session()->flash("errorAdd", 'Thêm mới không thành công !');
        Mail::to($request->input('email'))->send(new RegisterUser($request->input('email'),$password));
        return redirect()->route('admin.users');
    }
}
