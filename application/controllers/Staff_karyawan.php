<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_karyawan extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
			redirect('auth');
		}
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		// $this->load->library('encryption');
		$this->load->model('app');
	}
    
    public function index(){
        $title =[
            'title' => "Pesantren Tahfidz Daarul Huffadz Indonesia"]; 
        $this->load->view('staff/v_header' ,$title);
        $this->load->view('staff/v_nav');
        $this->load->view('staff/v_dashboard');
        $this->load->view('staff/v_footer');
    }
    
    public function data_pmb_online(){
        $data["pmb"] = $this->app->pmb_karantina()->result();
        $title =[
            'title' => "Pesantren Tahfidz Daarul Huffadz Indonesia"]; 
        $this->load->view('staff/v_header',$title);
        $this->load->view('staff/v_nav');
        $this->load->view('staff/v_pmb' ,$data);
        $this->load->view('staff/v_footer');
    }
    
    public function flayer(){
        $data["flayer"] = $this->app->get_all('tbl_flayer')->result();
        $title =[
            'title' => "Pesantren Tahfidz Daarul Huffadz Indonesia"]; 
        $this->load->view('staff/v_header',$title);
        $this->load->view('staff/v_nav');
        $this->load->view('staff/v_flayer' ,$data);
        $this->load->view('staff/v_footer');
    }
    
    public function tambah_flayer(){
        $config['upload_path'] = './assets/backend/upload/flayer'; //path folder
        $config['allowed_types'] = 'png|jpg|jpeg'; 
        $config['encrypt_name'] = FALSE;
        $config['max-width'] = '929';
        $config['max-height'] = '929';
        $config['max-size'] = '100';
        
        $this->upload->initialize($config);
        
        $judul =$this->input->post('judul');
        
     if (!empty($_FILES['gbr']['name'])) {
        $this->upload->do_upload('gbr');
        $upload = $this->upload->data();
        $gbr = $upload["file_name"];
        $data = [
            'judul'=> $judul,
            'gbr'=> $gbr
        ];
        
        $this->app->insert('tbl_flayer',$data);
        $this->session->set_flashdata('sukses','ditambah');
        redirect('staff_karyawan/flayer');
        }
    }
    
    public function hapus_flayer($id)
	{
		$data = $this->app->get_where('tbl_flayer',['id'=> $id])->row();

		$path1 = './assets/backend/upload/flayer/' . $data->gbr;
		unlink($path1);

		$this->app->delete('tbl_flayer', ['id' => $id]);
	}
    
    public function diskon_pendaftaran(){
        $title =[
            'title' => "Pesantren Tahfidz Daarul Huffadz Indonesia"]; 
        $data = [
            'prog'=> $this->app->all('tbl_program')->result()
        ];
        $this->load->view('staff/v_header',$title);
        $this->load->view('staff/v_nav');
        $this->load->view('staff/v_diskon',$data);
        $this->load->view('staff/v_footer');
    }
    
    public function set_diskon_pendaftaran($id){
        
        $data = [
            'diskon'=> '1'
        ];
        $this->app->update('tbl_program',$data,['id'=>$id]);
        redirect('staff_karyawan/diskon_pendaftaran/');
    }
    
    public function unset_diskon_pendaftaran($id){
        
        $data = [
            'diskon'=> '0'
        ];
        $this->app->update('tbl_program',$data,['id'=>$id]);
        redirect('staff_karyawan/diskon_pendaftaran/');
    }
    
    public function dhi_news()
    {
        $title = [
            'title' => "Pesantren Tahfidz Daarul Huffadz Indonesia"
        ];

        $data['news'] = $this->app->all('tbl_news');
        $this->load->view('staff/v_header', $title);
        $this->load->view('staff/v_nav');
        $this->load->view('staff/news/v_news', $data);
        $this->load->view('staff/v_footer');
    }

    public function add_news()
    {
        $title = [
            'title' => "Pesantren Tahfidz Daarul Huffadz Indonesia"
        ];

        $this->load->view('staff/v_header', $title);
        $this->load->view('staff/v_nav');
        $this->load->view('staff/news/v_add_news');
        $this->load->view('staff/v_footer');
    }

    public function proses_add()
    {
        $judul = $this->input->post('judul');
        $slug = url_title($this->input->post('judul'));
        $isi = $this->input->post('isi');
        $tgl = date();

        $config['upload_path'] = './assets/backend/upload/'; //path folder
        $config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if (!empty($_FILES['foto']['name']))
            if ($this->upload->do_upload('foto')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/backend/upload/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '75%';
                $config['width'] = 770;
                $config['height'] = 450;
                $config['new_image'] = './assets/backend/upload/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data = [
                    'judul' => $judul,
                    'slug' => $slug,
                    'isi' => $isi,
                    'user_id' => $this->session->userdata('id'),
                    'foto' => $gbr['file_name'],
                    'created_at' =>   date('Y-m-d H:i:s'),
                    'updated_at' =>   date('Y-m-d H:i:s'),
                ];
                $this->app->insert('tbl_news', $data);
                $this->session->set_flashdata('success',  'Di Tambah');
                redirect('staff_karyawan/dhi_news');
            } else {
                echo $this->session->set_flashdata('error', 'Ada Kesalahan Dalam Penginputan Data');
                redirect('staff_karyawan/dhi_news');
            }
        else {
            echo $this->session->set_flashdata('error', 'Ada Kesalahan Dalam Penginputan Data');
            redirect('staff_karyawan/dhi_news');
        }
    }
    
        public function ck_upload()
    {
        if (isset($_FILES['upload']['tmp_name'])) {
            $file = $_FILES['upload']['tmp_name'];
            $fileName = $_FILES['upload']['name'];
            $fileNameArray = explode('.', $fileName);
            $extention = end($fileNameArray);
            $newImageName = rand() . '.' . $extention;
            $allowedExtention = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
            if (in_array($extention, $allowedExtention)) {
                move_uploaded_file($file, "./assets/backend/ck_upload/" . $newImageName);
                $functionNumber = $_GET['CKEditorFuncNum'];
                $url = base_url() . './assets/backend/ck_upload/' . $newImageName;
                $message = "";
                echo "<script type='text/javascript'>
                window.parent.CKEDITOR.tools.callFunction($functionNumber, '$url', $message )
                </script>";
            }
        }
    }
    
     public function delete_news($id)
    {
        $data = $this->app->get_where('tbl_news', ['id_news' => $id])->row();

        $path1 = './assets/backend/upload/' . $data->foto;
        unlink($path1);

        $this->app->delete('tbl_news', ['id_news' => $id]);
        redirect('staff_karyawan/dhi_news');
    }
    
    
}