@extends('giohang')
@section('content')
    <section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập vào tài khoản</h2>
						<form action="#">
							<input type="text" name="user" placeholder="Tên đăng nhập" />
							<input type="password" name="password" placeholder="Mật khẩu" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Nhớ mật khẩu
							</span>
							<button type="submit" name="dangnhap" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Tạo tài khoản mới</h2>
						<form action="#">
							<input type="text" name="user" placeholder="Tên đăng nhập"/>
							<input type="email" name="email" placeholder="Email"/>
							<input type="text" name="phone" placeholder="Số điện thoại"/>
							<input type="password" name="password" placeholder="Mật khẩu"/>
                            <input type="password" name="cfpassword" placeholder="Xác nhận mật khẩu"/>
							<button type="submit" name="dangky" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection