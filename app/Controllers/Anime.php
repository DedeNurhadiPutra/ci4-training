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

        // jika anime tidak ada di tabel
        if (empty($data['anime'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Anime '  . $slug . ' tidak ditemukan.');
        }

        return view('anime/detail', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Tambah Anime',
            'validation' => \Config\Services::validation()
        ];

        return view('anime/create', $data);
    }

    public function save()
    {
        // validasi input

        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[anime.judul]',
                'errors' => [
                    'required' => '{field} Anime tidak boleh kosong',
                    'is_unique' => '{field} Anime sudah terdaftar'
                ]
            ],
            'penulis' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/anime/create')->withInput()->with('validation', $validation);
        }


        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->animeModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'sampul' => $this->request->getVar('sampul'),
            'rating' => $this->request->getVar('rating')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/anime');
    }


    public function delete($id)
    {
        $this->animeModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');

        return redirect()->to('/anime');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form ubah data Anime',
            'validation' => \Config\Services::validation(),
            'anime' => $this->animeModel->getAnime($slug)
        ];

        return view('anime/edit', $data);
    }

    public function update($id)
    {
        // cek judul 
        $animeLama = $this->animeModel->getAnime($this->request->getVar('slug'));
        if ($animeLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[anime.judul]';
        }


        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Anime tidak boleh kosong',
                    'is_unique' => '{field} Anime sudah terdaftar'
                ]
            ],
            'penulis' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/anime/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }


        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->animeModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'sampul' => $this->request->getVar('sampul'),
            'rating' => $this->request->getVar('rating')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/anime');
    }
}
