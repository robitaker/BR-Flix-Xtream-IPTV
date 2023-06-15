<?php

use Slim\Views\PhpRenderer;


include 'db-controller.php';
include 'xtream-controller.php';

class RoutesController
{

    private $dbInstance;
    private $filters;
    private $msg;

    private $crud;
    private $renderer;
    private $xtream;

    public function __construct($db, $filters, $msg)
    {
        $this->dbInstance = $db;
        $this->filters = $filters;
        $this->msg = $msg;

        $this->crud = new CRUD($db);
        $this->renderer = new PhpRenderer('public');
        $this->xtream = new Xtream($this->crud);
    }

    public function isLogged()
    {
        $filters = $this->filters;
        $profile = false;

        if (isset($_SESSION['token']) && $filters->validUUID($_SESSION['token'])) {

            $get = $this->crud->getProfile($_SESSION['token']);
            if ($get) $profile = $get;
        }

        return $profile;
    }

    public function Language($only_options = false)
    {

        $languages = [

            'EN' => ['English', 'en_us.php'],
            'PT' => ['Portuguese', 'pt_br.php']

        ];

        if (isset($_COOKIE['language'])) $now = $this->filters->Alfa($_COOKIE['language'], '_');
        else $now = 'EN';

        if (array_key_exists($now, $languages)) {

            $languages = [
                'now' => $now,
                'opts' => $languages
            ];
        } else {

            $languages = [
                'now' => 'EN',
                'opts' => $languages
            ];
        }

        if ($only_options) return $languages;

        include 'src/language/' . $languages['opts'][$now][1];
        return json_decode(json_encode($translation));
    }

    private function detectRedirect($base64, $encode = true)
    {
        if ($this->filters->isBase64($base64) && $base64 != '/') {

            $clear = $this->filters->Xss(base64_decode($base64));
            $clear =  $this->filters->alNum($clear, ' \/\!?@,:._-');
            $clear = $this->filters->scapeString($clear);

            return $encode ? base64_encode($clear) : $clear;
        } else return false;
    }

    private function checkCache($id, $type, $is_serie)
    {
        $id_cache = false;
        $info_cache = $this->crud->getIDCache($id, $type);

        if ($info_cache) {

            $id_cache = $info_cache['id'];
            $info_video = json_encode([
                [
                    'id' => $id,
                    'type' => $type
                ]
            ]);
        } else {

            $info_video = $this->xtream->searchByID($id, $is_serie);

            if ($info_video) {
                $id_cache = $this->crud->addCache(json_decode($info_video)[0]);
            }
        }


        return [$id_cache, $info_video];
    }


    public function Index($req, $res, $args)
    {

        //$this->xtream->generateJSON();
        $filters = $this->filters;

        $profile = $this->isLogged();

        $suggestion_1 = false;
        $suggestion_2 = false;
        $is_recents = false;


        if ($profile) {
            $get_recents = $this->crud->getRecentsVideos($profile['id']);
            if (count($get_recents) > 0) {
                $suggestion_1 = json_decode(json_encode($get_recents));
                $suggestion_2 = $this->xtream->getMoviesRand(18, true);
                $is_recents = true;
            } else {
                $suggestion_1 = $this->xtream->getMoviesRand(24, true);
                $suggestion_2 = $this->xtream->getMoviesRand(18);
            }
        } else {
            $suggestion_1 = $this->xtream->getMoviesRand(24, true);
            $suggestion_2 = $this->xtream->getMoviesRand(18);
        }


        $body = [

            'profile' => $this->isLogged(),
            'lang_opt' => $this->Language(true),
            'language' => $this->Language(),
            'vods_index' => json_decode(json_encode([

                [
                    'name' => 'Recently Added',
                    'content' => $this->xtream->getVodsLaunch(24)
                ],
                [
                    'name' => 'Rand',
                    'content' => $this->xtream->getMoviesRand(24)
                ]

            ])),

            'suggestion_header' => $suggestion_1,
            'suggestion_footer' => $suggestion_2,
            'is_recents' => $is_recents,
            'category' => $this->xtream->getAllCategory()
        ];

        return $this->renderer->render($res, "index.php", $body);
    }


