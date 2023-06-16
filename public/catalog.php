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
	
	<title>Catalog</title>
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
									<input type="button" value="<?= $args[0] == 'movies' ? strtoupper($language->catalog->films) : strtoupper($language->catalog->series) ?>">
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



	<?php include 'public/footer.php' ?>

</body>


</html>