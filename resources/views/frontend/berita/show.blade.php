@extends('layouts.frontend.header')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_single.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/blog_single_responsive.css') }}">
@endpush
@section('content')
<!-- Blog -->

	<div class="blog">
		<div class="container">
			<div class="row">

				<!-- Blog Content -->
				<div class="col-lg-8">
					<div class="blog_content">
						<div class="blog_title">{{ $artikel->judul }}</div>
						<div class="blog_meta">
							<ul>
								<li>Post on <a href="#">{{ $artikel->created_at->translatedFormat('d M Y') }}</a></li>
								<li>By <a href="#">{{ $artikel->penulis }}</a></li>
							</ul>
						</div>
						<div class="blog_image"><img src="{{ asset('storage/' . $artikel->thumbnail) }}" alt=""></div>
						<p>{!! $artikel->isi !!}</p>
					</div>
					<div class="blog_extra d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
						
					</div>
					<!-- Comments -->
					<div class="comments_container">
						<div class="comments_title">Comments</div>
						<ul class="comments_list">
                            @forelse ($artikel->comments->where('parent_id', null) as $item)
							<li>
								<div class="comment_item d-flex flex-row align-items-start jutify-content-start">
									<div class="comment_content">
										<div class="comment_title_container d-flex flex-row align-items-center justify-content-start">
											<div class="comment_author"><a href="#">{{ $item->name }}</a></div>
											<div class="comment_rating"><div class="rating_r rating_r_4"><i></i><i></i><i></i><i></i><i></i></div></div>
											<div class="comment_time ml-auto">{{ $item->created_at->translatedFormat('d M Y') }}</div>
										</div>
										<div class="comment_text">
											<p>{{ $item->content }}</p>
										</div>
										<div class="comment_extras d-flex flex-row align-items-center justify-content-start">
											<div class="comment_extra comment_reply">
                                                <a class="reply-toggle" data-target="reply-form-{{ $item->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true">
                                                    </i><span>Reply</span>
                                                </a>
                                            </div>
										</div>
                                        {{-- Form reply --}}
                                        <div class="comment_form_container">
                                            <form action="{{ route('comments.store') }}" method="POST" id="reply-form-{{ $item->id }}" class="reply-form mt-2 d-none">
                                                @csrf
                                                <input type="hidden" name="article_id" value="{{ $artikel->id }}">
                                                <input type="hidden" name="parent_id" value="{{ $item->id }}">
                                                <div>
                                                    <div class="form_title">Nama*</div>
                                                    <textarea class="comment_input" name="name" required="required"></textarea>
                                                </div>
                                                <div>
                                                    <div class="form_title">Review*</div>
                                                    <textarea class="comment_input" name="content" required="required"></textarea>
                                                </div>
                                                <div>
                                                    <button class="comment_button trans_200">Balas</button>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- End Form reply --}}
                                        {{-- Replies (Komentar Bertingkat) --}}
                                        @foreach($item->replies as $reply)
                                            <div style="margin-left: 20px; border-top: 1px dashed #aaa; padding-top: 5px;">
                                                <strong>{{ $reply->name }}</strong><br>
                                                <p>{{ $reply->content }}</p>
                                            </div>
                                        @endforeach
									</div>
								</div>
							</li>
						</ul>
                        @empty
                        <ul>
                            <li>
                                <div class="comment_item d-flex flex-row align-items-start jutify-content-start">
                                    <div class="comment_content">
                                        <div class="comment_title_container d-flex flex-row align-items-center justify-content-start">
                                            <div class="comment_author"><a href="#">No comments yet</a></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        @endforelse
						<div class="add_comment_container">
							<div class="add_comment_title">Tulis Komentar Anda</div>
							<div class="add_comment_text">Email kamu tidak akan dipublish. Required fields are marked *</div>
							<form action="{{ route('comments.store') }}" method="POST" class="comment_form">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $artikel->id }}">
                                <input type="hidden" name="parent_id" value="">
								<div>
									<div class="form_title">Review*</div>
									<textarea class="comment_input comment_textarea" name="content" required="required"></textarea>
								</div>
								<div class="row">
									<div class="col-md-6 input_col">
										<div class="form_title">Name*</div>
										<input type="text" class="comment_input" name="name" required="required">
									</div>
									<div class="col-md-6 input_col">
										<div class="form_title">Email*</div>
										<input type="text" class="comment_input" name="email" required="required">
									</div>
								</div>
								<div>
									<button type="submit" class="comment_button trans_200">submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Blog Sidebar -->
				<div class="col-lg-4">
					<div class="sidebar">

						<!-- Categories -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Categories</div>
							<div class="sidebar_categories">
                                <ul class="categories_list">
                                    @foreach ($kategori as $kat)
									<li><a href="{{ route('kategori.show', $kat->slug) }}" class="clearfix">{{ $kat->nama }}<span>({{ $kat->artikel_count }})</span></a></li>
                                    @endforeach
								</ul>
							</div>
						</div>

						<!-- Latest News -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Latest Courses</div>
							<div class="sidebar_latest">
                                @foreach($latestCourses as $course)
								<!-- Latest Course -->
								<div class="latest d-flex flex-row align-items-start justify-content-start">
									<div class="latest_image"><div><img src="{{ asset('storage/' . $course->thumbnail) }}" alt=""></div></div>
									<div class="latest_content">
										<div class="latest_title"><a href="{{ route('berita.show', $course->slug) }}">{{ $course->judul }}</a></div>
										<div class="latest_date">{{ $course->created_at->translatedFormat('d M Y') }}</div>
									</div>
								</div>
                                @endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@extends('layouts.frontend.footer')
@push('script')
<script src="{{ asset('frontend/js/blog_single.js') }}"></script>
@endpush