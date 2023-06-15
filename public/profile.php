<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hotflix.volkovdesign.com/main/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2023 18:20:26 GMT -->

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
	<meta name="author" content="Dmitry Volkov">
	<title>HotFlix – Online Movies, TV Shows & Cinema HTML Template</title>
</head>

<body class="body">
	<!-- header -->
	<?php include 'header.php'; ?>
	<!-- end header -->

	<!-- page title -->
	<section class="section section--first section--bg" data-bg="/assets/img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h2 class="section__title"><?= $language->profile->home ?></h2>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="index.html"></a></li>
						</ul>
						<!-- end breadcrumb -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<!-- content -->
	<div class="content content--profile">
		<!-- profile -->
		<div class="profile">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="profile__content">
							<div class="profile__user">
								<div class="profile__avatar">
									<img src="/assets/img/user.svg" alt="">
								</div>
								<div class="profile__meta">
									<h3><?= $profile['login'] ?></h3>
									<span>ID: <?= $profile['id'] ?></span>
								</div>
							</div>

							<!-- content tabs nav -->
							<ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true"><?= $language->profile->list ?></a>
								</li>

								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false"><?= $language->profile->watched ?></a>
								</li>

								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false"><?= $language->profile->settings ?></a>
								</li>
							</ul>
							<!-- end content tabs nav -->

							<!-- content mobile tabs nav -->
							<div class="content__mobile-tabs content__mobile-tabs--profile" id="content__mobile-tabs">
								<div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="Profile">
									<span></span>
								</div>

								<div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Profile</a></li>

										<li class="nav-item"><a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">Subscription</a></li>

										<li class="nav-item"><a class="nav-link" id="3-tab" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">Settings</a></li>
									</ul>
								</div>
							</div>
							<!-- end content mobile tabs nav -->

							<button class="profile__logout" type="button">
								<i class="icon ion-ios-log-out"></i>
								<span>Logout</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end profile -->

		<div class="container">
			<!-- content tabs -->
			<div class="tab-content">
				<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
					<section class="section section--border">
						<div class="container">
							<div class="row">
								<!-- section title -->
								<div class="col-12">
									<div class="section__title-wrap">
										<h2 class="section__title"><?= isset($data_profile['list'][0]) ? $language->profile->later : $language->profile->later_no?></h2>

										<div class="section__nav-wrap">

											<button class="section__nav section__nav--prev" type="button" data-nav="#carousel1">
												<i class="icon ion-ios-arrow-back"></i>
											</button>

											<button class="section__nav section__nav--next" type="button" data-nav="#carousel1">
												<i class="icon ion-ios-arrow-forward"></i>
											</button>
										</div>
									</div>
								</div>
								<!-- end section title -->

								<!-- carousel -->
								<div class="col-12">
									<div class="owl-carousel section__carousel" id="carousel1">

										<?php foreach ($data_profile['list'] as $row) { ?>
											<div class="card">
												<div class="card__cover">
													<img src="<?= $row->img ?>" alt="">
													<a href="/<?= $row->type . '/' . $row->id ?>" class="card__play">
														<i class="icon ion-ios-play"></i>
													</a>
												</div>
												<div class="card__content">
													<h3 class="card__title"><a href="/<?= $row->type . '/' . $row->id ?>"><?= $row->name ?></a></h3>
												</div>
											</div>
										<?php } ?>


									</div>
								</div>
								<!-- carousel -->
							</div>
						</div>
					</section>
				</div>

				<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
					<section class="section section--border">
						<div class="container">
							<div class="row">
								<!-- section title -->
								<div class="col-12">
									<div class="section__title-wrap">
										<h2 class="section__title"><?= isset($data_profile['watched'][0]) ? $language->profile->recent : $language->profile->recent_no?></h2>

										<div class="section__nav-wrap">

											<button class="section__nav section__nav--prev" type="button" data-nav="#carousel1">
												<i class="icon ion-ios-arrow-back"></i>
											</button>

											<button class="section__nav section__nav--next" type="button" data-nav="#carousel1">
												<i class="icon ion-ios-arrow-forward"></i>
											</button>
										</div>
									</div>
								</div>
								<!-- end section title -->

								<!-- carousel -->
								<div class="col-12">
									<div class="owl-carousel section__carousel" id="carousel1">

										<?php foreach ($data_profile['watched'] as $row) { ?>
											<div class="card">
												<div class="card__cover">
													<img src="<?= $row->img ?>" alt="">
													<a href="/<?= $row->type . '/' . $row->id ?>" class="card__play">
														<i class="icon ion-ios-play"></i>
													</a>
												</div>
												<div class="card__content">
													<h3 class="card__title"><a href="/<?= $row->type . '/' . $row->id ?>"><?= $row->name ?></a></h3>
												</div>
											</div>
										<?php } ?>


									</div>
								</div>
								<!-- carousel -->
							</div>
						</div>
					</section>
				</div>

				<div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="3-tab">
					<div class="row">
						<!-- details form -->
						<div class="col-12 col-lg-6">
							<form action="#" class="form form--profile">
								<div class="row row--form">
									<div class="col-12">
										<h4 class="form__title">Profile details</h4>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="username">Username</label>
											<input id="username" type="text" name="username" class="form__input" placeholder="User 123">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="email">Email</label>
											<input id="email" type="text" name="email" class="form__input" placeholder="email@email.com">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="firstname">First Name</label>
											<input id="firstname" type="text" name="firstname" class="form__input" placeholder="John">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="lastname">Last Name</label>
											<input id="lastname" type="text" name="lastname" class="form__input" placeholder="Doe">
										</div>
									</div>

									<div class="col-12">
										<button class="form__btn" type="button">Save</button>
									</div>
								</div>
							</form>
						</div>
						<!-- end details form -->

						<!-- password form -->
						<div class="col-12 col-lg-6">
							<form action="#" class="form form--profile">
								<div class="row row--form">
									<div class="col-12">
										<h4 class="form__title">Change password</h4>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="oldpass">Old password</label>
											<input id="oldpass" type="password" name="oldpass" class="form__input">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="newpass">New password</label>
											<input id="newpass" type="password" name="newpass" class="form__input">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="confirmpass">Confirm new password</label>
											<input id="confirmpass" type="password" name="confirmpass" class="form__input">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="select">Select</label>
											<select name="select" id="select" class="form__select">
												<option value="0">Option</option>
												<option value="1">Option 2</option>
												<option value="2">Option 3</option>
												<option value="3">Option 4</option>
											</select>
										</div>
									</div>

									<div class="col-12">
										<button class="form__btn" type="button">Change</button>
									</div>
								</div>
							</form>
						</div>
						<!-- end password form -->
					</div>
				</div>
			</div>
			<!-- end content tabs -->
		</div>
	</div>
	<!-- end content -->

	<!-- partners -->
	<section class="section section--border">
		<div class="container">
			<div class="row">
				<!-- section title -->
				<div class="col-12">
					<h2 class="section__title section__title--mb">Our Partners</h2>
				</div>
				<!-- end section title -->

				<!-- section text -->
				<div class="col-12">
					<p class="section__text">It is a long <b>established</b> fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using.</p>
				</div>
				<!-- end section text -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="/assets/img/partners/themeforest-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="/assets/img/partners/audiojungle-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="/assets/img/partners/codecanyon-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="/assets/img/partners/photodune-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="/assets/img/partners/activeden-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->

				<!-- partner -->
				<div class="col-6 col-sm-4 col-md-3 col-lg-2">
					<a href="#" class="partner">
						<img src="/assets/img/partners/3docean-light-background.png" alt="" class="partner__img">
					</a>
				</div>
				<!-- end partner -->
			</div>
		</div>
	</section>
	<!-- end partners -->

	<?php include 'footer.php'; ?>


</body>

<!-- Mirrored from hotflix.volkovdesign.com/main/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2023 18:20:26 GMT -->

</html>