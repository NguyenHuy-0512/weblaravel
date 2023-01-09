<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();

class CartController extends Controller
{
    public function save_cart(Request $request){
        $product_id = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('tbl_product')->where('product_id', $product_id)->get();

        // echo"<pre>";
        // print_r($product_info[0]->product_id);
        // echo"</pre>";
        // exit;
        //Cart::add('293ad', 'Product 1', 1, 9.99, 550, ['size' => 'large']);
        // Cart::destroy();
        $data = array(
            'id' => $product_id,
            'qty' => $quantity,
            'name' => $product_info[0]->product_name,
            'price' => $product_info[0]->product_price,
            'weight' => 2.5,
            'options' => array(
                'image' => $product_info[0]->product_image,
            ),
            'taxRate' => 0,
        ); 
        Cart::add($data);
        $request->session()->put('Message', 'Thêm giỏ hàng thành công');
        //return Redirect::to('/show-cart');
        return Redirect::to('/chi-tiet-san-pham'.'/'.$product_id);
    }
    public function show_cart(){
        // $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->get();
        // $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->get();

        return view('pages.cart.show_cart');
    }
    public function delete_cart($row_id){
        Cart::update($row_id,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart(Request $request){
        $cart = Cart::content();

        foreach($cart as $product){
            $quantity = $request->quantity[$product->rowId];
            Cart::update($product->rowId, $quantity);
        }
        return Redirect::to('/show-cart');
    }
}
