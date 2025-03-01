{{-- Extend the Layout --}}
@extends("$theme_dir.layouts.$layoutName")

{{-- Content --}}
@section('content')
	<div class="page-title page-title-default title-size-default title-design-centered color-scheme-light mb-5">
		<div class="container">
			<h1 class="entry-title title">Login To Account</h1>
			<!-- breadcrumb -->
			<div class="breadcrumbs">
				<a href="">Home</a>
				<span>Login</span>
			</div>
		</div>
	</div>

	<div class="row mb-5">
		<div class="col-md-5 col-sm-12">
			<div class="page-shadow">
				<div class="scr-register-form">
					<!-- Notification -->
					{!! $notify !!}

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

						<script>
							function submitForm(action) {

								let this_form = document.querySelector('[name="form-input"]');
								this_form.action = action;
								this_form.submit();
							}
						</script>

						<div class="row mt-2 mb-3">
							<div class="col-md-12 col-sm-12">
								<div class="sec-register_title_second text-center">
									<h4>Enter Login Info:</h4>
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
								<label for="" class="form-label required">Password</label>
								<input type="password" class="form-control" name="password" value="" required>
								@error('password')
									<span class="error">{{ $errors->first('password') }}</span>
								@enderror
							</div>
						</div>

						<!-- Terms and Conditions -->
						<div class="row mb-5">
							<div class="col-md-12">
								<div class="form-check form-group">
									<input class="form-check-input" type="checkbox" name="remember" {{ old('remember') == '1' ? 'checked' : '' }}
										value="1">
									<label class="form-check-label label-terns" for="agree">
										Remember Me
									</label>
								</div>

								@error('remember')
									<span class="error">{{ $errors->first('remember') }}</span>
								@enderror
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-md-5 col-sm-12">
								<button type="button" onclick="submitForm('{!! url($links->login) !!}')"
									class="btn btn-primary btn-lg btn-block">Click To Login</button>
							</div>

							<div class="col-md-6 col-sm-12">
								Or <a href="{{ url('account-reset') }}" class="btn btn-link">Reset Password</a>
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
	</div>
@endsection
