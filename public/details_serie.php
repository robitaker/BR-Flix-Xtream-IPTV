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
	<section class="section section--details section--bg" data-bg="<?= $details->backdrop ?>">
		<!-- details content -->

		<div class="container">
			<div class="row">
				<!-- title -->
				<div class="col-12">
					<h1 id="title_serie" class="section__title section__title--mb"><?= $details->name ?></h1>
				</div>
				<!-- end title -->

				<!-- content -->
				<div class="col-12 col-xl-6">
					<div class="card card--details">
						<div class="row">
							<!-- card cover -->
							<div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-5">
								<div class="card__cover">
									<img id="img_serie" src="<?= $details->img ?>" alt="">
									<span class="card__rate card__rate--green"><?= $details->rating ?></span>
								</div>
								<a href="#" data-url="/watch/<?= $details->type ?>/<?= $details->id ?>/<?= $details->extension ?>" id="watch_movie" class="card__trailer"><i class="icon ion-ios-play-circle"></i><?= $language->details->watch ?></a>
							</div>
							<!-- end card cover -->

							<!-- card content -->
							<div class="col-12 col-md-8 col-lg-9 col-xl-7">
								<div class="card__content">
									<ul class="card__meta">
										<li><span><?= $language->details->director ?>:</span> <?= $details->director ?></li>
										<li><span><?= $language->details->cast ?>:</span> <a href="#"><?= $details->cast ?></a></li>
										<li><span><?= $language->details->genre ?>:</span> <a href="#"><?= $details->genre ?></a></li>
										<li><span><?= $language->details->release ?>:</span> <?= $details->date ?></li>
										<li><span><?= $language->details->seasons ?>:</span> <?= $details->qtd_seasons ?></li>
									</ul>
									<div class="card__description"><?= $details->description ?></div>
								</div>
							</div>
							<!-- end card content -->
						</div>
					</div>
				</div>
				<!-- end content -->

				<!-- player -->
				<div id="watch_player" hidden class="col-12 col-xl-6">
					<video controls playsinline poster="<?= $details->img ?>" id="player">
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

	<!-- filter -->
	<div class="filter">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="filter__content">
						<div class="filter__items">
							<!-- filter item -->
							<div class="filter__item" id="filter__genre">
								<span class="filter__item-label"><?= strtoupper($language->details->seasons) ?>:</span>

								<div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="<?= strtoupper($language->details->season) . ' 1' ?>">
									<span></span>
								</div>

								<ul id="list_seasons" class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-genre">

									<?php foreach ($details->seasons as $ind => $row) { ?>
										<li data-ind="<?= $ind ?>"><?= strtoupper($language->details->season) . ' ' . $ind + 1 ?></li>
									<?php } ?>

								</ul>
							</div>
							<!-- end filter item -->
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end filter -->


	<!-- catalog -->
	<div class="catalog">
		<div class="container">
			<div id="show_ep" class="row row--grid">


				<?php foreach ($details->seasons[0] as $ind => $row) { ?>
					<!-- card -->
					<div class="col-6 col-sm-4 col-md-3 col-xl-2">
						<div class="card">
							<div class="card__cover">
								<img src="<?= $row->img ?>" alt="">
								<a onclick="watchSerie(0, <?=$ind?>)" href="#" class="card__play">
									<i class="icon ion-ios-play"></i>
								</a>
							</div>
							<div class="card__content">
								<h3 class="card__title"><a id="name_ep_<?=$ind?>" href="#"><?= $row->name ?></a></h3>
								<span class="card__category">
									<a href="#"><?= $language->details->episode . ' ' . $ind + 1 ?></a>
								</span>
							</div>
						</div>
					</div>
					<!-- end card -->
				<?php } ?>

			</div>


		</div>
	</div>
	<!-- end catalog -->

	<script>
		var seasons = {
			term_lang: '<?= $language->details->episode ?>',
			info: `<?= json_encode($details->seasons) ?>`
		}
	</script>


	<?php include 'public/footer.php' ?>


</body>

</html>