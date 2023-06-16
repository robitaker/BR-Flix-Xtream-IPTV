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
	
	<title>Search</title>
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
						<h1 class="section__title"><?= $language->search->found ?>(<?= $results->qtd ?>)</h1>
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

							<div class="form__group">
								<br>
								<input value="<?=$results->term?>" id="search_" type="text" class="form__input" placeholder="<?= $language->header->search ?>">
							</div>
							<div class="form__group">
								<button onclick="Search(document.getElementById('search_').value)" class="form__btn" type="button"><?= $language->search->search ?></button>
							</div>
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
				 
				<h2 class="section__title section__title--mb">
					<?= $msg ? $msg : ($results->qtd < 1 ? $language->search->title_not_found : '') ?>
				</h2>

			</div>


		</div>
	</div>
	<!-- end catalog -->




	<?php include 'public/footer.php' ?>

</body>

</html>