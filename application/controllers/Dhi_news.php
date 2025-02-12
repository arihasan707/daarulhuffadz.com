<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dhi_news extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('app');
    }

    public function index()
    {
        $title = [
            "title" => "DHI News - Pesantren Tahfidz Daarul Huffadz Indonesia - Mencetak Generasi Penghafal Al-Qur'an"
        ];
        
        $maps_footer['maps'] = $this->app->all('tbl_cabang')->result();
        
        $data = [
            
            'news' => $this->app->all('tbl_news'),
        ];

        $this->load->view('template/v_header', $title);
        $this->load->view('v_nav');
        $this->load->view('v_news', $data);
        $this->load->view('template/v_footer' ,$maps_footer);
    }

    public function detail($slug)
    {
        $title = [
           "title" => "DHI News - Pesantren Tahfidz Daarul Huffadz Indonesia - Mencetak Generasi Penghafal Al-Qur'an"
        ];
        
        $maps_footer['maps'] = $this->app->all('tbl_cabang')->result();
        
        $data = [
            'news_join' => $this->app->news_join(['slug' => $slug])->row(),
            'news' => $this->app->get_where('tbl_news',['slug' => $slug])->row(),
        ];

        $this->load->view('template/v_header', $title);
        $this->load->view('v_nav');
        $this->load->view('v_detail_news', $data);
        $this->load->view('template/v_footer' ,$maps_footer);
    }
}
