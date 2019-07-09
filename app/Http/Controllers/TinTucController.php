<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;

class TinTucController extends Controller
{
    // Lấy ra danh sách 
    public function getDanhSach()
    {
        $tintuc = TinTuc::orderBy('id', 'DESC')->get();
        return view('admin.tintuc.danhsach', ['tintuc' => $tintuc]);
    }

    // Thêm
    public function getThem()
    {
        $theloai = TheLoai::All();
        $loaitin = LoaiTin::All();
        return view('admin.tintuc.them', ['theloai' => $theloai, 'loaitin' => $loaitin]);

    }

    public function postThem(Request $request) {
        $this->validate($request, 
        ['Ten' => 'required|min:3|max:100'],
        [
            'Ten.required' => 'Không được để trống',
            'Ten.min' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
            'Ten.max' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
        ]);
        $tintuc = new TinTuc;
        $tintuc->Ten = $request->Ten;
        $tintuc->TenKhongDau = changeTitle($request->Ten);
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao', 'Thêm thành công');
    }

    // Sửa
    public function getSua($id)
    {
        $tintuc = TinTuc::Find($id);
        return view('admin.tintuc.sua', ['tintuc' => $tintuc]);

    }
    public function postSua(Request $request, $id)
    {
        $tintuc = TinTuc::Find($id);
        $this->validate($request, 
        ['Ten' => 'required|min:3|max:100'],
        [
            'Ten.required' => 'Không được để trống',
            'Ten.min' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
            'Ten.max' => 'Tên thể loại phải có độ dài từ 3 tới 100 kí tự',
        ]);
        $tintuc->Ten = $request->Ten;
        $tintuc->TenKhongDau = changeTitle($request->Ten);
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Sửa thành công');

    }

    // Xóa
    public function getXoa($id) {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Bạn đã xóa thành công');
    }
}
