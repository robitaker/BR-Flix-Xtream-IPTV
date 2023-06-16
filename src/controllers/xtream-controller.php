<?php


class Xtream
{

    private $path = 'src/storage';
    private $crud;
    private $info;

    public function __construct($crud)
    {
        $this->crud = $crud;
        $this->info = $this->crud->getXsteamConfig();
    }

    private function Request($params)
    {
        $userAgent = 'Mozilla/5.0 (Linux; Android 10; SM-G996U Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Mobile Safari/537.36';

        $options = [
            'http' => [
                'header'  => "User-Agent: $userAgent\r\n"
            ]
        ];

        $preURL = $this->info['url'] . '/player_api.php?username=' . $this->info['user'] . '&password=' . $this->info['pass'] . '&' . $params;

        $context = stream_context_create($options);
        $data = @file_get_contents($preURL, false, $context);

        if ($data) return $data;
        else return false;
    }

    private function nameCategory($id, $is_serie = false)
    {

        $type  = $is_serie ? 'series_category.json' : 'vods_category.json';
        $get  = json_decode(file_get_contents($this->path . '/' . $type));

        foreach ($get as $row) {
            if ($row->category_id == $id) {
                return $row->category_name;
            }
        }

        return false;
    }


    private function organizerVods($arr)
    {
        $newData = [];

        foreach ($arr as $ind => $row) {
            $newData[$ind] = [

                'id' => $row->stream_id,
                'type' => 'movie',
                'added' => $row->added,
                'rating' => number_format((float)$row->rating, 1),
                'category_id' => $row->category_id,
                'category_name' => $this->nameCategory($row->category_id),
                'name' => $row->name,
                'img' => $row->stream_icon == "" ? 'https://i.ibb.co/LRnkp5V/No-Image-Placeholder-svg.png' : $row->stream_icon,
                'backdrop' => $row->backdrop_path[0] ?? false,
                'plot' => $row->plot ?? false
            ];
        }

        return json_encode($newData);
    }

    private function organizerSeries($arr)
    {

        $newData = [];

        foreach ($arr as $ind => $row) {

            $newData[$ind] = [

                'id' => $row->series_id,
                'type' => 'serie',
                'added' => $row->last_modified,
                'rating' => number_format((float)$row->rating, 1),
                'category_id' => $row->category_id,
                'category_name' => $this->nameCategory($row->category_id, true),
                'name' => $row->name,
                'img' => $row->cover == "" ? 'https://i.ibb.co/LRnkp5V/No-Image-Placeholder-svg.png' : $row->cover,
                'backdrop' => $row->backdrop_path[0] ?? false,
                'plot' => $row->plot ?? false,
                'genre' => $row->genre
            ];
        }

        return json_encode($newData);
    }


    public function getAllCategory()
    {

        $category_film  = json_decode(file_get_contents($this->path . '/' . 'vods_category.json'));
        $category_serie = json_decode(file_get_contents($this->path . '/' . 'series_category.json'));

        return [
            'vods' => $category_film,
            'series' => $category_serie
        ];
    }



    public function vodsByCategory($id, $max = 10, $order = 'desc')
    {

        $type  = 'vods.json';
        $vods  = json_decode(file_get_contents($this->path . '/' . $type));

        $new = [];
        $i = 0;

        foreach ($vods as $row) {
            if ($row->category_id == $id) {
                $new[$i] = $row;
                $i++;
            }
        }

        $new = $this->desc_asc_Movie(array_slice($new, 0, $max), $order);

        return $new;
    }

    public function desc_asc_Movie($arr, $order = 'desc')
    {

        if ($order == 'desc') {

            usort($arr, function ($a, $b) {
                return $b->added - $a->added;
            });
        } else {

            usort($arr, function ($a, $b) {
                return $a->added - $b->added;
            });
        }

        return $arr;
    }

    public function getMovies($offset = 0, $max = 10)
    {
    }

