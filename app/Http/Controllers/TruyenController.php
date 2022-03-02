<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Theloai;
use App\Models\ThuocDanh;
use App\Models\ThuocLoai;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_truyen = Truyen::with('danhmuctruyen','theloai')->orderBy('id', 'desc')->get();
        return view('admincp.truyen.index')->with(compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = Theloai::orderBy('id', 'desc')->get();
        $danhmuc = DanhmucTruyen::orderBy('id', 'desc')->get();
        return view('admincp.truyen.create')->with(compact('danhmuc','theloai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'tentruyen' => 'required|unique:truyen|max:255',
                'slug_truyen' => 'required|unique:truyen|max:255',
                'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=3000',
                'tomtat' => 'required',
                'trangthai' => 'required',
                'truyennoibat' => 'required',
                'tacgia' => 'required',
                'danhmuc' => 'required',
                'theloai' => 'required'
            ],
            [
                'tentruyen.unique' => 'Tên truyện đã có, điền tên khác!',
                'slug_truyen.unique' => 'slug truyện đã có, điền tên khác!',
                'tentruyen.required' => 'Chưa nhập tên truyện!',
                'tomtat.required' => 'Chưa nhập mô tả truyện!',
                'tacgia.required' => 'Chưa nhập tác giả!',
                'slug_truyen.required' => 'Chưa nhập slug truyện!',
                'hinhanh.required' => 'Chưa có hình ảnh!'
            ]
        );
        $data = $request->all();
        $truyen = new Truyen();
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->slug_truyen = $data['slug_truyen'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->trangthai = $data['trangthai'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->truyen_noibat = $data['truyennoibat'];
        $truyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        foreach ($data['danhmuc'] as $key => $danh){
            $truyen->danhmuc_id = $danh[0];
        }
        foreach ($data['theloai'] as $key => $the){
            $truyen->theloai_id = $the[0];
        }
        //them anh
        $get_image = $request->hinhanh;
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalName();
        $get_image->move($path,$new_image);

        $truyen->hinhanh = $new_image;
        $truyen->save();

        $truyen->thuocnhieudanhmuctruyen()->attach($data['danhmuc']);
        $truyen->thuocnhieutheloaitruyen()->attach($data['theloai']);

        return redirect()->back()->with('status','Thêm truyện thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truyen = Truyen::find($id);
        $theloai = Theloai::orderBy('id', 'desc')->get();
        $danhmuc = DanhmucTruyen::orderBy('id', 'desc')->get();
        return view('admincp.truyen.edit')->with(compact('truyen','danhmuc','theloai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'tentruyen' => 'required|max:255',
                'slug_truyen' => 'required|max:255',
                'tomtat' => 'required',
                'trangthai' => 'required',
                'truyennoibat' => 'required',
                'tacgia' => 'required',
                'danhmuc' => 'required',
                'theloai' => 'required'
            ],
            [
                
                'tentruyen.required' => 'Chưa nhập tên truyện!',
                'tomtat.required' => 'Chưa nhập mô tả truyện!',
                'tacgia.required' => 'Chưa nhập tác giả!',
                'slug_truyen.required' => 'Chưa nhập slug truyện!',
            ]
        );
        // $data = $request->all();
        $truyen = Truyen::find($id);
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->slug_truyen = $data['slug_truyen'];
        $truyen->theloai_id = $data['theloai'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->trangthai = $data['trangthai'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->danhmuc_id = $data['danhmuc'];
        $truyen->truyen_noibat = $data['truyennoibat'];

        $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        //them anh
        $get_image = $request->hinhanh;
        if($get_image){
            $path = 'public/uploads/truyen/'.$truyen->hinhanh;
            if(file_exists($path)){
                unlink($path);
            }
            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalName();
            $get_image->move($path,$new_image);

            $truyen->hinhanh = $new_image;
        }
        $truyen->save();

        return redirect()->back()->with('status','Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truyen = Truyen::find($id);
        $path = 'public/uploads/truyen/'.$truyen->hinhanh;
        if(file_exists($path)){
            unlink($path);
        }
        Truyen::find($id)->delete();
        return redirect()->back()->with('status','Xóa truyện thành công!');
    }
    public function truyennoibat(Request $request){
        $data = $request->all();
        $truyen = Truyen::find($data['truyen_id']);
        $truyen->truyen_noibat = $data['truyennoibat'];
        $truyen->save();
    }
}
