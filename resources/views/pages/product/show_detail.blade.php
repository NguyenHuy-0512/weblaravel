@extends('trangsp')
@section('content')
<?php
    $message = session()->get('Message');
    if($message){
        echo '
		<style>
			#snackbar {
				visibility: hidden;
				min-width: 250px;
				margin-left: -125px;
				background-color: #7CFC00;
				color: #FFF5EE;
				text-align: center;
				border-radius: 2px;
				padding: 16px;
				position: fixed;
				z-index: 1;
				right: 5%;
				top: 50px;
				font-size: 17px;
			}
			
			#snackbar.show {
				visibility: visible;
				-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
				animation: fadein 0.5s, fadeout 0.5s 2.5s;
			}
			
			@-webkit-keyframes fadein {
				from {top: 0; opacity: 0;} 
				to {top: 50px; opacity: 1;}
			}
			
			@keyframes fadein {
				from {top: 0; opacity: 0;}
				to {top: 50px; opacity: 1;}
			}
			
			@-webkit-keyframes fadeout {
				from {top: 50px; opacity: 1;} 
				to {top: 0; opacity: 0;}
			}
			
			@keyframes fadeout {
				from {top: 50px; opacity: 1;}
				to {top: 0; opacity: 0;}
		</style>
		<div id="snackbar" >'.$message.'</div>
		<script>
			var x = document.getElementById("snackbar");
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
	  	</script>
		';
        session()->put('Message',null);
        }
?>
@foreach($pro as $key => $value)
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{asset('public/upload/product/'.$value->product_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="{{asset('public/upload/product/'.$value->product_image)}}" style = "height:85px; width:85px;" alt=""></a>
										  <a href=""><img src="{{asset('public/upload/product/'.$value->product_image)}}" style = "height:85px; width:85px;" alt=""></a>
										  <a href=""><img src="{{asset('public/upload/product/'.$value->product_image)}}" style = "height:85px; width:85px;" alt=""></a>
										</div>
										<!-- <div class="item">
										  <a href=""><img src="{{asset('public/upload/product/'.$value->product_image)}}" style = "height:85px; width:85px;" alt=""></a>
										  <a href=""><img src="{{asset('public/upload/product/'.$value->product_image)}}" style = "height:85px; width:85px;" alt=""></a>
										  <a href=""><img src="{{asset('public/upload/product/'.$value->product_image)}}" style = "height:85px; width:85px;" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="{{asset('public/upload/product/'.$value->product_image)}}" style = "height:85px; width:85px;" alt=""></a>
										  <a href=""><img src="{{asset('public/upload/product/'.$value->product_image)}}" style = "height:85px; width:85px;" alt=""></a>
										  <a href=""><img src="{{asset('public/upload/product/'.$value->product_image)}}" style = "height:85px; width:85px;" alt=""></a>
										</div> -->
										
									</div>

								  <!-- Controls -->
								  <!-- <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a> -->
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="{{asset('public/fontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
								<h2>{{$value->product_name}}</h2>
								<p>ID sản phẩm: {{$value->product_id}}</p>
								<!-- <img src="{{asset('public/fontend/images/product-details/rating.png')}}" alt="" /> -->
								<form action="{{URL::to('/save-cart')}}" method = "POST" >
									{{csrf_field()}}
									<span>
										<span class = "col-sm-12">{{number_format($value->product_price)}} đ</span>
										<label>Quantity:</label>
										<input name ="qty" type="number" min="1" value="1" />
										<input name ="productid_hidden" type="hidden" value= "{{$value->product_id}}" />
										<button type="submit" class="btn btn-fefault cart">
											<i class="fa fa-shopping-cart"></i>
											Thêm giỏ hàng
										</button>
									</span>
								</form>
								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> Mới 100%</p>
								<p><b>Thương hiệu:</b> {{$value->brand_name}}</p>
								<a href=""><img src="{{asset('public/fontend/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
								<li><a href="#reviews" data-toggle="tab">Đánh giá (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="col-sm-12">
									<p>{!!$value->product_desc!!}</p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-12">
									<p>{!!$value->product_content!!}</p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<{{asset('public/fontend/images/product-details/.png')}}" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					@endforeach
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center"><br>Sản phẩm liên quan</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									@foreach($related as $key => $value)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<a href = "{{URL::to('/chi-tiet-san-pham/'.$value->product_id)}}">
													<div class="productinfo text-center">
														<img src="{{asset('public/upload/product/'.$value->product_image)}}" alt="" style="height: 100px; width: 100px;" />
														<h2>{{number_format($value->product_price)}} đ</h2>
														<p>{{$value->product_name}}</p>
														<!-- <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button> -->
													</div>
												</a>
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							 <!-- <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			 -->
						</div>
					</div><!--/recommended_items-->
@endsection