<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class ProductController extends Controller
{
    public function add_product(){
        $cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product', $cate)->with('brand_product', $brand);
    }
    public function all_product(){
        $all_product = DB::table('tbl_product')
        ->join('tbl_brand_product','tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
        ->join('tbl_category_product','tbl_product.category_id', '=', 'tbl_category_product.category_id')
        ->select('tbl_product.*', 'tbl_brand_product.brand_name', 'tbl_category_product.category_name')
        ->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
        return view('admin.all_product');
    }
    public function save_product(Request $request){
        $data = array(
            'category_id' => $request->product_cate,
            'brand_id' => $request->product_brand,
            'product_name'  => $request->product_name,
            'product_desc' => $request->product_desc,
            'product_content' => $request->product_content,
            'product_status' => $request->product_status,
            'product_price' => $request->product_price,
        );
        $get_image = $request->file('product_img');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public\upload\product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            $request->session()->put('Message', 'Thêm sản phẩm thành công');
            return Redirect::to('all-product');
        }
        $data['product_image'] = ''; 
        DB::table('tbl_product')->insert($data);
        $request->session()->put('Message', 'Thêm sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function unactive_product(Request $request,$product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' => 0]);
        $request->session()->put('Message', 'Bỏ kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function active_product(Request $request,$product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' => 1]);
        $request->session()->put('Message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')
                        ->where('product_id',$product_id)
                        ->join('tbl_brand_product','tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
                        ->join('tbl_category_product','tbl_product.category_id', '=', 'tbl_category_product.category_id')
                        ->select('tbl_product.*', 'tbl_brand_product.brand_name', 'tbl_category_product.category_name')
                        ->get();
        // echo "<pre>";
        // print_r($edit_product);
        // echo "</pre>";
        // exit;
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product', $cate)->with('brand_product', $brand);
        // return view('admin.add_product')->with('cate_product', $cate)->with('brand_product', $brand);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function delete_product(Request $request,$product_id){
        $data = array();
        $data['product_id'] = $product_id;
        
        DB::table('tbl_product')
            ->where('product_id',$product_id)
            ->delete();
        
        $request->session()->put('Message','Xóa danh mục thành công');
        return Redirect::to('all-product');
    }
    public function update_product(Request $request,$product_id){
        $data = array(
            'category_id' => $request->product_cate,
            'brand_id' => $request->product_brand,
            'product_name'  => $request->product_name,
            'product_desc' => $request->product_desc,
            'product_content' => $request->product_content,
            'product_price' => $request->product_price,
        );
        $get_image = $request->file('product_img');
        // echo "<pre>";
        // print_r($request->product_img);
        // echo "</pre>";
        // exit;
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public\upload\product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            $request->session()->put('Message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        $request->session()->put('Message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function detail_product($product_id){
        $cate = DB::table('tbl_category_product')->where('category_status','1')->get();
        $brand = DB::table('tbl_brand_product')->where('brand_status','1')->get();
        $product = DB::table('tbl_product')
                    ->join('tbl_brand_product','tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
                    ->join('tbl_category_product','tbl_product.category_id', '=', 'tbl_category_product.category_id')
                    ->select('tbl_product.*', 'tbl_brand_product.brand_name', 'tbl_category_product.category_name')
                    ->where('product_id',$product_id)
                    ->get();
        foreach($product as $key => $value){
            $category_id = $value->category_id;
        }
        $related_product = DB::table('tbl_product')
                            ->join('tbl_brand_product','tbl_product.brand_id', '=', 'tbl_brand_product.brand_id')
                            ->join('tbl_category_product','tbl_product.category_id', '=', 'tbl_category_product.category_id')
                            ->select('tbl_product.*', 'tbl_brand_product.brand_name', 'tbl_category_product.category_name')
                            ->where('tbl_product.category_id',$category_id)
                            ->whereNotIn('tbl_product.product_id',[$product_id])
                            ->limit(3)
                            ->get();
        return view('pages.product.show_detail')->with('cate', $cate)->with('brand', $brand)->with('pro', $product)->with('related', $related_product);
    }
}
