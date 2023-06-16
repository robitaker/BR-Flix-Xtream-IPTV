<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="/assets/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="/assets/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/assets/css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="/assets/css/nouislider.min.css">
	<link rel="stylesheet" href="/assets/css/ionicons.min.css">
	<link rel="stylesheet" href="/assets/css/magnific-popup.css">
	<link rel="stylesheet" href="/assets/css/plyr.css">
	<link rel="stylesheet" href="/assets/css/photoswipe.css">
	<link rel="stylesheet" href="/assets/css/default-skin.css">
	<link rel="stylesheet" href="/assets/css/main.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="/assets/icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="/assets/icon/favicon-32x32.png">

	<meta name="description" content="">
	<meta name="keywords" content="">
	
	<title>Login</title>
</head>

<body class="body">

	<div class="sign section--bg" data-bg="/assets/img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sign__content">
						<!-- authorization form -->
						<form action="/login" method="post" class="sign__form">
							<a href="/" class="sign__logo">
								<img src="/assets/img/logo.svg" alt="">
							</a>

							<span class="success_form"><?= $create ?? '' ?></span>
							<span class="error_form"><?= $error ?? '' ?></span>

							<div class="sign__group">
								<input name="username" type="text" class="sign__input" placeholder="<?=$language->login->username?>">
							</div>

							<div class="sign__group">
								<input name="password" type="password" class="sign__input" placeholder="<?=$language->login->password?>">
							</div>

							<input name="redirect" type="hidden" value="<?=$redirect ?? ''?>">
							
							<button type="submit" class="sign__btn" type="button"><?=$language->login->sign_in?></button>

							<span class="sign__text"><?=$language->login->not_account?> <a href="/register<?=$redirect ? '/'.$redirect : ''?>"><?=$language->login->sign_up?>!</a></span>

						</form>
						<!-- end authorization form -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JS -->
	<script src="/assets/js/jquery-3.5.1.min.js"></script>
	<script src="/assets/js/bootstrap.bundle.min.js"></script>
	<script src="/assets/js/owl.carousel.min.js"></script>
	<script src="/assets/js/jquery.magnific-popup.min.js"></script>
	<script src="/assets/js/jquery.mousewheel.min.js"></script>
	<script src="/assets/js/jquery.mCustomScrollbar.min.js"></script>
	<script src="/assets/js/wNumb.js"></script>
	<script src="/assets/js/nouislider.min.js"></script>
	<script src="/assets/js/plyr.min.js"></script>
	<script src="/assets/js/photoswipe.min.js"></script>
	<script src="/assets/js/photoswipe-ui-default.min.js"></script>
	<script src="/assets/js/main.js"></script>
</body>

</html>