    public function getMoviesRand($max = 10, $is_serie = false)
    {

        $type  = $is_serie ? 'series.json' : 'vods.json';
        $get  = json_decode(file_get_contents($this->path . '/' . $type));
        $total = $get ? count($get) : 0;

        if ($total == 0) {
            return [];
        }

        $offset = mt_rand(0, $total - $max);

        if ($is_serie) $dataByRand = $this->organizerSeries(array_slice($get, $offset, $max));
        else $dataByRand = $this->organizerVods(array_slice($get, $offset, $max));

        return json_decode($dataByRand);
    }

    public function getVodsLaunch($max = 10)
    {
        $launch_id = json_decode(file_get_contents($this->path . '/' . 'vods_category.json'))[0]->category_id;
        $vods = $this->organizerVods($this->vodsByCategory($launch_id, $max));

        return json_decode($vods);
    }


    public function getDetailMovie($id, $is_serie = false)
    {

        function detailsSeasons($arr)
        {

            function escapeConditions($str)
            {
                $str = str_replace('"', "'", $str);
                $str = str_replace("ç", "c", $str);

                return $str;
            }

            $arr = json_decode(json_encode($arr), true);

            $seasons = [];
            $s_n = 0;

            foreach ($arr as $ind => $now) {

                $i = 0;

                foreach ($now as $row) {

                    $seasons[$s_n][$i] = [

                        'id' => $row['id'],
                        'name' => escapeConditions($row['title']),
                        'extension' => $row['container_extension'] ?? 'mp4',
                        'plot' => isset($row['info']['plot']) ? escapeConditions($row['info']['plot']) : '',
                        'img' => $row['info']['movie_image'] ?? 'https://i.ibb.co/LRnkp5V/No-Image-Placeholder-svg.png'
                    ];

                    $i++;
                }

                $s_n++;
            }

            return [count($arr), $seasons];
        }


        $type  = $is_serie ? 'action=get_series_info&series_id=' : 'action=get_vod_info&vod_id=';
        $data = $this->Request($type . $id);
        $data = json_decode($data);

        $info = false;

        if (!$is_serie) {

            $info = [

                'id' => $data->movie_data->stream_id,
                'type' => 'movie',
                'name' => $data->info->name,
                'rating' => number_format((float)$data->info->rating, 1),
                'img' => $data->info->movie_image == '' ? 'https://i.ibb.co/LRnkp5V/No-Image-Placeholder-svg.png' : $data->info->movie_image,
                'backdrop' =>  false,
                'date' => $data->info->releasedate,
                'description' => $data->info->description == '' ? 'No description' : $data->info->description,
                'genre' => $data->info->genre,
                'time' => $data->info->episode_run_time,
                'director' => $data->info->director,
                'country' => $data->info->country,
                'cast' => $data->info->cast,

                'extension' => $data->movie_data->container_extension
            ];
        } else {

            $seasons = detailsSeasons($data->episodes);

            $info = [

                'id' => $id,
                'type' => 'serie',
                'name' => $data->info->name,
                'rating' => number_format((float)$data->info->rating, 1),
                'img' => $data->info->cover == '' ? 'https://i.ibb.co/LRnkp5V/No-Image-Placeholder-svg.png' : $data->info->cover,
                'backdrop' =>  $data->info->backdrop_path[0] ?? false,
                'date' => $data->info->releaseDate,
                'description' => $data->info->plot == '' ? 'No description' : $data->info->plot,
                'genre' => $data->info->genre,
                'time' => $data->info->episode_run_time,
                'director' => $data->info->director,
                'cast' => $data->info->cast,

                'qtd_seasons' => $seasons[0],
                'seasons' => $seasons[1]
            ];
        }

        return json_decode(json_encode($info));
    }


