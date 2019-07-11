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
        [
            'idLoaiTin' => 'required',
            // Yêu cầu phải có, min = 3, không trùng trong bảng TinTuc->cột tiêu để
            'TieuDe' => 'required|min:3|unique:TinTuc,TieuDe', 
            'TomTat' => 'required',
            'NoiDung' => 'required',
            'NoiBat' => 'required',
        ],
        [
            'idLoaiTin.required' => 'Bạn chưa chọn loại tin',
            'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'TieuDe.min' => 'Độ dài tiêu đề >= 3 kí tự',
            'TieuDe.unique' => 'Tiêu đề này bị trùng. Vui lòng nhập tiêu đề khác',
            'TomTat.required' => 'Yêu cầu nhập tóm tắt',
            'NoiDung.required' => 'Yêu cầu nhập nội dung',
            'NoiBat.required' => 'Yêu cầu chọn nổi bật',
        
        ]);
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->idLoaiTin = $request->idLoaiTin;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        
        // Kiểm tra xem có upload hình lên không
        if($request->hasFile('fileAnh')){
            $file = $request->file('fileAnh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg")
            {
                // return redirect('admin/tintuc/them')->with('loi', 'Chỉ được chọn file jpg, png, jpeg'); 
                return redirect()->back()->with('loi', 'Chỉ được chọn file jpg, png, jpeg');
            }

            $name = $file->getClientOriginalName();
            $tenhinh = str_random()."_".$name;
            while(file_exists("upload/tintuc/".$tenhinh)) {
                $tenhinh = str_random()."_".$name;
            }
            $file->move("upload/tintuc",$tenhinh);
            $tintuc->Hinh = $tenhinh;
        } else {
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao', 'Thêm tin tức thành công');
    }

    // Sửa
    public function getSua($id)
    {
        $tintuc = TinTuc::Find($id);
        $theloai = TheLoai::All();
        $loaitin = LoaiTin::All();
        return view('admin.tintuc.sua', ['tintuc' => $tintuc, 'theloai' => $theloai, 'loaitin' => $loaitin]);

    }
    public function postSua(Request $request, $id)
    {
        $tintuc = TinTuc::Find($id);
        
        $this->validate($request, 
        [
            'idLoaiTin' => 'required',
            // Yêu cầu phải có, min = 3, không trùng trong bảng TinTuc->cột tiêu để
            'TieuDe' => 'required|min:3', 
            'TomTat' => 'required',
            'NoiDung' => 'required',
            'NoiBat' => 'required',
        ],
        [
            'idLoaiTin.required' => 'Bạn chưa chọn loại tin',
            'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'TieuDe.min' => 'Độ dài tiêu đề >= 3 kí tự',
            'TomTat.required' => 'Yêu cầu nhập tóm tắt',
            'NoiDung.required' => 'Yêu cầu nhập nội dung',
            'NoiBat.required' => 'Yêu cầu chọn nổi bật',
        
        ]);
        $tintuc = TinTuc::Find($id);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->idLoaiTin = $request->idLoaiTin;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
        
        // Kiểm tra xem có upload hình lên không
        if($request->hasFile('fileAnh')){
            $file = $request->file('fileAnh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg")
            {
                // return redirect('admin/tintuc/them')->with('loi', 'Chỉ được chọn file jpg, png, jpeg'); 
                return redirect()->back()->with('loi', 'Chỉ được chọn file jpg, png, jpeg');
            }

            $name = $file->getClientOriginalName();
            $tenhinh = str_random()."_".$name;
            while(file_exists("upload/tintuc/".$tenhinh)) {
                $tenhinh = str_random()."_".$name;
            }
            $file->move("upload/tintuc",$tenhinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $tenhinh;
        } else {
            $tintuc->Hinh = "";
        }
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
