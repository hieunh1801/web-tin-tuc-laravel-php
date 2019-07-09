<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LoaiTin;

class AjaxController extends Controller
{
    public function getLoaiTin($idTheLoai)
    {
        $loaitin = LoaiTin::where('idTheLoai', $idTheLoai)->get();
        foreach ($loaitin as $item) {
            echo " <option value='".$loaitin."'>".$item->Ten."</option>";
        }
    }
}
