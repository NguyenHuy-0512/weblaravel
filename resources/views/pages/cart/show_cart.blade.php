@extends('giohang')
@section('content')
<form method="POST" action = "{{URL::to('/update-cart')}}">
{{csrf_field()}}
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<!-- <?php
					use Gloudemans\Shoppingcart\Facades\Cart;

					$cart = Cart::content();
					echo"<pre>";
					print_r($cart);
					echo"</pre>";
				?> -->
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản phẩm</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($cart as $key => $value)
						<tr>
							<td class="cart_product">
								<a href="{{URL::to('chi-tiet-san-pham/'.$value->id)}}"><img src="{{asset('public/upload/product/'.$value->options->image)}}" style ="width: 100px; height:100px;" alt=""></a>
							</td>
							<td class="cart_description">
								<p>ID: {{$value->id}}</p>
								<input name="Rowid" type="hidden" value="{{$value->rowId}}">
								<h4><a href="">{{$value->name}}</a></h4>	
							</td>
							<td class="cart_price">
								<p id="{{$value->id}}" style="display:none;">{{$value->price}}</p>
								<p>{{number_format($value->price)}} vnđ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a id="cong" class="cart_quantity_down" onclick = "tru('{{$value->id}}')">-</a>
									<input id="soluong[{{$value->id}}]" onchange="thaydoi('{{$value->id}}')" class="cart_quantity_input" type="text" name="quantity[{{$key}}]" value="{{$value->qty}}" autocomplete="off" size="1">
									<a class="cart_quantity_up" onclick = "cong('{{$value->id}}')">+</a>
								</div>
							</td>
							<td class="cart_total">
								<p id="tongtien[{{$value->id}}]" class="cart_total_price">{{number_format($value->price*$value->qty)}} vnđ</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$value->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
    <section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng<span>{{Cart::total()}} vnđ</span></li>
							<li>Thuế<span>{{Cart::tax()}} vnđ</span></li>
							<li>Chi phí vận chuyển<span>Free</span></li>
							<li>Thành tiền<span>{{Cart::total()}} vnđ</span></li>
						</ul>
							<!-- <a class="btn btn-default update" type="submit">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a> -->
						<button class="btn btn-default update" type="submit">Cập nhật đơn hàng</button>
						<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
</form>
	<script>
		function thaydoi(id){
			// console.log(id);
			var soluong = document.getElementById('soluong['+id+"]");
			var giatien =  document.getElementById(id);
			var tongtien = soluong.value * giatien.innerHTML;
			document.getElementById('tongtien['+id+']').innerHTML = tongtien.toLocaleString()+ " vnđ";
			return;
		}
		function cong(id){
			var soluong = document.getElementById('soluong['+id+"]");
			var soluongmoi = parseInt(soluong.value);
			soluongmoi++;
			document.getElementById('soluong['+id+']').value = soluongmoi;
			thaydoi(id);
		}
		function tru(id){
			var soluong = document.getElementById('soluong['+id+"]");
			var soluongmoi = parseInt(soluong.value);
			if(soluongmoi > 1){
				soluongmoi--;
			}
			else{
				soluongmoi =1;
			}
			document.getElementById('soluong['+id+']').value = soluongmoi;
			thaydoi(id);
		}
	</script>
@endsection