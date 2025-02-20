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

        $maps_footer['maps'] = $this->app->all('tbl_cabang')->result();

        $this->load->view('template/v_header', $title);
        $this->load->view('v_nav');
        $this->load->view('galeri/v_galeri', $data);
        $this->load->view('template/v_footer', $maps_footer);
    }

    public function aktivitas($slug, $param = null)
    {

        $title['title'] = "Galeri - Pesantren Tahfidz Daarul Huffadz Indonesia - Mencetak Generasi Penghafal Al-Qur'an";
        $maps_footer['maps'] = $this->app->all('tbl_cabang')->result();
        $nama_galeri = str_replace('-', ' ', $slug);

        if ($param) {
            $nama_folder = str_replace('-', ' ', $param);
            $folder = $this->app->get_where('tbl_folder_galeri', ['nama' => $nama_folder])->row();
            $fotos = $this->app->multi_where('tbl_foto_galeri', ['galeri_id' => $folder->galeri_id], ['folder_galeri_id' => $folder->id_folder_galeri])->result();

            $data = [
                'galeri' => $folder,
                'folder' => $folder,
                'fotos' => $fotos
            ];

            $this->load->view('template/v_header', $title);
            $this->load->view('v_nav');
            $this->load->view('galeri/v_folder_foto', $data);
            $this->load->view('template/v_footer', $maps_footer);
        } else {

            $galeri = $this->app->get_where('tbl_galeri', ['nama' => $nama_galeri])->row();
            $fotos = $this->app->get_where('tbl_foto_galeri', ['galeri_id' => $galeri->id])->result();
            $folder = $this->app->get_where('tbl_folder_galeri', ['galeri_id' => $galeri->id])->result();
            $data = [
                'galeri' => $galeri,
                'folder' => $folder,
                'fotos' => $fotos
            ];
            $this->load->view('template/v_header', $title);
            $this->load->view('v_nav');
            $this->load->view('galeri/v_foto', $data);
            $this->load->view('template/v_footer', $maps_footer);
        }
    }
}