@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_responsive.css') }}">

<div class="home">
	{{-- <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('frontend/images/banner_2_product.png') }}"></div> --}}
	<div class="home_overlay"></div>
	<div class="home_content d-flex flex-column align-items-center justify-content-center">
        
        @if(session()->get('lang') == 'bangla')
            <h2 class="home_title">ই-কমার্স ব্লগ</h2>
        @else
            <h2 class="home_title">Ecommerce Blog</h2>
        @endif
	</div>
</div>


<div class="single_post">
    <div class="container">
        <div class="row">
            <div class="card mb-3">
                <img class="card-img-top" src="{{ asset($post->post_image) }}" style="height:300px; width:600px; margin-left:300px;margin-top:20px" alt="Card image cap">
                
                @if(session()->get('lang') == 'bangla')
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->post_title_bn }}</h2>
                        <p class="card-text">{{substr(strip_tags($post->details_bn), 0,)}}</p>
                        <p class="card-text text-primary">ক্যাটাগরি: <span class="text-muted text-primary">{{ $post->category_name_bn }}</span></p>
                    </div>
                @else
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->post_title_en }}</h2>
                        <p class="card-text">{{substr(strip_tags($post->details_en), 0,)}}</p>
                        <p class="card-text text-primary">Category: <span class="text-muted text-primary">{{ $post->category_name_en }}</span></p>
                    </div>
                @endif
                
            </div>
           
        </div>
    </div>
</div>







<!-- Blog Posts-->

<div class="blog">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
					
					@foreach($all_post as $row)
                        <!-- Blog post -->
                        <div class="blog_post">
                            <div class="blog_image" style="background-image:url({{ asset($row->post_image) }})"></div>
                            <div class="blog_text">
                                @if(session()->get('lang') == 'bangla')
                                    {{ $row->post_title_bn }}
                                @else
                                    {{ $row->post_title_en }}
                                @endif
                                
                            </div>
                            <div class="blog_button">
                                <a href="{{route('blog.single_post',$row->id)}}">
                                    @if(session()->get('lang') == 'bangla')
                                        বিস্তারিত পড়ুন 
                                    @else
                                        Continue Reading
                                    @endif
                                </a>
                            </div>
                        </div>
					@endforeach
					
				</div>
			</div>
				
		</div>
	</div>
</div>
@endsection