    public function Login($req, $res, $args)
    {
        $filters = $this->filters;
        $msg = $this->msg;

        $redirect = $this->detectRedirect($args['redirect'] ?? '/');


        $body = [
            'create' => false,
            'redirect' => $redirect
        ];

        if (isset($_COOKIE['register_user'])) {
            $body['create'] =  $msg->create_account;
            setcookie('register_user', false, -1);
        }

        return $this->renderer->render($res, "login.php", $body);
    }

    public function Register($req, $res, $args)
    {

        $redirect = $this->detectRedirect($args['redirect'] ?? '/');
        $body = ['redirect' => $redirect];

        return $this->renderer->render($res, "register.php", $body);
    }

    public function confirmRegister($req, $res, $args)
    {
        $params = $req->getParsedBody();
        $filters = $this->filters;
        $msg = $this->msg;

        $name = $filters->Alfa($filters->Xss($params['name']), ' ');
        $email = $filters->Xss($params['email']);
        $username = $filters->Xss($params['username']);
        $password = $filters->Xss($params['password']);

        $redirect = $this->detectRedirect($params['redirect'] ?? '/');

        $body = [
            'error' => false,
            'success' => false,
            'redirect' => $redirect
        ];

        if (strlen($name) > 60) {
            $body['error'] = $msg->name_invalid;
        } elseif (!$filters->emailValid($email)) {
            $body['error'] = $msg->email_invalid;
        } elseif (strlen($username) > 30 || strlen($username) < 3 || !$filters->isAlNum($username, '_.')) {
            $body['error'] = $msg->username_invalid;
        } elseif (strlen($password) > 50 || strlen($password) < 3) {
            $body['error'] = $msg->pass_invalid;
        }

        if ($body['error']) {
            return $this->renderer->render($res, "register.php", $body);
        }


        $uuid = $filters->generateUUID();

        $add = $this->crud->addUser($name, $email, $username, $password, $uuid);

        if ($add == 1) {

            setcookie("register_user", $msg->create_account, time() + 3600);
            return $res->withHeader('Location', '/login' . ($redirect ? '/' . $redirect : ''))->withStatus(302);
        } elseif ($add == 3) {
            $body['error'] = $msg->user_already_exists;
            return $this->renderer->render($res, "register.php", $body);
        } else {
            $body['error'] = $msg->generic;
            return $this->renderer->render($res, "register.php", $body);
        }
    }


    public function checkLogin($req, $res, $args)
    {

        $params = $req->getParsedBody();
        $filters = $this->filters;
        $msg = $this->msg;

        $username = $filters->Xss($params['username']);
        $password = $filters->Xss($params['password']);


        $redirect_ = $this->detectRedirect($params['redirect'] ?? '/', false);
        $redirect = $redirect_ ? $redirect_ : '/';

        $body = [
            'error' => false,
            'redirect' => base64_encode($redirect_)
        ];

        $check = $this->crud->checkLogin($username, $password);


        if ($check) {
            session_start();
            $_SESSION['token'] = $check;
            return $res->withHeader('Location', $redirect)->withStatus(302);
        } else {
            $body['error'] = $msg->pass_user_invalid;
            return $this->renderer->render($res, "login.php", $body);
        }


        $res->getBody()->write("");
        return $res;
    }


    public function detailMovie($req, $res, $args)
    {
        $filters = $this->filters;

        $id = $filters->Num($args['id']);
        $details = $this->xtream->getDetailMovie($id);

        $profile = $this->isLogged();
        $info_db = false;

        if ($profile) {
            $info_db = $this->crud->getDetailsVideo($id, 'movie', $profile['id']);
            $info_db = $info_db[0] ?? false;
        }


        $body = [
            'profile' => $profile,
            'lang_opt' => $this->Language(true),
            'language' => $this->Language(),
            'category' => $this->xtream->getAllCategory(),
            'info_db' => json_decode(json_encode($info_db)),
            'details' => $details
        ];


        return $this->renderer->render($res, "details_vod.php", $body);
    }


