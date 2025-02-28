<footer id="footer" class="footer dark-background">
	<div class="container copyright text-center mt-4">
	<p>© <span>Copyright</span> <strong class="px-1 sitename">Company</strong> <span>All Rights Reserved</span></p>
	<div class="credits">
	  <!-- All the links in the footer should remain intact. -->
	  <!-- You can delete the links only if you've purchased the pro version. -->
	  <!-- Licensing information: https://bootstrapmade.com/license/ -->
	  <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
	  Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
	</div>
  </div>

</footer>

<script src="{{ asset($plugin_assets) }}/datepicker/js/datepicker-full.min.js"></script>

<input type="hidden" id="base_url_link" value="{{ url('/') }}">

<script src='{{ asset("$theme_assets") }}/js/main.js'></script>

<script type="text/javascript">
	// Datepicker
	const picker = document.querySelectorAll('.date');
	if (picker) {
		// Loop through each picker
		picker.forEach(function(picked) {
			// Create a new datepicker
			const datepicker = new Datepicker(picked, {
				minDate: new Date(),
				autohide: true,
				format: 'dd/mm/yyyy',
				clearBtn: true,
			});
		});
	}
</script>
