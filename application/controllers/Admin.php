<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// cek login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url() . 'welcome?pesan=belumlogin');
		}
	}

	function index()
	{
		$data['transaksi'] = $this->db->query("select * from transaksi order by transaksi_id desc limit 10")->result();
		$data['kostumer'] = $this->db->query("select * from kostumer order by kostumer_id desc limit 10")->result();
		$data['kamera'] = $this->db->query("select * from kamera order by kamera_id desc limit 10")->result();
		$this->load->view('admin/header');
		$this->load->view('admin/index', $data);
		$this->load->view('admin/footer');
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . 'welcome?pesan=logout');
	}

	function ganti_password()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/ganti_password');
		$this->load->view('admin/footer');
	}

	function ganti_password_act()
	{
		$pass_baru = $this->input->post('pass_baru');
		$ulang_pass = $this->input->post('ulang_pass');
		$this->form_validation->set_rules('pass_baru', 'Password Baru', 'required|matches[ulang_pass]');
		$this->form_validation->set_rules('ulang_pass', 'Ulangi Password Baru', 'required');

		if ($this->form_validation->run() != false) {
			$data = array(
				'admin_password' => md5($pass_baru)
			);
			$w = array(
				'admin_id' => $this->session->userdata('id')
			);
			$this->M_rental->update_data($w, $data, 'admin');
			redirect(base_url() . 'admin/ganti_password?pesan=berhasil');
		} else {
			$this->load->view('admin/header');
			$this->load->view('admin/ganti_password');
			$this->load->view('admin/footer');
		}
	}	
	
	// CRUD KAMERA
	function kamera()
	{
		$data['kamera'] = $this->m_rental->get_data('kamera')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/kamera', $data);
		$this->load->view('admin/footer');
	}

	function kamera_add()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/kamera_add');
		$this->load->view('admin/footer');
	}

	function kamera_add_act()
	{
		$merk = $this->input->post('merk');
		$plat = $this->input->post('plat');
		$warna = $this->input->post('warna');
		$status = $this->input->post('status');
		$this->form_validation->set_rules('merk', 'Merk Kamera', 'required');
		$this->form_validation->set_rules('status', 'Status Kamera', 'required');

		if ($this->form_validation->run() != false) {
			$data = array(
				'kamera_merk' => $merk,
				'kamera_plat' => $plat,
				'kamera_warna' => $warna,
				'kamera_status' => $status
			);
			$this->m_rental->insert_data($data, 'kamera');
			redirect(base_url() . 'admin/kamera');
		} else {
			$this->load->view('admin/header');
			$this->load->view('admin/kamera_add');
			$this->load->view('admin/footer');
		}
	}

// batas function edit
	function kamera_edit($id)
	{
		$where = array(
			'kamera_id' => $id
		);
		$data['kamera'] = $this->m_rental->edit_data($where, 'kamera')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/kamera_edit', $data);
		$this->load->view('admin/footer');
	}

	function kamera_update()
	{
		$id = $this->input->post('id');
		$merk = $this->input->post('merk');
		$plat = $this->input->post('plat');
		$warna = $this->input->post('warna');
		$status = $this->input->post('status');
		$this->form_validation->set_rules('merk', 'Merk Kamera', 'required');
		$this->form_validation->set_rules('status', 'Status Kamera', 'required');
		if ($this->form_validation->run() != false) {
			$where = array(
				'kamera_id' => $id
			);
			$data = array(
				'kamera_merk' => $merk,
				'kamera_plat' => $plat,
				'kamera_warna' => $warna,
				'kamera_status' => $status
			);
			$this->m_rental->update_data($where, $data, 'kamera');
			redirect(base_url() . 'admin/kamera');
		} else {
			$where = array(
				'kamera_id' => $id
			);
			$data['kamera'] = $this->M_rental->edit_data($where, 'kamera')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/kamera_edit', $data);
			$this->load->view('admin/footer');
		}
	}

	function kamera_hapus($id)
	{
		$where = array(
			'kamera_id' => $id
		);
		$this->m_rental->delete_data($where, 'kamera');
		redirect(base_url() . 'admin/kamera');

	}
	//AKHIR CRUD ADMIN

	//------------------------------------------------------||||||||------------------------------------------------------\\

//CRUD KOSTUMER
	function kostumer()
	{
		$data['kostumer'] = $this->m_rental->get_data('kostumer')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/kostumer', $data);
		$this->load->view('admin/footer');
	}

// untuk tambah kostumer
	function kostumer_add()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/kostumer_add');
		$this->load->view('admin/footer');

	}

	function kostumer_add_act()
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$hp = $this->input->post('hp');
		$ktp = $this->input->post('ktp');
		$this->form_validation->set_rules('nama', 'nama', 'required');


		if ($this->form_validation->run() != false) {
			$data = array(
				'kostumer_nama' => $nama,
				'kostumer_alamat' => $alamat,
				'kostumer_jk' => $jk,
				'kostumer_hp' => $hp,
				'kostumer_ktp' => $ktp
			);
			$this->m_rental->insert_data($data, 'kostumer');
			redirect(base_url() . 'admin/kostumer');
		} else {
			$this->load->view('admin/header');
			$this->load->view('admin/kostumer_add');
			$this->load->view('admin/footer');
		}
	}

	//Update kostumer
	function kostumer_edit($id)
	{
		$where = array(
			'kostumer_id' => $id
		);
		$data['kostumer'] = $this->m_rental->edit_data($where, 'kostumer')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/kostumer_edit', $data);
		$this->load->view('admin/footer');
	}

	function kostumer_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$jk = $this->input->post('jk');
		$hp = $this->input->post('hp');
		$ktp = $this->input->post('ktp');
		$this->form_validation->set_rules('nama', 'nama', 'required');

		if ($this->form_validation->run() != false) {
			$where = array(
				'kostumer_id' => $id
			);
			$data = array(
				'kostumer_nama' => $nama,
				'kostumer_alamat' => $alamat,
				'kostumer_jk' => $jk,
				'kostumer_hp' => $hp,
				'kostumer_ktp' => $ktp,

			);
			$this->m_rental->update_data($where, $data, 'kostumer');
			redirect(base_url() . 'admin/kostumer');
		} else {
			$where = array(
				'kostumer_id' => $id
			);
			$data['kostumer'] = $this->m_rental->edit_data($where, 'kostumer')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/kostumer_edit', $data);
			$this->load->view('admin/footer');
		}
	}

	function kostumer_hapus($id)
	{
		$where = array(
			'kostumer_id' => $id
		);
		$this->m_rental->delete_data($where, 'kostumer');
		redirect(base_url() . 'admin/kostumer');

	}

	//AKHIR CRUD KOSTUMER
//-----------------------------------------------||||----------------------------------------------------------------------\\
	//PROSES TRANSAKSI 

	function transaksi()
	{
		$data['transaksi'] = $this->db->query("select * from transaksi,kamera,kostumer where transaksi_kamera=kamera_id and transaksi_kostumer=kostumer_id")->result();
		$this->load->view('admin/header');
		$this->load->view('admin/transaksi', $data);
		$this->load->view('admin/footer');
	}

	function transaksi_add()
	{
		$w = array('kamera_status' => '1');
		$data['kamera'] = $this->m_rental->edit_data($w, 'kamera')->result();
		$data['kostumer'] = $this->m_rental->get_data('kostumer')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/transaksi_add', $data);
		$this->load->view('admin/footer');
	}
