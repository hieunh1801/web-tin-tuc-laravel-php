<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    
    public function getDanhSach()
    {
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach', ['theloai' => $theloai]);
    }
    public function getThem()
    {
        return view('admin.theloai.them');

    }
    public function getSua($id)
    {
        $theloai = TheLoai::Find($id);
        return view('admin.theloai.sua', ['theloai' => $theloai]);

    }
    public function postSua(Request $request, $id)
    {
        $theloai = TheLoai::Find($id);
        $this->validate($request, 
        ['Ten' => 'required|min:3|max:100'],
        [
            'Ten.required' => 'Không được để trống',
            'Ten.min' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
            'Ten.max' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
        ]);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }

    public function postThem(Request $request) {
        $this->validate($request, 
        ['Ten' => 'required|min:3|max:100'],
        [
            'Ten.required' => 'Không được để trống',
            'Ten.min' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
            'Ten.max' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
        ]);
        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao', 'Thêm thành công');
    }

    public function getXoa($id) {
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao', 'Bạn đã xóa thành công');
    }
}
