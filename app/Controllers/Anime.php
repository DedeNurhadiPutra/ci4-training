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
                    'required' => 'Judul Anime tidak boleh kosong',
                    'is_unique' => 'Judul Anime sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Penulis tidak boleh kosong'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/anime/create')->withInput()->with('validation', $validation);
            return redirect()->to('/anime/create')->withInput();
        }

        // jika ingin nama file sesuai dengan yang diupload maka gunakan ini:
        // // ambil gambar
        // $fileSampul = $this->request->getFile('sampul');
        // // pindahkan file ke folder public/img
        // $fileSampul->move('img');
        // // ambil nama file sampul
        // $namaSampul = $fileSampul->getName();

        // jika ingin generater nama file menjadi random maka gunakan ini:
        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // apakah gambar nya di upload atau tidak
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan file ke folder public/img
            $fileSampul->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->animeModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'sampul' => $namaSampul,
            'rating' => $this->request->getVar('rating')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/anime');
    }


    public function delete($id)
    {
        // cari gambar berdasarkan id
        $anime = $this->animeModel->find($id);
        // cek jika file gambarnya default.jpg
        if ($anime['sampul'] != 'default.jpg') {
            // hapus gambar
            unlink('img/' . $anime['sampul']);
        }

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
                    'required' => 'Judul Anime tidak boleh kosong',
                    'is_unique' => 'Judul Anime sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Penulis tidak boleh kosong'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/anime/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
            return redirect()->to('/anime/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        // cek gambar, apakah tetap gambar lama atau tidak?
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // generate nama file random
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan gambar
            $fileSampul->move('img/', $namaSampul);
            // kalo file baru hapus file lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->animeModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'sampul' => $namaSampul,
            'rating' => $this->request->getVar('rating')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/anime');
    }
}
