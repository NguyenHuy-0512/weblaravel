<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class CategoryProduct extends Controller
{
    public function add_category_product(){
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }
    public function save_category_product(Request $request){
        
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        $request->session()->put('Message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    public function unactive_category_product(Request $request,$category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' => 0]);
        $request->session()->put('Message', 'Bỏ kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function active_category_product(Request $request,$category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' => 1]);
        $request->session()->put('Message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function delete_category_product(Request $request,$category_product_id){
        $data = array();
        $data['category_id'] = $category_product_id;
        
        DB::table('tbl_category_product')
            ->where('category_id',$category_product_id)
            ->delete();
        
        $request->session()->put('Message','Xóa danh mục thành công');
        return Redirect::to('all-category-product');
    }
    public function update_category_product(Request $request,$category_product_id){
        $data = array();
        $data['category_id'] = $category_product_id;
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;

        DB::table('tbl_category_product')
            ->where('category_id',$category_product_id)
            ->update($data);
        $request->session()->put('Message','Cập nhật danh mục thành công');
        return Redirect::to('all-category-product');
    } 
    public function show_category_home($category_id){
        $cate = DB::table('tbl_category_product')->where('category_status','1')->get();
        $brand = DB::table('tbl_brand_product')->where('brand_status','1')->get();
        $product = DB::table('tbl_product')    
                        ->join('tbl_brand_product','tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
                        ->join('tbl_category_product','tbl_product.category_id', '=', 'tbl_category_product.category_id')
                        ->where('tbl_product.category_id',$category_id)
                        ->select('tbl_product.*', 'tbl_brand_product.brand_name', 'tbl_category_product.category_name')
                        ->get();    
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id', $category_id)->limit(1)->get();
        return view('pages.category.show_category')->with('cate', $cate)->with('brand', $brand)->with('pro', $product)->with('name', $category_name);
    }
}
