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
	
	<title>Profile</title>
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
							<li class="breadcrumb__item"><a href="/"></a></li>
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
									<a class="nav-link <?= !$warning ? 'active' : '' ?>" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="false"><?= $language->profile->list ?></a>
								</li>

								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false"><?= $language->profile->watched ?></a>
								</li>

								<li class="nav-item">
									<a class="nav-link <?= $warning ? 'active' : '' ?>" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false"><?= $language->profile->settings ?></a>
								</li>
							</ul>
							<!-- end content tabs nav -->

							<!-- content mobile tabs nav -->
							<div class="content__mobile-tabs content__mobile-tabs--profile" id="content__mobile-tabs">
								<div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="<?= !$warning ? $language->profile->list : $language->profile->settings ?>">
									<span></span>
								</div>

								<div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item"><a class="nav-link <?= !$warning ? 'active' : '' ?>" id="1-tab" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true"><?= $language->profile->list ?></a></li>

										<li class="nav-item"><a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false"><?= $language->profile->watched ?></a></li>

										<li class="nav-item"><a class="nav-link <?= $warning ? 'active' : '' ?>" id="3-tab" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false"><?= $language->profile->settings ?></a></li>
									</ul>
								</div>
							</div>
							<!-- end content mobile tabs nav -->

							<button onclick="window.location.href = '/profile/logout' " class="profile__logout" type="button">
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

				<div class="tab-pane fade <?= !$warning ? 'show active' : '' ?>" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
					<section class="section section--border">
						<div class="container">
							<div class="row">
								<!-- section title -->
								<div class="col-12">
									<div class="section__title-wrap">
										<h2 class="section__title"><?= isset($data_profile['list'][0]) ? $language->profile->later : $language->profile->later_no ?></h2>

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
										<h2 class="section__title"><?= isset($data_profile['watched'][0]) ? $language->profile->recent : $language->profile->recent_no ?></h2>

										<div class="section__nav-wrap">

											<button class="section__nav section__nav--prev" type="button" data-nav="#carousel2">
												<i class="icon ion-ios-arrow-back"></i>
											</button>

											<button class="section__nav section__nav--next" type="button" data-nav="#carousel2">
												<i class="icon ion-ios-arrow-forward"></i>
											</button>
										</div>
									</div>
								</div>
								<!-- end section title -->

								<!-- carousel -->
								<div class="col-12">
									<div class="owl-carousel section__carousel" id="carousel2">

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

				<div class="tab-pane fade <?= $warning ? 'show active' : '' ?>" id="tab-3" role="tabpanel" aria-labelledby="3-tab">

					<br>
					<?php if ($warning) { ?>
					<div class="col-12 col-lg-6">
						<label class="<?=$warning['class']?>"><?=$warning['msg']?></label>
					</div>
					<?php } ?>

					<div class="row">
						<!-- details form -->
						<div class="col-12 col-lg-6">
							<form action="/profile/edit" method="post" class="form form--profile">
								<div class="row row--form">
									<div class="col-12">
										<h4 class="form__title"><?=$language->profile->title_profile_details?></h4>
									</div>


									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="firstname">Email</label>
											<input required value="<?= $profile['email'] ?>" type="email" name="email" class="form__input" placeholder="...">
										</div>
									</div>



									<div class="col-12">
										<button type="submit" class="form__btn" type="button"><?=$language->profile->save?></button>
									</div>
								</div>

							</form>

							<form action="/profile/edit" method="post" class="form form--profile">
								<div class="row row--form">
									<div class="col-12">
										<h4 class="form__title"><?=$language->profile->title_new_password?></h4>
									</div>


									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="firstname"><?=$language->profile->new_password?></label>
											<input required type="password" name="password" class="form__input" placeholder="">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="lastname"><?=$language->profile->confirm_password?></label>
											<input required type="password" name="confirm_password" class="form__input" placeholder="">
										</div>
									</div>

									<div class="col-12">
										<button type="submit" class="form__btn" type="button"><?=$language->profile->save?></button>
									</div>
								</div>

							</form>
						</div>
						<!-- end details form -->

						<?php if ($profile['level'] == 10) {?>
						<!-- password form -->
						<div class="col-12 col-lg-6">
							<form action="/profile/xtream-list" method="post" class="form form--profile">
								<div class="row row--form">
									<div class="col-12">
										<h4 class="form__title"><?=$language->profile->title_xtream?></h4>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="oldpass"><?=$language->login->username?></label>
											<input value="<?=$data_profile['xtream']->user?>" type="text" name="username" class="form__input">
										</div>
									</div>


									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="confirmpass"><?=$language->login->password?></label>
											<input  value="<?=$data_profile['xtream']->pass?>" type="text" name="password" class="form__input">
										</div>
									</div>

									<div class="col-12 col-md-6 col-lg-12 col-xl-6">
										<div class="form__group">
											<label class="form__label" for="confirmpass"><?=$language->profile->url?></label>
											<input  value="<?=$data_profile['xtream']->url?>" type="text" name="url" class="form__input">
										</div>
									</div>
			

									<div class="col-12">
										<button type="submit" class="form__btn" type="button">Atualizar</button>
									</div>
								</div>
							</form>
						</div>
						<!-- end password form -->
						<?php } ?>
					</div>
				</div>

			</div>
			<!-- end content tabs -->
		</div>
	</div>
	<!-- end content -->



	<?php include 'footer.php'; ?>


</body>


</html>