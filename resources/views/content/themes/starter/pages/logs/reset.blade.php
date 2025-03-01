{{-- Extend the Layout --}}
@extends("$theme_dir.layouts.$layoutName")
{{-- Content --}}
@section('content')
	<div class="page-title page-title-default title-size-default title-design-centered color-scheme-light mb-5">
		<div class="container">
			<h1 class="entry-title title">Verify Account</h1>
			<!-- breadcrumb -->
			<div class="breadcrumbs">
				<a href="">Home</a>
				<span>Verify</span>
			</div>
		</div>
	</div>

	<section class="scr-register">
		<div class="container">

			<section class="section mt-50">
				<div class="row mb-5">
					<div class="col-md-5 col-sm-12">
						<div class="page-shadow">
							<div class="scr-register-form">
								<!-- Notification -->
								{!! $notify !!}

								<form name="form-input" action="#" class="form-horizontal" method="post" accept-charset="utf-8"
									enctype="multipart/form-data" autocomplete="off">
									@csrf

									<script>
										function submitForm(action) {
											// Start the dot animation immediately
											Loader.show();

											let this_form = document.querySelector('[name="form-input"]');
											this_form.action = action;
											this_form.submit();
										}
									</script>

									<div class="row mt-2 mb-3">
										<div class="col-md-12 col-sm-12">
											<div class="sec-register_title_second text-center">
												<h4>Verify your account:</h4>
											</div>
										</div>
									</div>


									<div class="row mb-3">
										<div class="col-md-12 col-sm-12">
											<label for="" class="form-label required">Email</label>
											<input type="email" class="form-control" name="email" placeholder="" value="{{ old('email') }}" required>
											@error('email')
												<span class="error">{{ $errors->first('email') }}</span>
											@enderror
										</div>
									</div>

									<div class="row mb-3">
										<div class="col-md-12 col-sm-12">
											<button type="button" onclick="submitForm('{!! url($links->reverify) !!}')"
												class="btn btn-primary btn-lg btn-block">Resend Verification Link</button>
										</div>
									</div>
								</form>

								<hr />
								<!-- if you don't have an account -->
								<div class="row mb-3">
									<div class="col-md-12 col-sm-12">
										<div class="sec-register_title_second">
											<h6>Don't have an account?</h6>
											<p>Get started by registering using the link:
												<a href="{{ url('account-signup') }}" class="">click here to register</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-7 col-sm-12">
						<div class="row mt-2">
							<div class="col-md-12">
								<img src="{{ asset("$plugin_assets") }}/custom/img/other/page/reverify-student-2.jpg" class="img-register"
									alt="">
							</div>
						</div>

						<div class="page-shadow">
							<div class="post-order-side">
								<div class="row">
									<div class="col-md-12">
										<div class="context-box">
											<h5 class="context-title">Clients: Access High-Quality Research Materials and Support</h5>
											<p class="context-body-p">Find and purchase comprehensive research documents, covering a wide range of topics
												and disciplines.</p>
											<p class="context-body-p">Collaborate with experienced researchers and receive personalized research
												assistance
												for your projects.</p>
											<p class="context-body-p">Enhance your academic performance and gain a deeper understanding of complex
												subjects.
											</p>
											<p class="context-body-p">Discover new knowledge and insights from expert researchers across the globe.</p>
										</div>
									</div>
								</div>

							</div>
						</div>
						<div class="row mt-2">
							<div class="col-md-12">
								<img src="{{ asset("$plugin_assets") }}/custom/img/other/page/login-student-3.jpg" class="img-register"
									alt="">
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</section>
@endsection
