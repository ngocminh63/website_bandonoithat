@extends('welcome')
@section('content')
<style>
	.res-btn {
        background: #FE980F;
        border: medium none;
        border-radius: 0;
        color: #FFFFFF;
        display: block;
        font-family: 'Roboto', sans-serif;
        padding: 6px 25px;
    }
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
					<div class="login-form"><!--login form-->
					@if(session()->has('message'))
						<div class="alert alert-success">
							{!! session()->get('message') !!}
						</div>
					@elseif(session()->has('error'))
						<div class="alert alert-danger">
							{{ session()->get('error') }}
						</div>
					@endif
						<h2><b>Đăng nhập tài khoản</b></h2>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{csrf_field()}}
							<input type="text" name="email_account" placeholder="Tài khoản" />
							<input type="password" name="password_account" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form><br>
                        <a href="{{URL::to('/register')}}" ><button type="submit" style="width: 120px" class="res-btn">Đăng kí</button></a>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection
