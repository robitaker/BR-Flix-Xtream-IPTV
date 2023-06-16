<?php

$url_now = base64_encode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));


?>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__content">
                    <!-- header logo -->
                    <a href="/" class="header__logo">
                        <img src="/assets/img/logo.svg" alt="">
                    </a>
                    <!-- end header logo -->

                    <!-- header nav -->
                    <ul class="header__nav">
                        <!-- dropdown -->
                        <li class="header__nav-item">
                            <a href="/" class="header__nav-link"><?= $language->header->home ?></a>
                        </li>
                        <!-- end dropdown -->

                        <!-- dropdown -->
                        <li class="header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button" id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $language->header->films ?> <i class="icon ion-ios-arrow-down"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                <li><a href="/catalog/movies/0/1"><?= $language->header->view_all ?></a></li>
                                <?php foreach ($category['vods'] as $row) { ?>
                                    <li><a href="/catalog/movies/<?= $row->category_id ?>/1"><?= $row->category_name ?></a></li>
                                <?php } ?>

                            </ul>
                        </li>
                        <!-- end dropdown -->


                        <!-- dropdown -->
                        <li class="header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button" id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $language->header->series ?> <i class="icon ion-ios-arrow-down"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                <li><a href="/catalog/series/0/1"><?= $language->header->view_all ?></a></li>
                                <?php foreach ($category['series'] as $row) { ?>
                                    <li><a href="/catalog/series/<?= $row->category_id ?>/1"><?= $row->category_name ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <!-- end dropdown -->


                        <!-- dropdown -->
                        <li hidden class="dropdown header__nav-item">
                            <a class="dropdown-toggle header__nav-link header__nav-link--more" href="#" role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon ion-ios-more"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu scrollbar-dropdown" aria-labelledby="dropdownMenuMore">
                                <li><a href="/">Test</a></li>
                            </ul>
                        </li>
                        <!-- end dropdown -->
                    </ul>
                    <!-- end header nav -->

                    <!-- header auth -->
                    <div class="header__auth">
                        <div class="header__search">
                            <input id="search" class="header__search-input" type="text" placeholder="<?= $language->header->search ?>">
                            <button onclick="Search(document.getElementById('search').value)" class="header__search-button" type="button">
                                <i class="icon ion-ios-search"></i>
                            </button>
                            <button onclick="Search(document.getElementById('search').value)" class="header__search-close" type="button">
                                <i class="icon ion-md-close"></i>
                            </button>
                        </div>

                        <button class="header__search-btn" type="button">
                            <i class="icon ion-ios-search"></i>
                        </button>

                        <!-- dropdown -->
                        <div class="dropdown header__lang">

                            <a class="dropdown-toggle header__nav-link" href="#" role="button" id="dropdownMenuLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $lang_opt['now'] ?> <i class="icon ion-ios-arrow-down"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuLang">
                                <?php foreach ($lang_opt['opts'] as $ind => $row) { ?>
                                    <li><a onclick="setLanguage('<?= $ind ?>')" href="#"><?= $row[0] ?></a></li>
                                <?php } ?>

                            </ul>
                        </div>
                        <!-- end dropdown -->

                        <?php if ($profile) { ?>

                            <div class="profile__avatar">
                                <a href="/profile" ><img src="/assets/img/user.svg" alt=""></a>
                            </div>
                            <div class="profile__meta">
                            <a href="/profile" ><h3><?= $profile['login'] ?></h3></a>
                                <span>ID: <?= $profile['id'] ?></span>
                            </div>

                        <?php } else { ?>
                            <a href="/login/<?=$url_now?>" class="header__sign-in">
                                <i class="icon ion-ios-log-in"></i>
                                <span>sign in</span>
                            </a>
                        <?php } ?>




                    </div>
                    <!-- end header auth -->

                    <!-- header menu btn -->
                    <button class="header__btn" type="button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- end header menu btn -->
                </div>
            </div>
        </div>
    </div>
</header>