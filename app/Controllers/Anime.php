<?php

namespace App\Controllers;

use App\Models\AnimeModel;

class Anime extends BaseController
{
    protected $animeModel;
    public function __construct()
    {
        $this->animeModel = new AnimeModel();
    }
    public function index()
    {
        // $anime = $this->animeModel->findAll();

        $data = [
            'title' => 'Anime List',
            'anime' => $this->animeModel->getAnime()
        ];

        // Cara Konek db tanpa model :
        // $db = \Config\Database::connect();
        // $anime = $db->query("SELECT * FROM anime");
        // foreach ($anime->getResultArray() as $row) {
        //     d($row);
        // }


        return view('anime/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'anime' => $this->animeModel->getAnime($slug)
        ];
        return view('anime/detail', $data);
    }
}
