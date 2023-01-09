<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $cate = DB::table('tbl_category_product')->where('category_status','1')->get();
        $brand = DB::table('tbl_brand_product')->where('brand_status','1')->get();
        $product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->get();
        // echo "<pre>";
        // print_r($cate);
        // echo "</pre>";
        // exit;
        return view('pages.home')->with('cate', $cate)->with('brand', $brand)-> with('pro', $product);
    }
}
