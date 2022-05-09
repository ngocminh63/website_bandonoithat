@extends('admin_layout')
@section('admin_content')
<div class="row">
<style>
	span.text-alert {
    color: blue;
    font-size: 17px;
    width: 100%;
    text-align: center;
    font-weight: bold;
}
</style>
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Sửa bài viết
                        </header>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                        <div class="panel-body">
                        @foreach($edit_post as $key => $p)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-post/'.$p->post_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài viết</label>
                                    <input type="text" value="{{$p->post_title}}" class="form-control"  onkeyup="ChangeToSlug();" name="post_title"  id="slug" placeholder="danh mục" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$p->post_slug}}" class="form-control"  onkeyup="ChangeToSlug();" name="post_slug"  id="slug" placeholder="slug" >
                                </div>
                                <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                                    <input type="file"  name="post_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/post/'.$p->post_img)}}" height="100" width="100">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="post_desc" id="ckeditor2" placeholder="Tóm tắt bài viết">{{$p->post_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung bài viết</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="post_content" id="ckeditor3" placeholder="Nội dung bài viết">{{$p->post_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục bài viết</label>
                                      <select name="post_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_pos as $key => $cate)
                                            <!-- value để lấy id, còn tên để hiển thị k lấy tên -->
                                            @if($cate->cate_post_id==$p->cate_post_id)
                                            <option selected value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                            @else
                                            <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_post" class="btn btn-info">Cập nhật bài viết</button>
                                </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
</div>
@endsection