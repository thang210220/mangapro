<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;

class IndexController extends Controller
{
    public function kytu(Request $request,$kytu){
        
        $slide_truyen = Truyen::orderBy('id','DESC')->take(8)->get();

        $xemtatca = Truyen::orderBy('id','DESC')->get();
        $truyennoibat = Truyen::where('truyen_noibat',1)->take(20)->get();
        $truyenxemnhieu = Truyen::where('truyen_noibat',2)->take(10)->get();

        $truyen = Truyen::where('tentruyen','LIKE',$kytu.'%')->orderBy('id','DESC')->get();
        return view('pages.kytu')->with(compact('truyen','slide_truyen','xemtatca','truyennoibat','truyenxemnhieu')); 
    }
    public function kytu2(Request $request,$kytu2){
        $chapter = Chapter::where('tieude','LIKE',$kytu2.'%')->orderBy('id','DESC')->get();
        return view('pages.kytu2')->with(compact('chapter')); 
    }
    public function timkiem_ajax(Request $request){
        $data = $request->all();
        if($data['keywords']){
            $truyen = Truyen::where('tentruyen','LIKE','%'.$data['keywords'].'%')->get();
            $output = '
                <ul class="dropdown-menu" style="display:block;">'
            ;
            foreach($truyen as $key => $tr){
             $output.= '
                <li class="li_timkiem_ajax"><a href="#">'.$tr->tentruyen.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function timkiem_ajax2(Request $request){
        $data = $request->all();
        if($data['keywords2']){
            $truyen = Truyen::where('tentruyen','LIKE','%'.$data['keywords2'].'%')->get();
            $output = '
                <ul class="dropdown-menu" style="display:block;">'
            ;
            foreach($truyen as $key => $tr){
             $output.= '
                <li class="li_timkiem_ajax2"><a href="#">'.$tr->tentruyen.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function home(){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $slide_truyen = Truyen::orderBy('id','DESC')->take(8)->get();

        $xemtatca = Truyen::orderBy('id','DESC')->get();
        $truyennoibat = Truyen::orderBy('id','DESC')->where('truyen_noibat',1)->take(20)->get();
        $truyenxemnhieu = Truyen::orderBy('id','DESC')->where('truyen_noibat',2)->take(10)->get();

        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        $truyen = Truyen::orderBy('id','DESC')->take(24)->get();
        return view('pages.home')->with(compact('danhmuc','truyen','theloai','slide_truyen','xemtatca','truyennoibat','truyenxemnhieu')); 
    }
    public function xemtatca(){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $slide_truyen = Truyen::orderBy('id','DESC')->take(8)->get();

        $xemtatca = Truyen::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();
        return view('pages.all')->with(compact('danhmuc','theloai','slide_truyen','xemtatca'));
    }
    public function danhmuc($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();

        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc',$slug)->first();
        $tendanhmuc= $danhmuc_id->tendanhmuc;
        $truyen = Truyen::orderBy('id','DESC')->where('danhmuc_id',$danhmuc_id->id)->get();
        return view('pages.danhmuc')->with(compact('danhmuc','truyen','tendanhmuc','theloai'));
    }
    public function theloai($slug){
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();

        $theloai_id = Theloai::where('slug_theloai',$slug)->first();
        $tentheloai= $theloai_id->tentheloai;

        $truyen = Truyen::orderBy('id','DESC')->where('theloai_id',$theloai_id->id)->get();
        return view('pages.theloai')->with(compact('danhmuc','truyen','tentheloai','theloai'));
    }
    public function xemtruyen($slug){

        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();

        $truyen = Truyen::with('danhmuctruyen','theloai')->where('slug_truyen',$slug)->first();

        $truyennoibat = Truyen::orderBy('id','DESC')->where('truyen_noibat',1)->take(5)->get();
        $truyenxemnhieu = Truyen::orderBy('id','DESC')->where('truyen_noibat',2)->take(5)->get();

        $chapter = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->get();

        $chapter_dau = Chapter::with('truyen')->orderBy('id','ASC')->where('truyen_id',$truyen->id)->first();
        $chapter_moinhat = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->id)->first();

        $cungdanhmuc = Truyen::with('danhmuctruyen','theloai')->orderBy('id','DESC')->where('danhmuc_id',$truyen->danhmuctruyen->id)->whereNotIn('id',[$truyen->id])->take(4)->get();

        return view('pages.truyen')->with(compact('danhmuc','truyen','chapter','cungdanhmuc','chapter_dau','theloai','truyennoibat','truyenxemnhieu','chapter_moinhat'));
    }
    public function xemchapter($slug){
       
        $theloai = Theloai::orderBy('id','DESC')->get();

        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();

        $truyen = Chapter::where('slug_chapter',$slug)->first();

        //breadcrumb
        $truyen_breadcrumb = Truyen::with('danhmuctruyen','theloai')->where('id',$truyen->truyen_id)->first();
        //breadcrumb

        $chapter = Chapter::with('truyen')->where('slug_chapter',$slug)->where('truyen_id',$truyen->truyen_id)->first();

        $all_chapter = Chapter::with('truyen')->orderBy('id','DESC')->where('truyen_id',$truyen->truyen_id)->get();

        $max_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','DESC')->first();
        $min_id = Chapter::where('truyen_id',$truyen->truyen_id)->orderBy('id','ASC')->first();

        $previous_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','<',$chapter->id)->max('slug_chapter');
        $next_chapter = Chapter::where('truyen_id',$truyen->truyen_id)->where('id','>',$chapter->id)->min('slug_chapter');

        return view('pages.chapter')->with(compact('danhmuc','chapter','all_chapter','next_chapter','previous_chapter','max_id','min_id','theloai','truyen_breadcrumb'));
    }
    public function timkiem(Request $request){
        $data = $request->all();
        $slide_truyen = Truyen::orderBy('id','DESC')->take(8)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();

        $tukhoa = $data['tukhoa'];
        $truyen = Truyen::with('danhmuctruyen','theloai')->where('tentruyen','LIKE','%'.$tukhoa.'%')->orWhere('tacgia','LIKE','%'.$tukhoa.'%')->get();
        return view('pages.timkiem')->with(compact('danhmuc','truyen','theloai','slide_truyen','tukhoa')); 
    }
    public function timkiem2(Request $request){
        $data = $request->all();
        $slide_truyen = Truyen::orderBy('id','DESC')->take(8)->get();
        $theloai = Theloai::orderBy('id','DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id','DESC')->get();

        $tukhoa2 = $data['tukhoa2'];
        $truyen = Truyen::with('danhmuctruyen','theloai')->where('tentruyen','LIKE','%'.$tukhoa2.'%')->orWhere('tacgia','LIKE','%'.$tukhoa2.'%')->get();
        return view('admincp.timkiem')->with(compact('danhmuc','truyen','theloai','slide_truyen','tukhoa2')); 
    }
    public function dangky(){
        return view('auth.register');
    }
    public function dangnhap(){
        return view('auth.login');
    }
    
}
