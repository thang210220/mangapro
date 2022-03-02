<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Chapter;
use App\Models\Truyen;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapter = Chapter::with('truyen')->orderBy('id','DESC')->get();
        return view('admincp.chapter.index')->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admincp.chapter.create')->with(compact('truyen'));
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
                'tieude' => 'required|unique:chapter|max:255',
                'slug_chapter' => 'required|unique:chapter|max:255',
                
                'noidung' => 'required',
                'truyen_id' => 'required',
            ],
            [
                'slug_chapter.unique' => 'Slug truyện đã có, điền tên khác!',
                'tieude.unique' => 'Tiêu đề đã có, điền tên khác!',
                'tieude.required' => 'Chưa nhập tiêu đề!',
                'noidung.required' => 'Chưa nhập nội dung chapter!',
                'slug_chapter.required' => 'Chưa nhập slug chapter!',
            ]
        );
        // $data = $request->all();
        $chapter = new Chapter();
        $chapter->tieude = $data['tieude'];
        
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->noidung = $data['noidung'];
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        $chapter->save();

        return redirect()->back()->with('status','Thêm chapter thành công');
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
        $chapter = Chapter::find($id);
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admincp.chapter.edit')->with(compact('truyen','chapter'));
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
                'tieude' => 'required|max:255',
                'slug_chapter' => 'required|max:255',
                
                'noidung' => 'required',
                'truyen_id' => 'required',
            ],
            [
                'slug_chapter.unique' => 'Slug truyện đã có, điền tên khác!',
                'tieude.unique' => 'Tiêu đề đã có, điền tên khác!',
                'tieude.required' => 'Chưa nhập tiêu đề!',
                'noidung.required' => 'Chưa nhập nội dung chapter!',
                'slug_chapter.required' => 'Chưa nhập slug chapter!',
            ]
        );
        // $data = $request->all();
        $chapter = Chapter::find($id);
        $chapter->tieude = $data['tieude'];
        
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->noidung = $data['noidung'];
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->created_at = Carbon::now('Asia/Ho_Chi_Minh');

        $chapter->save();

        return redirect()->back()->with('status','Cập nhật chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->with('status','Xóa chapter thành công');
    }

    public function ckeditor_image(Request $request){
        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_EXTENSION);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'_'.$extension;

        }
    }
    public function timkiem3(Request $request){
        $data = $request->all();

        $tukhoa3 = $data['tukhoa3'];
        $chapter = Chapter::where('tieude','LIKE','%'.$tukhoa3.'%')->get();
        return view('admincp.chapter.timkiem3')->with(compact('chapter','tukhoa3')); 
    }
    public function timkiem_ajax3(Request $request){
        $data = $request->all();
        if($data['keywords3']){
            $chapter = Chapter::where('tieude','LIKE','%'.$data['keywords3'].'%')->get();
            $output = '
                <ul class="dropdown-menu" style="display:block;">'
            ;
            foreach($chapter as $key => $chap){
             $output.= '
                <li class="li_timkiem_ajax3"><a href="#">'.$chap->tieude.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
