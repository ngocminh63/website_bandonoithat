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
                           Cập nhật danh mục bài viết
                        </header>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-post/'.$edit_category_post->cate_post_id)}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên danh mục</label>
                                        <input type="text" value="{{$edit_category_post->cate_post_name}}" class="form-control"  onkeyup="ChangeToSlug();" name="category_post_name"  id="slug" placeholder="danh mục" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug</label>
                                        <input type="text" value="{{$edit_category_post->cate_post_slug}}" class="form-control"  onkeyup="ChangeToSlug();" name="category_post_slug"  id="slug" placeholder="slug" >
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="category_post_desc" id="exampleInputPassword1" >{{$edit_category_post->cate_post_desc}}</textarea>
                                    </div>
                                
                                    <button type="submit" name="update_category_post" class="btn btn-info">Cập nhật danh mục</button>
                                </form>
                            </div>
                        </div>
                    </section>

            </div>
</div>
@endsection