    public function detailSerie($req, $res, $args)
    {
        $filters = $this->filters;

        $id = $filters->Num($args['id']);
        $details = $this->xtream->getDetailMovie($id, true);

        $profile = $this->isLogged();
        $info_db = false;

        if ($profile) {
            $info_db = $this->crud->getDetailsVideo($id, 'serie', $profile['id']);
            $info_db = $info_db[0] ?? false;
        }


        $body = [
            'profile' => $profile,
            'lang_opt' => $this->Language(true),
            'language' => $this->Language(),
            'category' => $this->xtream->getAllCategory(),
            'info_db' => json_decode(json_encode($info_db)),
            'details' => $details
        ];


        return $this->renderer->render($res, "details_serie.php", $body);
    }


    public function watchMovie($req, $res, $args)
    {

        $filters = $this->filters;

        $type = $filters->Alfa($args['type']);
        $id = $filters->Num($args['id']);
        $extension = $filters->alNum($args['extension']);

        $redirect = $this->xtream->redirectMovie($type, $id, $extension);

        return $res->withHeader('Location', $redirect)->withStatus(302);
    }



    public function Catalog($req, $res, $args)
    {

        $filters = $this->filters;

        $category = $this->xtream->getAllCategory();

        $type = isset($args['type']) && $args['type'] == 'series' ? 'series' : 'movies';
        $arch = isset($args['type']) && $args['type'] == 'series' ? 'series' : 'vods';

        $genre = isset($args['genre']) && $args['genre'] > 0 ? $filters->Num($args['genre']) : false;

        if ($genre) {

            $confirm = false;

            foreach ($category[$arch] as $row) {
                if ($row->category_id == $genre) {
                    $confirm = true;
                    break;
                }
            }

            if (!$confirm) $genre = $category[$arch][0]->category_id;
        } else $genre = $category[$arch][0]->category_id;

        $page = isset($args['page']) && $args['page'] > 0 ? $filters->Num($args['page']) : 1;

        $body = [

            'profile' => $this->isLogged(),
            'lang_opt' => $this->Language(true),
            'language' => $this->Language(),
            'category' => $category,
            'args' => [$type, $genre, $arch],
            'results' =>  $this->xtream->searchByCategory($arch, $genre, $page)
        ];


        return $this->renderer->render($res, "catalog.php", $body);
    }


    public function Search($req, $res, $args)
    {
        $filters = $this->filters;
        $msg = false;

        $term = $filters->termSearch($filters->AlNum($args['search'], ' !?@,:._-'));
        $term = $filters->Xss($term);
        $term = $filters->scapeString($term);

        if (strlen($term) > 2 && strlen($term) < 20) {
            $results = $this->xtream->searchByTerm($term, $filters);
        } else {
            $msg = $this->msg->caracteres_search;
            $results = json_decode(json_encode([
                'term' => $term,
                'qtd' => 0,
                'data' => []
            ]));
        }

        $body = [
            'profile' => $this->isLogged(),
            'lang_opt' => $this->Language(true),
            'language' => $this->Language(),
            'category' => $this->xtream->getAllCategory(),
            'msg' => $msg,
            'results' => $results
        ];

        return $this->renderer->render($res, "search.php", $body);
    }

