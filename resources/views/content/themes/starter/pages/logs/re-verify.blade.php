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
				<!-- Notification -->
				{!! $notify !!}

				<div class="row mb-5">
					<div class="col-md-5 col-sm-12">
						<div class="page-shadow">
							<div class="scr-register-form">

								<form name="form-input" action="#" class="form-horizontal" method="post" accept-charset="utf-8"
									enctype="multipart/form-data" autocomplete="off">
									@csrf

									<input type="hidden" name="r" value="{{ $tocart }}">

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
												<h4>Resend verification link:</h4>
											</div>
										</div>
									</div>


									<div class="row mb-3">
										<div class="col-md-12 col-sm-12">
											<label for="" class="form-label required">Enter Email </label>

											<input type="email" class="form-control" name="email" placeholder="" value="{{ old('email') }}" required>
											<small>(you registered with, we will re-send verification link)</small>
											@error('email')
												<span class="error">{{ $errors->first('email') }}</span>
											@enderror
										</div>
									</div>

									<div class="row mb-3">
										<div class="col-md-12 col-sm-12">
											<button type="button" onclick="submitForm('{!! url($links->reverify) !!}')"
												class="btn btn-danger btn-lg btn-block w-100">Resend Verification Link</button>
										</div>
									</div>
								</form>

								<hr />
								<!-- if you don't have an account -->
								<div class="row mb-3">
									<div class="col-md-12 col-sm-12">
										<div class="sec-register_title_second">
											<p>If you do not have an account,
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
									alt="" style="border-radius: 5px">
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</section>
@endsection
