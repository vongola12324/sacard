<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:user.manage|user.view', [
            'only' => [
                'index',
                'show',
            ],
        ]);
        $this->middleware('permission:user.manage', [
            'only' => [
                'edit',
                'update',
                'destroy',
            ],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('id')->paginate();

        return view('user.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('user.edit', compact(['user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $user->name = $request->get('name');
        //管理員禁止去除自己的管理員職務
        $keepAdmin = false;
        if ($user->id == auth()->user()->id) {
            $keepAdmin = true;
        }
        //移除原有權限
        $user->detachRoles($user->roles);
        //重新添加該有的權限
        if ($request->has('role')) {
            $user->attachRoles($request->get('role'));
        }
        //加回管理員
        if ($keepAdmin) {
            $admin = Role::where('name', '=', 'Admin')->first();
            $user->attachRole($admin);
        }
        //儲存資料
        $user->save();

        return redirect()->route('user.show', $user)
            ->with('global', '資料修改完成。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->hasRole('Admin')) {
            return redirect()->route('user.show', $user)
                ->with('warning', '無法刪除管理員，請先解除管理員角色。');
        }
        $user->delete();

        return redirect()->route('user.index')
            ->with('global', '會員已刪除。');
    }
}
