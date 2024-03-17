<?php

namespace App\Http\Controllers;

use App\Models\BagianPanduan;
use App\Models\SubBagianPanduan;
use App\Models\BukuBagianPanduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanduanController extends Controller
{
    public function panduan()
    {

        // $title = BukuBagianPanduan::select(['id', 'title', 'ordered', 'category', 'id_content'])->groupBy('id', 'title', 'ordered', 'category', 'id_content')->orderBy('id_content', 'Asc')->get();

        // $subjudul = BukuBagianPanduan::get();

        $nama_judul = BukuBagianPanduan::select(['id', 'title', 'ordered', 'category', 'id_content'])->groupBy('id', 'title', 'ordered', 'category', 'id_content')->orderBy('id_content', 'Asc')->get();

        $subjudul = BukuBagianPanduan::get();

        // dd($nama_judul);

        return view('panduan.panduan-page-v2', compact(['nama_judul', 'subjudul']));
    }

    public function add_panduan(Request $request)
    {
        $nama_judul = $request->input('nama_judul');
        $penomoran = $request->input('penomoran');
        $kategori = $request->input('kategori');
        $id_content = uniqid();

        $buku_bagian_panduan = new BukuBagianPanduan();
        $buku_bagian_panduan->title = $nama_judul;
        $buku_bagian_panduan->ordered = $penomoran;
        $buku_bagian_panduan->category = $kategori;
        $buku_bagian_panduan->id_content = $id_content;
        $buku_bagian_panduan->save();

        return back();
    }

    public function detail($id, $category)
    {
        if ($category == 'bagian') {
            $data = BagianPanduan::find($id);
        } else {
            $data = SubBagianPanduan::find($id);
        }

        return $data;
    }

    public function sub_judul($id)
    {
        // if ($category == 'bagian') {
        //     $data = BagianPanduan::find($id);
        // } else {
        //     $data = SubBagianPanduan::find($id);
        // }

        // return $data;

        $data = BukuBagianPanduan::where('id', $id)->get();
        // $data = BukuBagianPanduan::find($id);
        // dd($data);
        return $data;
    }

    public function update(Request $request, $id)
    {
        // if ($category == 'bagian') {
        //     $data = BagianPanduan::find($id);
        //     $data->content = $request->content;
        //     $data->save();
        // } else {
        //     $data = SubBagianPanduan::find($id);
        //     $data->content = $request->content;
        //     $data->save();
        // }

        $data = BukuBagianPanduan::find($id);
        $data->content = $request->content;
        $data->save();

        return $data;
    }

    public function search($keywords)
    {
        // Breakdown keyword to array
        $keyword = explode(' ', $keywords);

        // Raw Condition Multiple Keyword
        $condition = '';
        if (count($keyword) > 1) {
            foreach ($keyword as $key => $value) {
                $condition .= "UPPER(title) LIKE UPPER('%$value%') OR UPPER(content) LIKE UPPER('%$value%') OR ";
            }
            $condition = substr($condition, 0, -3);
        } else {
            $condition = "UPPER(title) LIKE UPPER('%$keywords%') OR UPPER(content) LIKE UPPER('%$keywords%')";
        }


        $data = DB::connection('pgsql')->select("SELECT id, title, content, 'bagian' as type FROM survey.tbl_bagian_panduan WHERE $condition UNION SELECT id, title, content, 'sub_bagian' as type FROM survey.tbl_sub_bagian_panduan WHERE $condition");

        return $data;
    }

    public function upload_image_content(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file_name = $request->file('upload')->getClientOriginalName();
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $request->file('upload')->move(public_path('panduan-asset'), $file_name);

            $url = env('APP_URL') . '/panduan-asset/' . $file_name;
            return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '');</script>";
        }
    }

    // delete judul panduan
    public function delete_panduan($id)
    {
        BukuBagianPanduan::find($id)->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    // update judul panduan

    public function edit_panduan($id)
    {
        $data = BukuBagianPanduan::find($id);
        return $data;
    }

    public function update_panduan(Request $request, $id)
    {

        $nama_judul = $request->input('nama_judul');
        $penomoran = $request->input('penomoran');
        $kategori = $request->input('kategori');

        $data = array(
            'title' => $nama_judul,
            'ordered' => $penomoran,
            'category' => $kategori,
        );

        BukuBagianPanduan::where('id', $id)->update($data);

        return response()->json([
            'success' => 'Record updated successfully!'
        ]);
    }
}