    public function searchByCategory($type, $genre, $page, $max = 30)
    {

        function createArrPages($now, $max_pages)
        {

            $offset = $now - 1 > 1 ? $now - 1 : 1;
            $limit = $now + 2 <= $max_pages ? $now + 2 : $max_pages;

            $arr = [];
            for (; $offset <= $limit; $offset++) {
                $arr[$offset] = $offset;
            }

            return $arr;
        }

        $is_serie  = $type == 'series' ? true : false;
        $category  = $type == 'series' ? 'series.json' : 'vods.json';
        $get  = json_decode(file_get_contents($this->path . '/' . $category));

        $arr = [];

        foreach ($get as $ind => $row) {
            if ($row->category_id == $genre) {
                $arr[] = $row;
            }
        }

        $results = $is_serie ? json_decode($this->organizerSeries($arr)) : json_decode($this->organizerVods($arr));
        $qtd = count($results);

        $max_pages = ceil($qtd / $max);
        if ($page < 1) $page = 1;
        else if ($page > $max_pages) $page = $max_pages;

        $offset = $page * $max;
        $offset = $page == 1 ? 0 : $offset - $max;

        $results = $this->desc_asc_Movie(array_slice($results, $offset, $max));

        return json_decode(json_encode([
            'page' => $page,
            'max_pages' => $max_pages,
            'pages' => createArrPages($page, $max_pages),
            'qtd' => count($results),
            'genre' => $this->nameCategory($genre, $is_serie),
            'data' => $results
        ]));
    }


    public function searchByTerm($term, $filters)
    {


        function compare($searching, $title)
        {
            if (strpos($title, $searching) !== false) {
                return true;
            } else {
                return false;
            }
        }

        $get_movies  = json_decode(file_get_contents($this->path . '/' . 'vods.json'));
        $get_series  = json_decode(file_get_contents($this->path . '/' . 'series.json'));

        $arr = [];

        foreach ($get_movies as $ind => $row) {
            if (compare($term, $filters->termSearch($row->name))) {
                $arr[] = $row;
            }
        }

        $results = json_decode($this->organizerVods($arr));
        $arr = [];

        foreach ($get_series as $ind => $row) {
            if (compare($term, $filters->termSearch($row->name))) {
                $arr[] = $row;
            }
        }

        $tmp_results = json_decode($this->organizerSeries($arr));

        foreach ($tmp_results as $row) {
            $results[] = $row;
        }

        $results = $this->desc_asc_Movie($results);


        return json_decode(json_encode([
            'term' => $term,
            'qtd' => count($results),
            'data' => $results
        ]));
    }

    public function searchByID($id, $is_serie)
    {

        $type = $is_serie ? 'series.json' : 'vods.json';
        $get = json_decode(file_get_contents($this->path . '/' . $type));

        $info = false;

        foreach ($get as $row) {
            $id_video  = $is_serie ? $row->series_id : $row->stream_id;
            if ($id_video == $id) {
                $info = $is_serie ? $this->organizerSeries([$row]) : $this->organizerVods([$row]);
                break;
            }
        }

        return $info;
    }






    public function redirectMovie($type, $id, $extension)
    {

        if ($type == 'series') $type = 'series';

        $extensions_allowed = ['mp4', 'wav', 'mkv'];
        $extension = in_array($extension, $extensions_allowed) ? $extension : $extensions_allowed[0];

        return $this->info['url'] . '/' . $type . '/' . $this->info['user'] . '/' . $this->info['pass'] . '/' . $id . '.' . $extension;
    }


    public function generateJSON()
    {

        $requests = [
            'action=get_vod_streams',
            'action=get_series',
            'action=get_vod_categories',
            'action=get_series_categories'
        ];

        $filenames = [
            'vods.json',
            'series.json',
            'vods_category.json',
            'series_category.json'
        ];

        $filepath = $this->path . '/';

        foreach ($requests as $ind => $row) {

            $json = $this->Request($row);

            if (file_put_contents($filepath . $filenames[$ind], $json) !== false) {
                //
            }
        }
    }
}
