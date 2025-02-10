<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galeri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('app');
    }

    public function Index()
    {
        $title['title'] = "Galeri - Pesantren Tahfidz Daarul Huffadz Indonesia - Mencetak Generasi Penghafal Al-Qur'an";

        $data = [
            'galeri' => $this->app->get_all('tbl_galeri')->result()
        ];

        $this->load->view('template/v_header', $title);
        $this->load->view('v_nav');
        $this->load->view('galeri/v_galeri', $data);
        $this->load->view('template/v_footer');
    }

    public function aktivitas($slug)
    {
        $title['title'] = "Galeri - Pesantren Tahfidz Daarul Huffadz Indonesia - Mencetak Generasi Penghafal Al-Qur'an";

        $nama_galeri = str_replace('-', ' ', $slug);

        $foto = $this->app->get_where('tbl_galeri', ['nama' => $nama_galeri])->row();

        $data = [
            'breadcrumb' => $foto->nama,
            'fotos' => $this->app->get_where('tbl_foto_galeri', ['galeri_id' => $foto->id])->result()
        ];

        $this->load->view('template/v_header', $title);
        $this->load->view('v_nav');
        $this->load->view('galeri/v_foto', $data);
        $this->load->view('template/v_footer');
    }
}