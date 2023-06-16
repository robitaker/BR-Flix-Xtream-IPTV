<?php

	$watched = isset($info_db->watched) ? json_decode($info_db->watched) : false;


?>

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
	
	<title>Details</title>
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
					<h1 class="section__title section__title--mb"><?= $details->name ?></h1>
				</div>
				<!-- end title -->

				<!-- content -->
				<div class="col-12 col-xl-6">
					<div class="card card--details">
						<div class="row">
							<!-- card cover -->
							<div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-5">
								<div class="card__cover">
									<img src="<?= $details->img ?>" alt="">
									<span class="card__rate card__rate--green"><?= $details->rating ?></span>
								</div>
								<a href="#" id="watch_movie" class="card__trailer"><i class="icon ion-ios-play-circle"></i><?= $language->details->watch ?></a>

								<?php if (!isset($info_db->favorite) && $profile) { ?>
									<a href="#" data-id="<?= $details->id ?>" data-type="<?= $details->type ?>" id="add_list" class="card__trailer"><i class="icon ion-ios-add-circle"></i><?= $language->details->add_list ?></a>
								<?php } else if (isset($info_db->favorite)) { ?>
									<a href="#" data-id="<?= $details->id ?>" data-type="<?= $details->type ?>" id="remove_list" class="card__trailer"><i class="icon ion-ios-close-circle icon"></i><?= $language->details->remove_list ?></a>
								<?php } ?>
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
										<li><span><?= $language->details->time_min ?>:</span> <?= $details->time ?> min</li>
										<li><span><?= $language->details->country ?>:</span> <a href="#"><?= $details->country ?></a></li>
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

	<script>
		var lang = {
			add_list: "<?= $language->details->add_list ?>",
			remove_list: "<?= $language->details->remove_list ?>"
		};

		const info_player = {
			
			id: '<?= $details->id ?>',
			type: '<?= $details->type ?>',
			extension: '<?= $details->extension ?>',
			checkpoint: false,

			id_watched: <?=$watched ? $watched[0]->id : 0?>,
			already_watched : <?=$watched ? 1 : 0?>,
			current_time : <?=$watched ? $watched[0]->checkpoint : 0?>
		};

		var is_added = false;
		const is_serie = false;
		const is_logged = <?=$profile ? 1 : 0?>;

	</script>


	<?php include 'public/footer.php' ?>




</body>

</html>