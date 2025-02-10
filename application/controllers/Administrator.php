<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username')) {
			redirect('auth');
		}
		$this->load->model('app');
	}

	public function index()
	{
		$title =  [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
		];
		$this->load->view('admin/v_header' , $title);
		$this->load->view('admin/v_nav', $title);
		$this->load->view('admin/dashboard/v_dashboard');
		$this->load->view('admin/v_footer');
	}
	
	public function kontak(){
		$title =  [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
		];
		$data = [
		 'kontak'=> $this->app->all('tbl_kontak_suport'),
		 'main_title' => 'Daftar Kontak',
		 'sub_title' => 'Daftar Kontak'
		];
		$this->load->view('admin/v_header' , $title);
		$this->load->view('admin/v_nav', $title);
		$this->load->view('admin/kontak/v_kontak',$data);
		$this->load->view('admin/v_footer');
	}
	
	public function hapus_kontak($id){
	$this->app->delete('tbl_kontak_suport',['id'=>$id] );
	$this->session->set_flashdata('sukses','data kontak telah di hapus');
	redirect('administrator/kontak');
	}
	
	public function akses_login()
	{
		$data1 = [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
			'main_title' => 'Akses Login',
			'sub_title' => 'Akses Login'
		];
		$data['admin']= $this->app->get_all('tbl_admin');
		$this->load->view('admin/v_header', $data1);
		$this->load->view('admin/v_nav');
		$this->load->view('admin/akses_admin/v_admin', $data);
		$this->load->view('admin/v_footer');
	}
	
	public function hapus_akses($id){
		$this->app->delete('tbl_admin', ['id'=>$id]);
		$this->session->set_flashdata('sukses_hapus' , 'akses login telah di hapus');
		redirect('administrator/akses_login');
	}
	
	public function tambah_akses(){
		$data = [
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'pass' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
			'hak_akses' => $this->input->post('hk')
		];

		$this->app->insert('tbl_admin', $data);
		$this->session->set_flashdata('sukses_tambah', 'akses login telah di buat');
		redirect('administrator/akses_login');
	}

	public function pengurus()
	{
		
		$title =  [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
		];
		$karyawan['k'] = $this->app->get_all('tbl_karyawan');

		$this->load->view('admin/v_header', $title);
		$this->load->view('admin/v_nav');
		$this->load->view('admin/pengurus/v_pengurus', $karyawan);
		$this->load->view('admin/v_footer');
	}

	public function tambah_karyawan()
	{
		$data = [
		'nama' => strip_tags($this->input->post('nama')),
		'jab' => strip_tags($this->input->post('jab')),
		];
		$this->app->insert('tbl_karyawan', $data);
		$this->session->set_flashdata('success',  'Di Tambah');
		redirect('administrator/pengurus');
	}

	public function hapus_karyawan()
	{
		$id = $this->input->post('id_karyawan');
		$path = './assets/backend/upload/' . $gbr;
		unlink($path);
		$this->app->delete('tbl_karyawan', ['id' => $id]);
		$this->session->set_flashdata('success', 'Di Hapus');
		redirect('administrator/pengurus');
	}

	public function program_unggulan()
	{
		$title =  [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
		];
		$prog['prog'] = $this->app->all('tbl_program');

		$this->load->view('admin/v_header', $title);
		$this->load->view('admin/v_nav');
		$this->load->view('admin/program_biaya/v_program_biaya', $prog);
		$this->load->view('admin/v_footer');
	}

	public function tambah_data_program()
	{
		$title =  [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
		];
		$this->load->view('admin/v_header', $title);
		$this->load->view('admin/v_nav');
		$this->load->view('admin/program_biaya/v_tambah_data');
		$this->load->view('admin/v_footer');
	}

	public function edit_program($id)
	{
		$title =  [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
		];
		$p['prog'] = $this->app->get_where('tbl_program', ['id' => $id])->result();
		$this->load->view('admin/v_header', $title);
		$this->load->view('admin/v_nav');
		$this->load->view('admin/program_biaya/v_edit_data', $p);
		$this->load->view('admin/v_footer');
	}

	public function proses_ubah_program($id)
	{
		$foto_lama = trim($this->input->post('gbr_lama'));
		$config['upload_path'] = './assets/backend/upload/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['gbr']['name']))
			if ($this->upload->do_upload('gbr')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/backend/upload/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
			    $config['quality'] = '83%';
				$config['width'] = 900;
				$config['height'] = 600;
				$config['new_image'] = './assets/backend/upload/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$data = [
					'slug' => url_title($this->input->post('nama_prog')),
					'nama_prog' => $this->input->post('nama_prog'),
					'sub' => $this->input->post('ket'),
					'gbr' => $gbr['file_name'],
					'ket' => $this->input->post('ket_detail')
				];
				$path = './assets/backend/upload/' . $foto_lama;
				unlink($path);
				$this->app->update('tbl_program', $data, ['id' => $id]);
				$this->session->set_flashdata('success',  'Di Edit');
				redirect('administrator/program_unggulan');
			} else {
				echo $this->session->set_flashdata('error', 'Ada Kesalahan Dalam Penginputan Data');
				redirect('administrator/program_unggulan');
			}
		else {
			$data = [
				'slug' => url_title($this->input->post('nama_prog')),
				'nama_prog' => $this->input->post('nama_prog'),
				'sub' => $this->input->post('ket'),
				'gbr' => $foto_lama,
				'ket' => $this->input->post('ket_detail')
			];
			$this->app->update('tbl_program', $data, ['id' => $id]);
			$this->session->set_flashdata('success',  'Di Edit');
			redirect('administrator/program_unggulan');
		}
	}

	public function simpan_prog()
	{
		$config['upload_path'] = './assets/backend/upload/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);
		if (!empty($_FILES['gbr']['name']))
			if ($this->upload->do_upload('gbr')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/backend/upload/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '83%';
				$config['width'] = 900;
				$config['height'] = 600;
				$config['new_image'] = './assets/backend/upload/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$data = [
					'slug' => url_title($this->input->post('nama_prog')),
					'nama_prog' => $this->input->post('nama_prog'),
					'sub' => $this->input->post('ket'),
					'gbr' => $gbr['file_name'],
					'ket' => $this->input->post('ket_detail')
				];
				$this->app->insert('tbl_program', $data);
				$this->session->set_flashdata('success',  'Di Tambah');
				redirect('administrator/program_unggulan');
			} else {
				echo $this->session->set_flashdata('error', 'Ada Kesalahan Dalam Penginputan Data');
				redirect('administrator/program_unggulan');
			}
		else {
			echo $this->session->set_flashdata('error', 'Ada Kesalahan Dalam Penginputan Data');
			redirect('administrator/program_unggulan');
		}
	}

	public function hapus_prog()
	{
		$id = $this->input->post('id_prog');
		$gbr = $this->input->post('gbr');
		$path = './assets/backend/upload/' . $gbr;
		unlink($path);
		$this->app->delete('tbl_program', ['id' => $id]);
		$this->session->set_flashdata('success', 'Di Hapus');
		redirect('administrator/program_unggulan');
	}

	public function proses_validasi()
	{
		$data["seleksi"] = $this->app->get_seleksi()->result();
		$title =  [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
		];
		$this->load->view('admin/v_header', $title);
		$this->load->view('admin/pendaftaran/v_nav');
		$this->load->view('admin/pendaftaran/v_seleksi', $data);
		$this->load->view('admin/v_footer');
	}
	
	public function data_pendaftaran()
	{
		$data["seleksi"] = $this->app->get_data_pendaftaran()->result();
		$title =  [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
		];
		$this->load->view('admin/v_header', $title);
		$this->load->view('admin/pendaftaran/data_pendaftaran/v_nav');
		$this->load->view('admin/pendaftaran/data_pendaftaran/v_data_pendaftaran', $data);
		$this->load->view('admin/v_footer');
	}
	
	public function detail_data($id)
	{
		$data["detail"] = $this->app->get_detail_seleksi($id);
		$title =  [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
		];
		$this->load->view('admin/v_header', $title);
		$this->load->view('admin/pendaftaran/data_pendaftaran/v_nav');
		$this->load->view('admin/pendaftaran/data_pendaftaran/v_detail', $data);
		$this->load->view('admin/v_footer');
	}

	public function download_foto($id)
	{
		$data = $this->app->get_detail_seleksi($id)->row();
		force_download('assets/backend/upload/' . $data->foto, NULL);
	}
	public function download_ktp($id)
	{
		$data = $this->app->get_detail_seleksi($id)->row();
		force_download('assets/backend/upload/' . $data->ktp, NULL);
	}
	public function download_ijazah($id)
	{
		$data = $this->app->get_detail_seleksi($id)->row();
		force_download('assets/backend/upload/' . $data->ijazah, NULL);
	}
	public function download_ngaji($id)
	{
		$data = $this->app->get_detail_seleksi($id)->row();
		force_download('assets/backend/upload/' . $data->rekaman, NULL);
	}

	public function cabang()
	{
		$title =  [
			'title' => "Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia",
		];
		$data['cabang'] = $this->app->get_all('tbl_cabang');
		$this->load->view('admin/v_header', $title);
		$this->load->view('admin/v_nav');
		$this->load->view('admin/cabang/v_cabang', $data);
		$this->load->view('admin/v_footer');
	}

	public function tambah_cabang()
	{
		$nm_cbng = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$google_maps = $this->input->post('maps');
		$data = [
			'nm_cbng' => $nm_cbng,
			'alamat' => $alamat,
			'map_google' => $google_maps
		];
		$this->app->insert('tbl_cabang', $data);
		$this->session->set_flashdata('success',  'Di Tambah');
		redirect('administrator/cabang');
	}
	
	public function hapus_cabang($id){
		$this->app->delete('tbl_cabang', ['id'=> $id]);
		$this->session->set_flashdata('success',  'Di Hapus');
		redirect('administrator/cabang');
		
	}
	
    public function galeri()
	{
		$data1 = [
			'title' => 'Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia',
			'head' => 'Galeri'

		];

		$data = [
			'galeri' => $this->app->lists()->result()
		];

		$this->load->view('admin/v_header', $data1);
		$this->load->view('admin/v_nav');
		$this->load->view('admin/galeri/v_album_foto', $data);
		$this->load->view('admin/v_footer');
	}

	public function tambah_galeri()
	{
		$nama_galeri = $this->input->post('nama_galeri');

		$config['upload_path'] = './assets/backend/upload/galeri/sampul/'; //path folder
		$config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);

		if (!empty($_FILES['sampul']['name']))
			if ($this->upload->do_upload('sampul')) {
				$gbr = $this->upload->data();

				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/backend/upload/galeri/sampul/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '83%';
				$config['width'] = 900;
				$config['height'] = 600;
				$config['new_image'] = './assets/backend/upload/galeri/sampul/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$data = [
					'nama' => $nama_galeri,
					'sampul' => $gbr['file_name'],
					'created_at' =>   date('Y-m-d H:i:s'),
				];

				$this->app->insert('tbl_galeri', $data);

				$this->session->set_flashdata('success',  'di tambah');
				redirect('administrator/galeri');
			} else {
				echo $this->session->set_flashdata('error', 'Ada Kesalahan Dalam Penginputan Data');
				redirect('administrator/galeri');
			}
		else {
			echo $this->session->set_flashdata('error', 'Ada Kesalahan Dalam Penginputan Data');
			redirect('administrator/galeri');
		}
	}

	public function edit_galeri($id)
	{
		$nama_galeri = $this->input->post('nama_galeri');
		$sampul = $this->input->post('sampul');

		$config['upload_path'] = './assets/backend/upload/galeri/sampul/'; //path folder
		$config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);

		if (!empty($_FILES['sampul']['name']))
			if ($this->upload->do_upload('sampul')) {
				$gbr = $this->upload->data();

				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/backend/upload/galeri/sampul/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '83%';
				$config['width'] = 900;
				$config['height'] = 600;
				$config['new_image'] = './assets/backend/upload/galeri/sampul/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$data = [
					'nama' => $nama_galeri,
					'sampul' => $gbr['file_name'],
					'created_at' =>   date('Y-m-d H:i:s'),
				];

				// hapus foto sebelumnya
				$galeri = $this->app->get_where('tbl_galeri', ['id' => $id])->row();
				$path = './assets/backend/upload/galeri/sampul/' . $galeri->sampul;
				unlink($path);

				$this->app->update('tbl_galeri', $data, ['id' => $id]);
				$this->session->set_flashdata('success',  'di edit');
				redirect('administrator/galeri');
			} else {
				echo $this->session->set_flashdata('error', 'Ada Kesalahan Dalam Penginputan Data');
				redirect('administrator/galeri');
			}
		else {

			$data = [
				'nama' => $nama_galeri,
				'created_at' =>   date('Y-m-d H:i:s'),
			];

			$this->app->update('tbl_galeri', $data, ['id' => $id]);

			$this->session->set_flashdata('success',  'di edit');
			redirect('administrator/galeri');
		}
	}

	public function hapus_galeri($id)
	{
		$galeri = $this->app->get_where('tbl_galeri', ['id' => $id])->row();
		$foto_galeri = $this->app->get_where('tbl_foto_galeri', ['galeri_id' => $id])->result();

		$path = './assets/backend/upload/galeri/sampul/' . $galeri->sampul;
		unlink($path);

		foreach ($foto_galeri as $key => $value) {
			$path1 = './assets/backend/upload/galeri/foto/' . $value->foto;
			unlink($path1);
		}

		$this->app->delete('tbl_galeri', ['id' => $id]);

		$this->app->delete('tbl_foto_galeri', ['galeri_id' => $id]);

		$this->session->set_flashdata('success', 'di hapus');

		redirect('administrator/galeri');
	}

	public function tambah_foto_galeri($id)
	{
		$data1 = [
			'title' => 'Administrator - Pesantren Tahfidz Daarul Huffadz Indonesia',
			'head' => 'Tambah Foto'

		];

		$data = [
			'fotos' => $this->app->get_where('tbl_foto_galeri', ['galeri_id' => $id])->result(),
			'foto' => $this->app->get_where('tbl_galeri', ['id' => $id])->row()
		];

		$this->load->view('admin/v_header', $data1);
		$this->load->view('admin/v_nav');
		$this->load->view('admin/galeri/v_tambah_foto_galeri', $data);
		$this->load->view('admin/v_footer');
	}

	public function proses_tambah_foto_galeri($id)
	{

		$foto = $this->app->get_where('tbl_galeri', ['id' => $id])->row();

		$config['upload_path'] = './assets/backend/upload/galeri/foto/'; //path folder
		$config['allowed_types'] = 'jpg|png|jpeg'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

		$this->upload->initialize($config);

		if ($this->upload->do_upload('foto')) {
			$gbr = $this->upload->data();

			//Compress Image
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/backend/upload/galeri/foto/' . $gbr['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '83%';
			$config['width'] = 900;
			$config['height'] = 600;
			$config['new_image'] = './assets/backend/upload/galeri/foto/' . $gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$data = [
				'galeri_id' => $id,
				'foto' =>   $gbr['file_name'],
			];

			$this->app->insert('tbl_foto_galeri', $data);
			$this->session->set_flashdata('success',  'di tambah');

			redirect('administrator/tambah_foto_galeri/' . $foto->id);
		} else {
			echo $this->session->set_flashdata('error', 'Masukan format foto yang benar');
			redirect('administrator/tambah_foto_galeri/' . $foto->id);
		}
	}

	public function hapus_foto_galeri($id)
	{
		$foto = $this->app->get_where('tbl_foto_galeri', ['id' => $id])->row();

		$path = './assets/backend/upload/galeri/foto/' . $foto->foto;
		unlink($path);

		$this->app->delete('tbl_foto_galeri', ['id' => $id]);

		redirect('administrator/tambah_foto_galeri/' . $foto->galeri_id);
	}
	

	
	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}