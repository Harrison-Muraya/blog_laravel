{{-- Extend the Layout --}}
@extends("$theme_dir.layouts.$layoutName")

{{-- Content --}}
@section('content')
	<div class="page-title page-title-default title-size-default title-design-centered color-scheme-light mb-5">
		<div class="container">
			<h1 class="entry-title title">Register Account</h1>
			<!-- breadcrumb -->
			<div class="breadcrumbs">
				<a href="">Home</a>
				<span>Register</span>
			</div>
		</div>
	</div>


	<section class="scr-register mb-4">
		<div class="container">
			<!-- Login -->
			<div class="row">
			

			<div class="row">
				<div class="col-12">
					<!-- Notification -->
					{!! $notify !!}
				</div>
			</div>

			<section class="section mt-50">
				<div class="row mb-5">
					
					<div class="col-md-5 col-sm-12">
						<div class="page-shadow">
							<div class="scr-register-form">
								@if ($errors->any())
									<div class="row">
										<div class="col-12">
											<div class="alert alert-danger">
												<ul>
													@foreach ($errors->all() as $error)
														<li>{{ $error }}</li>
													@endforeach
												</ul>
											</div>
										</div>
									</div>
								@endif
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
										<div class="col-md-8 col-sm-12">
											<div class="sec-register_title_second">
												<h4>Profile Information:</h4>
											</div>
										</div>
									</div>

									<div class="row mb-3">
										<div class="col-md-6 col-sm-12">
											<label for="" class="form-label required">First Name</label>
											<input type="text" class="form-control" name="first_name" placeholder="" value="{{ old('first_name') }}"
												required>
											@error('first_name')
												<span class="error">{{ $errors->first('first_name') }}</span>
											@enderror
										</div>

										<div class="col-md-6 col-sm-12">
											<label for="" class="form-label">Last Name</label>
											<input type="text" class="form-control" name="last_name" placeholder="" value="{{ old('last_name') }}">
											@error('last_name')
												<span class="error">{{ $errors->first('last_name') }}</span>
											@enderror
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

									<div class="row mb-5">
										<div class="col-md-6 col-sm-12">
											<label for="" class="form-label required">Enter Password</label>
											<input type="password" class="form-control" name="user_password" value="" required>
											@error('user_password')
												<span class="error">{{ $errors->first('user_password') }}</span>
											@enderror
										</div>

										<div class="col-md-6 col-sm-12">
											<label for="" class="form-label required">Re-enter Password</label>
											<input type="password" class="form-control" name="user_password_confirmation" value="" required>
											@error('user_password_confirmation')
												<span class="error">{{ $errors->first('user_password_confirmation') }}</span>
											@enderror
										</div>
									</div>

									<div class="row mb-3">
										<div class="col-md-7 col-sm-12">
											<button type="submit" onclick="submitForm('{!! url($links->register) !!}')"
												class="btn btn-primary btn-lg btn-block">Click To Register</button>
										</div>

										<div class="col-md-5 col-sm-12">
											Or <a href="{{ url('account-signin') }}" class="btn btn-link">Login to account</a>
										</div>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</section>
@endsection
