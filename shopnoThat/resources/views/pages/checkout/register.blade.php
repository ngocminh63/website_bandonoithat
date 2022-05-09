@extends('welcome')
@section('content')
<style>
	#form {
    display: block;
    margin-bottom: 185px;
    margin-top: 15px;
    overflow: hidden;
	}
</style>
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
                <div class="col-sm-4 col-sm-offset-1">
					<div class="signup-form"><!--sign up form-->
						<h2><b>Đăng ký tài khoản</b></h2>
						<form action="{{URL::to('/add-cus')}}" method="POST">
							{{ csrf_field() }}
							<input type="text" name="customer_name" placeholder="Họ và tên"/>
							<input type="email" name="customer_email" placeholder="Địa chỉ email"/>
							<input type="password" name="customer_password" placeholder="Mật khẩu"/>
							<input type="text" name="customer_phone" placeholder="Phone"/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection
