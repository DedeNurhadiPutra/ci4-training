<?php

namespace App\Controllers;

class Anime extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Anime List'
        ];

        return view('Anime/index', $data);
    }
}
