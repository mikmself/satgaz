<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('dashboard.user.index', compact('users'));
    }
    public function create()
    {
        return view('dashboard.user.create');
    }
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $this->userService->createUser($data);
        return response(redirect(route('index-user'))->with('success','User berhasil dibuat'));
    }
    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        return view('dashboard.user.edit', compact('user'));
    }
    public function update(UserRequest $request, $id)
    {
        $user = $this->userService->getUserById($id);
        $data = $request->validated();
        $this->userService->updateUser($user, $data);
        return response(redirect(route('index-user'))->with('success','User berhasil diupdate'));
    }
    public function destroy($id)
    {
        $user = $this->userService->getUserById($id);
        $this->userService->deleteUser($user);
        return response(redirect(route('index-user'))->with('success','User berhasil dihapus'));
    }
}
