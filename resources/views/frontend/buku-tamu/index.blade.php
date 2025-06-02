@extends('layouts.frontend.header') {{-- Sesuaikan dengan layout frontend kamu --}}
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_responsive.css') }}">
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
								<li>Contact</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

	<!-- Contact -->

	<div class="contact">

		<!-- Contact Info -->

		<div class="contact_info_container">
			<div class="container">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
				<div class="row">

					<!-- Contact Form -->
					<div class="col-lg-6">
						<div class="contact_form">
							<div class="contact_info_title">Form Buku Tamu Digital</div>
							<form action="{{ route('tamu.store') }}" method="POST" class="comment_form">
                                @csrf
								<div>
									<div class="form_title">Nama Lengkap</div>
									<input type="text" name="nama" class="comment_input" value="{{ old('nama') }}" required="required">
                                    @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
								</div>
								<div>
									<div class="form_title">Asal Instansi</div>
									<input type="text" name="instansi" class="comment_input" value="{{ old('instansi') }}" required="required">
                                    @error('instansi') <div class="text-danger">{{ $message }}</div> @enderror
								</div>
								<div>
									<div class="form_title">Kontak ( No. HP/Email )</div>
									<input type="text" name="kontak" class="comment_input" value="{{ old('kontak') }}" required="required">
                                    @error('kontak') <div class="text-danger">{{ $message }}</div> @enderror
								</div>
								<div>
									<div class="form_title">Keperluan</div>
									<textarea name="keperluan" class="comment_input comment_textarea" value="{{ old('keperluan') }}" required="required"></textarea>
                                    @error('keperluan') <div class="text-danger">{{ $message }}</div> @enderror
								</div>
								<div>
									<button type="submit" class="comment_button trans_200">Kirim</button>
								</div>
							</form>
						</div>
					</div>
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
<script src="{{ asset('frontend/js/contact.js') }}"></script>
@endpush