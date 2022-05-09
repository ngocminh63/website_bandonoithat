@extends('welcome')
@section('content')
<style>
	ul.post_relate li{
		list-style: disc;
		font-size: 20px;
		padding: 6px;
	}
	ul.post_relate li a:hover{
		color:#FE980F;
	}
</style>
<div class="features_items"><!--features_items-->
						@foreach($post as $key => $p)
							<h2 style="margin:0; position: inherit; font-size:22px;" class="title text-center">{{$p->post_title}} </h2>
						@endforeach
							<div class="product-image-wrapper">
								@foreach($post as $key => $p)
								<div class="single-products" style="margin:10px 0;">
									{!!$p->post_content!!}
								</div>
							</div>	
						</div>	
						@endforeach
						<h2 style="margin:0; position: inherit; font-size:22px;" class="title text-center">Bài viết liên quan</h2>
						<ul class="post_relate">
							@foreach($related as $key => $p_relate )
								<li><a href="{{URL::to('/bai-viet/'.$p_relate->post_slug)}}">{{$p_relate->post_title}}</a></li>
							@endforeach
						</ul>
					</div><!--features_items-->
					
@endsection
