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
	<meta name="author" content="Dmitry Volkov">
	<title>HotFlix – Online Movies, TV Shows & Cinema HTML Template</title>
</head>

<body class="body">
	<!-- header -->
	<?php include 'header.php'; ?>
	<!-- end header -->

	<!-- details -->
	<section class="section section--details section--bg" data-bg="<?=$details->backdrop?>">
		<!-- details content -->
		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<h1 class="section__title section__title--mb"><?=$details->name?></h1>
				</div>
				<!-- end title -->

				<!-- content -->
				<div class="col-12 col-xl-6">
					<div class="card card--details">
						<div class="row">
							<!-- card cover -->
							<div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-5">
								<div class="card__cover">
									<img src="<?=$details->img?>" alt="">
									<span class="card__rate card__rate--green"><?=$details->rating?></span>
								</div>
								<a href="#" data-url="/watch/<?=$details->type?>/<?=$details->id?>/<?=$details->extension?>" id="watch_movie" class="card__trailer"><i class="icon ion-ios-play-circle"></i><?=$language->details->watch?></a>
							</div>
							<!-- end card cover -->

							<!-- card content -->
							<div class="col-12 col-md-8 col-lg-9 col-xl-7">
								<div class="card__content">
									<ul class="card__meta">
										<li><span><?=$language->details->director?>:</span> <?=$details->director?></li>
										<li><span><?=$language->details->cast?>:</span> <a href="#"><?=$details->cast?></a></li>
										<li><span><?=$language->details->genre?>:</span> <a href="#"><?=$details->genre?></a></li>
										<li><span><?=$language->details->release?>:</span> <?=$details->date?></li>
										<li><span><?=$language->details->time_min?>:</span> <?=$details->time?> min</li>
										<li><span><?=$language->details->country?>:</span> <a href="#"><?=$details->country?></a></li>
									</ul>
									<div class="card__description"><?=$details->description?></div>
								</div>
							</div>
							<!-- end card content -->
						</div>
					</div>
				</div>
				<!-- end content -->

				<!-- player -->
				<div id="watch_player" hidden class="col-12 col-xl-6">
					<video controls playsinline poster="<?=$details->img?>" id="player">
						<!-- Video files -->
						<source src="" type="video/mp4" size="1080">
					</video>
				</div>
				<!-- end player -->
			</div>
		</div>
		<!-- end details content -->
	</section>
	<!-- end details -->



	<?php include 'public/footer.php' ?>


</body>

</html>