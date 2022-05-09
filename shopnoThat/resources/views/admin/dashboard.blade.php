@extends('admin_layout')
@section('admin_content')
<h3>Chào mừng bạn 
<?php
$name = Session::get('admin_name');
	if($name){
		echo $name;
	}
?>
 đến với trang quản trị</h3>
<div class="container-fluid">
	<style>
		p.title_thongke{
			text-align: center;
			font-size: 20px;
			font-weight: bold;
		}
	</style>
	<div class="row">
		<p class="title_thongke">Thống kế đơn hàng, danh số</p>
		<form autocomplete="off">
			@csrf
			<div class="col-md-2">
				<p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
				<p><input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả"></p>
			</div>
			<div class="col-md-2">
				<p>Đến ngày: <input type="text" id="datepicker1" class="form-control"></p>
			</div>
			<div class="col-md-2">
				<p>
					Lọc theo:
					<select class="dashboard-filter form-control">
						<option>--Chọn--</option>
						<option value="7ngay">7 ngày qua</option>
						<option value="thangtruoc">Tháng trước</option>
						<option value="thangnay">Tháng này</option>
						<option value="365ngayqua">365 ngày qua</option>
					</select>
				</p>
			</div>
		</form>
		<div class="col-md-12">
			<div id="myfirstchart" style="height: 250px;"></div>
		</div>
	</div>
</div>
@endsection