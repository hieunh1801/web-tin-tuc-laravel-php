<?php

namespace App\Http\Controllers;

// Third library
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Own
use App\Http\Requests\UserStoreRequest;
use App\User;

class UserController extends Controller
{
    ///////////////////
    // Lấy ra danh sách 
    ///////////////////
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach', ['user' => $user]);
    }

    ///////////////////
    // Thêm
    ///////////////////
    public function getThem()
    {
        return view('admin.user.them');
    }

    public function postThem(UserStoreRequest $request) 
    {
       
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Mã hóa mật khẩu
        $user->quyen = $request->quyen;

        $user->save();
        return redirect()->back()->withInput();
    }

    ///////////////////
    // Sửa 
    ///////////////////
    public function getSua($id)
    {

    }
    public function postSua(Request $request, $id)
    {

    }

    ///////////////////
    // Xóa
    ///////////////////
    public function getXoa($id) 
    {
    }

    ///////////////////
    // Xóa
    ///////////////////
    public function getDangNhapAdmin() 
    {
        return view('admin.login');
    }
    public function postDangNhapAdmin(Request $request) 
    {
        // $this->validate($request.all(), [
            
        // ], [

        // ]);
        if(Auth::attempt(['name' => $request->name, 'password' => $request->password, 'quyen' => 1 ])) 
        {
            return redirect('admin/theloai/danhsach');
        } else {
            return redirect()->back()->withInput()->with('thongbao', 'Đăng nhập thất bại');
        }
        
    }
    public function getDangXuat() 
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
