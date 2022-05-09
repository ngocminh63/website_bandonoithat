@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
<style>
	span.fa-solid.fa.fa-toggle-on {
    color: blue;
    font-size: 28px;
    }
    span.fa-solid.fa.fa-toggle-off {
    color: blue;
    font-size: 28px;
    }
    span.text-alert {
    color: blue;
    font-size: 17px;
    width: 100%;
    text-align: center;
    font-weight: bold;
    }
    a.active.styling-edit {
    font-size: 20px;
    }
</style>
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nhân viên
    </div>
    
    <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message',null);
    }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên nhân viên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Shipper</th>
            <th>Admin</th>
            <th>User</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($admin as $key => $user)
            <form action="{{url('/assign-roles')}}" method="POST">
              @csrf
              <tr>
                <td>{{ $user->admin_name }}</td>
                <td>{{ $user->admin_email }} <input type="hidden" name="admin_email" value="{{$user->admin_email }}"></td>
                <td>{{ $user->admin_phone }}</td>
                <td><input type="checkbox" name="shipper_role" {{$user->hasRole('shipper') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="admin_role"  {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="user_role"  {{$user->hasRole('user') ? 'checked' : ''}}></td>

              <td>
                 <input type="submit" value="Phân quyền" class="btn btn-sm btn-default">
              </td> 

              </tr>
            </form>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-15 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <span>{!!$admin->links("pagination::bootstrap-4")!!}</span>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection