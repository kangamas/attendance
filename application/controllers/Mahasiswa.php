<?php 
class Mahasiswa extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('mahasiswa_model'); //pemanggilan model mahasiswa
	}

	function index(){
		$data['data']=$this->mahasiswa_model->get_all_mahasiswa();
		$this->load->view('mahasiswa_view',$data);
	}

	function simpan(){
		$nim=$this->input->post('nim');
		$nama=$this->input->post('nama');
		$prodi=$this->input->post('prodi');

		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= './assets/'; //string, the default is application/cache/
		$config['errorlog']		= './assets/'; //string, the default is application/logs/
		$config['imagedir']		= './assets/images/'; //direktori penyimpanan qr code
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= '1024'; //interger, the default is 1024
		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$image_name=$nim.'.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $nim; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['file_name'] = time()."-".$nim;
		
		$this->load->library('upload', $config);
		$this->upload->do_upload('foto');
		
		

		$this->mahasiswa_model->simpan_mahasiswa($nim,$nama,$prodi,$image_name); //simpan ke database
		$this->session->set_flashdata('hasil','Insert Data Berhasil');
		redirect('mahasiswa'); //redirect ke mahasiswa usai simpan data
	}
	function hapus(){
		$nim = $this->uri->segment(3);
		$delete = $this->mahasiswa_model->hapus($nim);
		if ($delete) {
			$this->session->set_flashdata('hasil','Hapus Data Berhasil');
		}else{
			$this->session->set_flashdata('hasil','Hapus Data Gagal');
		}
		redirect('mahasiswa');
	}
	function pdfgenerator(){
		$this->load->library('pdf');
		$pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'SEKOLAH MENENGAH KEJURUSAN NEEGRI 2 LANGSA',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'NIM',1,0);
        $pdf->Cell(85,6,'NAMA MAHASISWA',1,0);
        $pdf->Cell(40,6,'PRODI',1,0);
        $pdf->Cell(40,6,'QR CODE',1,1);
        $pdf->SetFont('Arial','',10);
        $mahasiswa = $this->mahasiswa_model->get_all_mahasiswa()->result();
        foreach ($mahasiswa as $row){
        	$img = $pdf->image('assets/images/'.$row->qr_code,155, $pdf->GetY(),40,40);
            $pdf->Cell(20,40,$row->nim,1,0);
            $pdf->Cell(85,40,$row->nama,1,0);
            $pdf->Cell(40,40,$row->prodi,1,0);
            $pdf->Cell(40,40,$img,1,1); 
        }
        $pdf->Output();
	}
}