    public function addList($req, $res, $args)
    {
        $filters = $this->filters;

        $data = false;
        $code = 400;

        $profile = $this->isLogged();

        if (!$profile) {
            $data = ["error" => $this->msg->not_logged];
        } else {

            $params = $req->getParsedBody();

            $id = $filters->Num($params['id']);
            $type = isset($params['type']) && $params['type'] == 'serie' ? 'serie' : 'movie';
            $is_serie = $type == 'serie' ? true : false;

            $check_cache = $this->checkCache($id, $type, $is_serie);
            $id_cache = $check_cache[0];
            $info_video = $check_cache[1];


            if ($id_cache) {
                $add_list = $this->crud->addList(json_decode($info_video)[0], $profile['id']);

                if ($add_list) {
                    $data = true;
                    $code = 200;
                }
            }
        }


        $res->getBody()->write(json_encode($data));
        return $res->withStatus($code);
    }

    public function removeList($req, $res, $args)
    {
        $filters = $this->filters;

        $data = false;
        $code = 400;

        $profile = $this->isLogged();

        if (!$profile) {
            $data = ["error" => $this->msg->not_logged];
        } else {

            $params = $req->getParsedBody();

            $id = $filters->Num($params['id']);
            $type = isset($params['type']) && $params['type'] == 'serie' ? 'serie' : 'movie';

            $remove = $this->crud->removeList($id, $type, $profile['id']);

            if ($remove) {
                $data = true;
                $code = 200;
            }
        }


        $res->getBody()->write(json_encode($data));
        return $res->withStatus($code);
    }


    public function addWatched($req, $res, $args)
    {
        $filters = $this->filters;

        $data = false;
        $code = 400;

        $profile = $this->isLogged();

        if (!$profile) {
            $data = ["error" => $this->msg->not_logged];
        } else {

            $params = $req->getParsedBody();

            $id = $filters->Num($params['id']);
            $type = isset($params['type']) && $params['type'] == 'serie' ? 'serie' : 'movie';
            $id_ep = isset($params['id_ep']) ? $filters->Num($params['id_ep']) : null;

            $is_serie = $type == 'serie' ? true : false;

            $check_cache = $this->checkCache($id, $type, $is_serie);
            $id_cache = $check_cache[0];
            $info_video = $check_cache[1];


            if ($id_cache) {
                $add_watched = $this->crud->addWatch($profile['id'], $id, $id_ep, $type);

                if ($add_watched) {
                    $data = ['id' => $add_watched];
                    $code = 200;
                }
            }
        }


        $res->getBody()->write(json_encode($data));
        return $res->withStatus($code);
    }


    public function updateCheckpoint($req, $res, $args)
    {
        $filters = $this->filters;

        $data = false;
        $code = 400;

        $profile = $this->isLogged();

        if (!$profile) {
            $data = ["error" => $this->msg->not_logged];
        } else {

            $params = $req->getParsedBody();

            $id = $filters->Num($params['id']);
            $checkpoint = $filters->Num($params['checkpoint'], '.');

            $update = $this->crud->setCheckpoint($profile['id'], $id, $checkpoint);

            if ($update) {
                $data = true;
                $code = 200;
            }
        }


        $res->getBody()->write(json_encode($data));
        return $res->withStatus($code);
    }

    public function Profile($req, $res, $args)
    {

        $filters = $this->filters;

        $profile = $this->isLogged();
        $data_profile = false;

        if (!$profile) {
            return $res->withHeader('Location', '/')->withStatus(302);
            exit;
        } else {
            $data_profile = $this->crud->getProfileData($profile['id']);
            $data_profile['list'] = isset($data_profile['list'][0]) ? json_decode($data_profile['list']) : [];
            $data_profile['watched'] = isset($data_profile['watched'][0]) ? json_decode($data_profile['watched']) : [];
        }

        $body = [

            'profile' => $profile,
            'lang_opt' => $this->Language(true),
            'language' => $this->Language(),
            'category' => $this->xtream->getAllCategory(),
            'data_profile' => $data_profile
        ];

        return $this->renderer->render($res, "profile.php", $body);
    }


    public function pageError($req, $res, $args)
    {
        return $this->renderer->render($res, "404.php", []);
    }
}
