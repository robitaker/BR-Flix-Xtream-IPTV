<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hotflix.volkovdesign.com/main/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2023 18:20:26 GMT -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="assets/css/nouislider.min.css">
	<link rel="stylesheet" href="assets/css/ionicons.min.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/plyr.css">
	<link rel="stylesheet" href="assets/css/photoswipe.css">
	<link rel="stylesheet" href="assets/css/default-skin.css">
	<link rel="stylesheet" href="assets/css/main.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="assets/icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="assets/icon/favicon-32x32.png">

	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>HotFlix – Online Movies, TV Shows & Cinema HTML Template</title>
</head>

<body class="body">

	<div class="sign section--bg" data-bg="assets/img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sign__content">
						<!-- registration form -->
						<form action="/register" method="post" class="sign__form">
							<a href="/" class="sign__logo">
								<img src="assets/img/logo.svg" alt="">
							</a>
							
							<span class="error_form"><?= $error ?? '' ?></span>
							
							<div class="sign__group">
								<input type="text" name="name" class="sign__input" placeholder="Name">
							</div>

							<div class="sign__group">
								<input type="text" name="email" class="sign__input" placeholder="Email">
							</div>

							<div class="sign__group">
								<input type="text" name="username" class="sign__input" placeholder="Username">
							</div>


							<div class="sign__group">
								<input type="password" name="password" class="sign__input" placeholder="Password">
							</div>

							<div hidden class="sign__group sign__group--checkbox">
								<input id="remember" name="remember" type="checkbox" checked="checked">
								<label for="remember">I agree to the <a href="privacy.html">Privacy Policy</a></label>
							</div>
							
							<button type="submit" class="sign__btn" type="button">Sign up</button>

							<span class="sign__text">Already have an account? <a href="/login">Sign in!</a></span>
						</form>
						<!-- registration form -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JS -->
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<script src="assets/js/jquery.mousewheel.min.js"></script>
	<script src="assets/js/jquery.mCustomScrollbar.min.js"></script>
	<script src="assets/js/wNumb.js"></script>
	<script src="assets/js/nouislider.min.js"></script>
	<script src="assets/js/plyr.min.js"></script>
	<script src="assets/js/photoswipe.min.js"></script>
	<script src="assets/js/photoswipe-ui-default.min.js"></script>
	<script src="assets/js/main.js"></script>
</body>

<!-- Mirrored from hotflix.volkovdesign.com/main/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2023 18:20:26 GMT -->
</html>