<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class BrandProduct extends Controller
{
    public function add_brand_product(){
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $all_brand_product = DB::table('tbl_brand_product')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
        return view('admin.all_brand_product');
    }
    public function save_brand_product(Request $request){
        
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('tbl_brand_product')->insert($data);
        $request->session()->put('Message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product(Request $request,$brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status' => 0]);
        $request->session()->put('Message', 'Bỏ kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product(Request $request,$brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status' => 1]);
        $request->session()->put('Message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }
    public function delete_brand_product(Request $request,$brand_product_id){
        $data = array();
        $data['brand_id'] = $brand_product_id;
        
        DB::table('tbl_brand_product')
            ->where('brand_id',$brand_product_id)
            ->delete();
        
        $request->session()->put('Message','Xóa danh mục thành công');
        return Redirect::to('all-brand-product');
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $data = array();
        $data['brand_id'] = $brand_product_id;
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;

        DB::table('tbl_brand_product')
            ->where('brand_id',$brand_product_id)
            ->update($data);
        $request->session()->put('Message','Cập nhật danh mục thành công');
        return Redirect::to('all-brand-product');
    } 
    public function show_brand_home($brand_id){
        $cate = DB::table('tbl_category_product')->where('category_status','1')->get();
        $brand = DB::table('tbl_brand_product')->where('brand_status','1')->get();
        $product = DB::table('tbl_product')    
                        ->join('tbl_brand_product','tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
                        ->join('tbl_category_product','tbl_product.category_id', '=', 'tbl_category_product.category_id')
                        ->where('tbl_product.brand_id',$brand_id)
                        ->select('tbl_product.*', 'tbl_brand_product.brand_name', 'tbl_category_product.category_name')
                        ->get();    
        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id', $brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('cate', $cate)->with('brand', $brand)->with('pro', $product)->with('name',$brand_name);
    }
}
