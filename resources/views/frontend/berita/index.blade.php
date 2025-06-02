@extends('layouts.frontend.header') {{-- Sesuaikan dengan layout frontend kamu --}}
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_responsive.css') }}">
@endpush
@section('content')
<!-- Home -->

	<div class="home">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="index.html">Home</a></li>
								<li>Blog</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>
<!-- Blog -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_post_container">
                        @foreach ($artikel as $item)
						<!-- Blog Post -->
						<div class="blog_post trans_200">
							<div class="blog_post_image"><img src="{{ asset('storage/' . $item->thumbnail) }}" alt=""></div>
							<div class="blog_post_body">
								<div class="blog_post_title"><a href="{{ route('berita.show', $item->slug) }}">{{ $item->judul }}</a></div>
								<div class="blog_post_meta">
									<ul>
										<li><a href="#">{{ $item->penulis }}</a></li>
										<li><a href="#">{{ $item->created_at->translatedFormat('d M Y') }}</a></li>
									</ul>
								</div>
								<div class="blog_post_text">
									<p>{{ Str::limit(strip_tags($item->isi), 120) }}</p>
								</div>
							</div>
						</div>
                        @endforeach
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col text-center">
					{{ $artikel->links() }} {{-- pagination --}}
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="newsletter_background" style="background-image:url(images/newsletter_background.jpg)"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-center justify-content-start">

						<!-- Newsletter Content -->
						<div class="newsletter_content text-lg-left text-center">
							<div class="newsletter_title">sign up for news and offers</div>
							<div class="newsletter_subtitle">Subcribe to lastest smartphones news & great deals we offer</div>
						</div>

						<!-- Newsletter Form -->
						<div class="newsletter_form_container ml-lg-auto">
							<form action="#" id="newsletter_form" class="newsletter_form d-flex flex-row align-items-center justify-content-center">
								<input type="email" class="newsletter_input" placeholder="Your Email" required="required">
								<button type="submit" class="newsletter_button">subscribe</button>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
@extends('layouts.frontend.footer') {{-- Sesuaikan dengan layout frontend kamu --}}
@push('script')
<script src="{{ asset('frontend/js/blog.js') }}"></script>
@endpush