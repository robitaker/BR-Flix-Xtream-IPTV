<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hotflix.volkovdesign.com/main/catalog.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2023 18:14:59 GMT -->

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
						<h1 class="section__title"><?= $language->catalog->catalog ?></h1>
						<!-- end section title -->

						<!-- breadcrumb -->
						<ul class="breadcrumb">
							<li class="breadcrumb__item"><a href="index.html">Home</a></li>
							<li class="breadcrumb__item breadcrumb__item--active">Catalog</li>
						</ul>
						<!-- end breadcrumb -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->

	<!-- filter -->
	<div class="filter">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="filter__content">
						<div class="filter__items">
							<!-- filter item -->
							<div class="filter__item" id="filter__genre">
								<span class="filter__item-label"><?= strtoupper($language->catalog->category) ?>:</span>

								<div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="<?= strtoupper($args[0]) ?>">
									<span></span>
								</div>

								<ul id="list_type" class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-genre">
									<li data-url="/catalog/movies/0/1" ><?= $language->catalog->films ?></li>
									<li data-url="/catalog/series/0/1"><?= $language->catalog->series ?></li>
								</ul>
							</div>
							<!-- end filter item -->

							<!-- filter item -->
							<div class="filter__item" id="filter__quality">
								<span class="filter__item-label"><?= strtoupper($language->catalog->genre) ?>:</span>

								<div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-quality" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="<?= strtoupper($results->genre) ?>">
									<span></span>
								</div>

								<ul id="list_category" class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-quality">
									<?php foreach ($category[$args[2]] as $row) { ?>
										<li data-url="/catalog/<?=$args[0]?>/<?=$row->category_id?>/1"><?= $row->category_name ?></li>
									<?php } ?>
								</ul>
							</div>
							<!-- end filter item -->


						</div>

						<!-- filter btn -->
						<button class="filter__btn" type="button">apply filter</button>
						<!-- end filter btn -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end filter -->

	<!-- catalog -->
	<div class="catalog">
		<div class="container">
			<div class="row row--grid">


				<?php foreach ($results->data as $row) { ?>
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
				<?php } ?>


			</div>

			<div class="row">
				<!-- paginator -->
				<div class="col-12">
					<ul class="paginator">
						<li class="paginator__item paginator__item--prev">
							<a href="/catalog/<?=$args[0]?>/<?=$args[1]?>/1">1</i></a>
						</li>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php foreach($results->pages as $row) {?>
							<li class="paginator__item  <?=$row == $results->page ? 'paginator__item--active' : '' ?>"><a href="/catalog/<?=$args[0]?>/<?=$args[1]?>/<?=$row?>"><?=$row?></a></li>
						<?php } ?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<li class="paginator__item paginator__item--next">
							<a href="/catalog/<?=$args[0]?>/<?=$args[1]?>/<?=$results->max_pages?>"><?=$results->max_pages?></i></a>
						</li>
					</ul>
				</div>
				<!-- end paginator -->
			</div>
		</div>
	</div>
	<!-- end catalog -->

	<!-- section -->
	<section class="section section--border">
		<div class="container">
			<div class="row">
				<!-- section title -->
				<div class="col-12">
					<div class="section__title-wrap">
						<h2 class="section__title">Expected premiere</h2>

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
						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--green">8.4</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
								<span class="card__category">
									<a href="#">Action</a>
									<a href="#">Triler</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover2.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--green">7.1</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">Benched</a></h3>
								<span class="card__category">
									<a href="#">Comedy</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover3.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--red">6.3</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">Whitney</a></h3>
								<span class="card__category">
									<a href="#">Romance</a>
									<a href="#">Drama</a>
									<a href="#">Music</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover4.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--yellow">6.9</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">Blindspotting</a></h3>
								<span class="card__category">
									<a href="#">Comedy</a>
									<a href="#">Drama</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover5.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--green">8.4</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
								<span class="card__category">
									<a href="#">Action</a>
									<a href="#">Triler</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover6.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--green">7.1</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">Benched</a></h3>
								<span class="card__category">
									<a href="#">Comedy</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover7.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--green">7.1</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">Benched</a></h3>
								<span class="card__category">
									<a href="#">Comedy</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover8.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--red">5.5</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
								<span class="card__category">
									<a href="#">Action</a>
									<a href="#">Triler</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover9.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--yellow">6.7</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">Blindspotting</a></h3>
								<span class="card__category">
									<a href="#">Comedy</a>
									<a href="#">Drama</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover10.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--red">5.6</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">Whitney</a></h3>
								<span class="card__category">
									<a href="#">Romance</a>
									<a href="#">Drama</a>
									<a href="#">Music</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover11.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--green">9.2</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">Benched</a></h3>
								<span class="card__category">
									<a href="#">Comedy</a>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card__cover">
								<img src="/assets/img/covers/cover12.jpg" alt="">
								<a href="details.html" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
								<span class="card__rate card__rate--green">8.4</span>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
								<span class="card__category">
									<a href="#">Action</a>
									<a href="#">Triler</a>
								</span>
							</div>
						</div>
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

<!-- Mirrored from hotflix.volkovdesign.com/main/catalog.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 May 2023 18:15:01 GMT -->

</html>