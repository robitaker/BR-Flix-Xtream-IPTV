<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hotflix.volkovdesign.com/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2023 18:08:45 GMT -->

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

	<!-- home -->
	<section class="home">
		<!-- home bg -->
		<div class="owl-carousel home__bg">
			<?php foreach ($suggestion_series as $row) { ?>
				<div class="item home__cover" data-bg="<?= $row->backdrop ?>"></div>
			<?php } ?>
		</div>
		<!-- end home bg -->

		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="home__title"><b><?=$language->index->home__title_no_logged?></b></h1>

					<button class="home__nav home__nav--prev" type="button">
						<i class="icon ion-ios-arrow-round-back"></i>
					</button>
					<button class="home__nav home__nav--next" type="button">
						<i class="icon ion-ios-arrow-round-forward"></i>
					</button>
				</div>

				<div class="col-12">
					<div class="owl-carousel home__carousel home__carousel--bg">

						<?php foreach ($suggestion_series as $row) { ?>
							<div class="card card--big">
								<div class="card__cover">
									<img src="<?= $row->img ?>" alt="">
									<a href="/<?= $row->type . '/' . $row->id ?>" class="card__play">
										<i class="icon ion-ios-play"></i>
									</a>
									<span class="card__rate card__rate--green"><?= $row->rating ?></span>
								</div>
								<div class="card__content">
									<h3 class="card__title"><a href="/<?= $row->type . '/' . $row->id ?>"><?= $row->name ?></a></h3>
									<span class="card__category">
										<a href="#"><?= $row->genre ?></a>
									</span>
								</div>
							</div>
						<?php } ?>


					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end home -->

	<!-- content -->
	<section class="content">
		<div class="content__head">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- content title -->
						<h2 class="content__title"><?=$language->index->news?></h2>
						<!-- end content title -->

						<!-- content tabs nav -->
						<ul class="nav nav-tabs content__tabs" id="content__tabs" role="tablist">

							<?php foreach ($vods_index as $ind => $now) { ?>
								<li class="nav-item">
									<a class="nav-link <?= $ind == 0 ? 'active' : '' ?> " data-toggle="tab" href="#tab-<?=$ind?>" role="tab" aria-controls="tab-<?=$ind?>" aria-selected="true"><?=$now->name?></a>
								</li>
							<?php } ?>

						</ul>
						<!-- end content tabs nav -->

						<!-- content mobile tabs nav -->
						<div class="content__mobile-tabs" id="content__mobile-tabs">
							<div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<input type="button" value="<?=$language->index->mobile_options?>">
								<span></span>
							</div>

							<div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
								<ul class="nav nav-tabs" role="tablist">

									<?php foreach ($vods_index as $ind => $now) { ?>
										<li class="nav-item"><a class="nav-link active" id="<?=$ind?>-tab" data-toggle="tab" href="#tab-<?=$ind?>" role="tab" aria-controls="tab-<?=$ind?>" aria-selected="true"><?= $now->name ?></a></li>
									<?php } ?>

								</ul>
							</div>
						</div>
						<!-- end content mobile tabs nav -->
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<!-- content tabs -->
			<div class="tab-content">

				<?php foreach ($vods_index as $ind => $now) { ?>

					<div class="tab-pane fade <?= $ind == 0 ? 'show active' : '' ?>" id="tab-<?=$ind?>" role="tabpanel" aria-labelledby="<?=$ind?>-tab">
						<div class="row row--grid">

							<?php foreach ($now->content as $row) { ?>
								<!-- card -->
								<div class="col-6 col-sm-4 col-md-3 col-xl-2">
									<div class="card">
										<div class="card__cover">
											<img src="<?= $row->img ?>" alt="">
											<a href="/<?= $row->type . '/' . $row->id ?>" class="card__play">
												<i class="icon ion-ios-play"></i>
											</a>
											<span class="card__rate card__rate--green"><?= $row->rating ?></span>
										</div>
										<div class="card__content">
											<h3 class="card__title"><a href="/<?= $row->type . '/' . $row->id ?>"><?= $row->name ?></a></h3>
											<span class="card__category">
												<a href="#"><?= $row->category_name ?></a>
											</span>
										</div>
									</div>
								</div>
								<!-- end card -->
							<?php } ?>

						</div>
					</div>

				<?php } ?>



			</div>
			<!-- end content tabs -->
		</div>
	</section>
	<!-- end content -->

	<!-- section -->
	<section class="section section--border">
		<div class="container">
			<div class="row">
				<!-- section title -->
				<div class="col-12">
					<div class="section__title-wrap">
						<h2 class="section__title"><?=$language->index->suggestions?></h2>

						<div class="section__nav-wrap">
							<a href="catalog.html" class="section__view">View All</a>

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

						<?php foreach ($suggestion_vods as $row) { ?>
							<div class="card">
								<div class="card__cover">
									<img src="<?= $row->img ?>" alt="">
									<a href="/<?= $row->type . '/' . $row->id ?>" class="card__play">
										<i class="icon ion-ios-play"></i>
									</a>
									<span class="card__rate card__rate--green"><?= $row->rating ?></span>
								</div>
								<div class="card__content">
									<h3 class="card__title"><a href="/<?= $row->type . '/' . $row->id ?>"><?= $row->name ?></a></h3>
									<span class="card__category">
										<a href="#"><?= $row->category_name ?></a>
									</span>
								</div>
							</div>
						<?php } ?>


					</div>
				</div>
				<!-- carousel -->
			</div>
		</div>
	</section>
	<!-- end section -->

	<!-- section -->
	<section class="section section--border">
		<div class="container">
			<div class="row">
				<div class="col-12 col-xl-10">
					<h2 class="section__title section__title--mb"><b>HotFlix</b> – Best Place for Movies</h2>

					<p class="section__text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of <b>using Lorem</b> Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>

					<p class="section__text">Content here, content here, making it look like <a href="#">readable</a> English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
				</div>
			</div>

			<div class="row row--grid">
				<!-- price -->
				<div class="col-12 col-md-6 col-lg-4 order-md-2 order-lg-1">
					<div class="price">
						<div class="price__item price__item--first"><span>Basic</span> <span>Free</span></div>
						<div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 7 days</span></div>
						<div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 720p Resolution</span></div>
						<div class="price__item price__item--none"><span><i class="icon ion-ios-close"></i> Limited Availability</span></div>
						<div class="price__item price__item--none"><span><i class="icon ion-ios-close"></i> Desktop Only</span></div>
						<div class="price__item price__item--none"><span><i class="icon ion-ios-close"></i> Limited Support</span></div>
						<a href="#" class="price__btn">Choose Plan</a>
					</div>
				</div>
				<!-- end price -->

				<!-- price -->
				<div class="col-12 col-md-12 col-lg-4 order-md-1 order-lg-2">
					<div class="price price--premium">
						<div class="price__item price__item--first"><span>Premium</span> <span>$34.99 <sub>/ month</sub></span></div>
						<div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 1 Month</span></div>
						<div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Full HD</span></div>
						<div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Lifetime Availability</span></div>
						<div class="price__item price__item--none"><span><i class="icon ion-ios-close"></i> TV & Desktop</span></div>
						<div class="price__item price__item--none"><span><i class="icon ion-ios-close"></i> 24/7 Support</span></div>
						<a href="#" class="price__btn">Choose Plan</a>
					</div>
				</div>
				<!-- end price -->

				<!-- price -->
				<div class="col-12 col-md-6 col-lg-4 order-md-3">
					<div class="price">
						<div class="price__item price__item--first"><span>Cinematic</span> <span>$49.99 <sub>/ month</sub></span></div>
						<div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 2 Months</span></div>
						<div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Ultra HD</span></div>
						<div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Lifetime Availability</span></div>
						<div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Any Device</span></div>
						<div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 24/7 Support</span></div>
						<a href="#" class="price__btn">Choose Plan</a>
					</div>
				</div>
				<!-- end price -->
			</div>
		</div>
	</section>
	<!-- end section -->

	
	<?php include 'public/footer.php' ?>




</body>

<!-- Mirrored from hotflix.volkovdesign.com/main/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2023 18:14:39 GMT -->

</html>