// Untuk memproses data transaksi
	function transaksi_add_act()
	{
		$kostumer = $this->input->post('kostumer');
		$kamera = $this->input->post('kamera');
		$tgl_pinjam = $this->input->post('tgl_pinjam');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$harga = $this->input->post('harga');
		$denda = $this->input->post('denda');

		$this->form_validation->set_rules('kostumer', 'Kostumer', 'required');
		$this->form_validation->set_rules('kamera', 'Kamera', 'required');
		$this->form_validation->set_rules('tgl_pinjam', 'Tanggal Pinjam', 'required');
		$this->form_validation->set_rules('tgl_kembali', 'Tanggal Kembali', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required');
		$this->form_validation->set_rules('denda', 'Denda', 'required');

		if ($this->form_validation->run() != false) {
			$data = array(
				'transaksi_karyawan' => $this->session->userdata('id'),
				'transaksi_kostumer' => $kostumer,
				'transaksi_kamera' => $kamera,
				'transaksi_tgl_pinjam' => $tgl_pinjam,
				'transaksi_tgl_kembali' => $tgl_kembali,
				'transaksi_harga' => $harga,
				'transaksi_denda' => $denda,
				'transaksi_tgl' => date('Y-m-d')
			);
			$this->m_rental->insert_data($data, 'transaksi');

			// update status mobil yg di pinjam			
			$d = array(
				'kamera_status' => '2'
			);
			$w = array(
				'kamera_id' => $kamera
			);
			$this->m_rental->update_data($w, $d, 'kamera');
			redirect(base_url() . 'admin/transaksi');
		} else {
			$w = array('mobil_status' => '1');
			$data['kamera'] = $this->m_rental->edit_data($w, 'kamera')->result();
			$data['kostumer'] = $this->m_rental->get_data('kostumer')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/transaksi_add', $data);
			$this->load->view('admin/footer');
		}
	}

	//hapus pada transaksi
	function transaksi_hapus($id)
	{
		$w = array(
			'transaksi_id' => $id

		);

		$data = $this->m_rental->edit_data($w, 'transaksi')->row();

		$ww = array(
			'kamera_id' => $data->transaksi_kamera
		);

		$data2 = array(
			'kamera_status' => '1'
		);

		$this->m_rental->update_data($ww, $data2, 'kamera');

		$this->m_rental->delete_data($w, 'transaksi');

		redirect(base_url() . 'admin/transaksi');
	}

	// method selesai transaksi sewa kamera
	function transaksi_selesai($id)
	{
		$data['kamera'] = $this->m_rental->get_data('kamera')->result();
		$data['kostumer'] = $this->m_rental->get_data('kostumer')->result();
		$data['transaksi'] = $this->db->query("select * from transaksi,kamera,kostumer where transaksi_kamera=kamera_id and transaksi_kostumer=kostumer_id and transaksi_id='$id'")->result();
		$this->load->view('admin/header');
		$this->load->view('admin/transaksi_selesai', $data);
		$this->load->view('admin/footer');
	}

	function transaksi_selesai_act()
	{
		$id = $this->input->post('id');
		$tgl_dikembalikan = $this->input->post('tgl_dikembalikan');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$mobil = $this->input->post('kamera');
		$denda = $this->input->post('denda');

		$this->form_validation->set_rules('tgl_dikembalikan', 'Tanggal Di Kembalikan', 'required');

		if ($this->form_validation->run() != false) {		
			// menghitung selisih hari
			$batas_kembali = strtotime($tgl_kembali);
			$dikembalikan = strtotime($tgl_dikembalikan);
			$selisih = abs(($batas_kembali - $dikembalikan) / (60 * 60 * 24));
			$total_denda = $denda * $selisih;
			
			// update status transaksi
			$data = array(
				'transaksi_tgldikembalikan' => $tgl_dikembalikan,
				'transaksi_status' => '1',
				'transaksi_totaldenda' => $total_denda
			);
			$w = array(
				'transaksi_id' => $id
			);

			$this->m_rental->update_data($w, $data, 'transaksi');

			// update status kamera
			$data2 = array(
				'kamera_status' => '1'
			);
			$w2 = array(
				'kamera_id' => $kamera
			);

			$this->m_rental->update_data($w2, $data2, 'kamera');
			redirect(base_url() . 'admin/transaksi');
		} else {
			$data['kamera'] = $this->m_rental->get_data('kamera')->result();
			$data['kostumer'] = $this->m_rental->get_data('kostumer')->result();
			$data['transaksi'] = $this->db->query("select * from transaksi,kamera,kostumer where transaksi_kamera=kamera_id and transaksi_kostumer=kostumer_id and transaksi_id='$id'")->result();
			$this->load->view('admin/header');
			$this->load->view('admin/transaksi_selesai', $data);
			$this->load->view('admin/footer');
		}
	}
	
	
 // Akhir trasaksi sewa

 //-----------------------------------------------||||||||||||||----------------------------------------------------
	
 //Method Laporan
	function laporan()
	{
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');
		$this->form_validation->set_rules('dari', 'Dari Tanggal', 'required');
		$this->form_validation->set_rules('sampai', 'Sampai Tanggal', 'required');

		if ($this->form_validation->run() != false) {
			$data['laporan'] = $this->db->query("select * from transaksi,kamera,kostumer where transaksi_kamera=kamera_id and transaksi_kostumer=kostumer_id and date(transaksi_tgl) >= '$dari'")->result();
			$this->load->view('admin/header');
			$this->load->view('admin/laporan_filter', $data);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/header');
			$this->load->view('admin/laporan');
			$this->load->view('admin/footer');
		}


	}

	//Method Laporan print
	function laporan_print()
	{
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');

		if ($dari != "" && $sampai != "") {
			$data['laporan'] = $this->db->query("select * from transaksi,kamera,kostumer where transaksi_kamera=kamera_id and transaksi_kostumer=kostumer_id and date(transaksi_tgl) >='$dari'")->result();
			$this->load->view('admin/laporan_print', $data);
		} else {
			redirect("admin/laporan");
		}

	}

	//method cetak laporan PDF bro

	function laporan_pdf()
	{
		$this->load->library('dompdf_gen');
		$dari = $this->input->get('dari');
		$sampai = $this->input->get('sampai');

		$data['laporan'] = $this->db->query("select * from transaksi,kamera,kostumer where transaksi_kamera=kamera_id and transaksi_kostumer=kostumer_id and date(transaksi_tgl) >='$dari'")->result();

		$this->load->view('admin/laporan_pdf', $data);
		$paper_size = 'A4'; //ukuran kertas bos
		$orientation = 'landscape'; //tipe format kertas portait atau landscape

		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);
		//MengConvert ke PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan.pdf", array('Attachment' => 0));
	}

}

