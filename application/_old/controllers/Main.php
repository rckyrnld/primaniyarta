<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public $nmuser, $sessuserid;

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('secure');
        $this->load->model('primamod');

        $this->nmuser = ""; 
        $this->decrypt_profilid = $this->secure->decrypt_url($this->session->sessprofilid);
        $this->decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $this->decrypt_email = $this->secure->decrypt_url($this->session->sessemail);;

        //ambil data user
        if($this->decrypt_email!="") {
            $u = $this->primamod->ambil_user($this->session->sessemail)->row();
            $this->nmuser = $u->nama;
        }
        
    }

    function index() {
        //title
        $data['title'] = "Login | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "daftar";

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('login', $data);
        $this->load->view('tpl_footer', $data);
    }

    function send_email() {
	$this->primamod->kirim_email("test email", "Kirim email", "rickyrinaldi.net@gmail.com", $cc=null, $bcc=null);
    }

    //cek login
    function ceklogin() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $l = $this->primamod->logineks($email, $password);
    }

    //halaman gagal login
    function logingagal() {
        //title
        $data['title'] = "Login | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "login";

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('logingagal', $data);
        $this->load->view('tpl_footer', $data);
    }

    //halaman kategori
    function kategori() {
        //title
        $data['title'] = "Kategori | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "kategori";

        //ambil data kategori primaniyarta
        $data['kat'] = $this->primamod->ambilkategori("", "");

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('kategori', $data);
        $this->load->view('tpl_footer', $data);
    }

    //halaman keistimewaan primaniyarta
    function keistimewaan() {
        //title
        $data['title'] = "Keistimewaan | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "keistimewaan";

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('keistimewaan', $data);
        $this->load->view('tpl_footer', $data);
    }

    //halaman formulir pendaftaran
    function formulir() {
        //title
        $data['title'] = "Formulir Pendaftaran Primaniyarta ".date("Y");
        
        //menu aktif
        $data['menu'] = "formulir";
        
        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('formulir', $data);
        $this->load->view('tpl_footer', $data);
    }

    //halaman pendaftaran user eksportir
    function daftar() {
        //cek status login
        if($this->decrypt_email!="") {
            redirect('main/profil');
        }

        //title
        $data['title'] = "Pendaftaran | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "daftar";

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('daftar', $data);
        $this->load->view('tpl_footer', $data);
    }

    //kirim data pendaftaran user eksportir
    function daftaruser() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->daftaruser($data);
    }

    //halaman keterangan akun sudah ada
    function akunsudahada() {
        //title
        $data['title'] = "Pendaftaran | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "daftar";

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('akunsudahada', $data);
        $this->load->view('tpl_footer', $data);
    }

    //halaman sukses daftar user eksportir
    function daftarsukses() {
        //title
        $data['title'] = "Pendaftaran | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "daftar";

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('daftarsukses', $data);
        $this->load->view('tpl_footer', $data);
    }

    //halaman gagal daftar user eksportir
    function daftargagal() {
        //title
        $data['title'] = "Pendaftaran | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "daftar";

        //view
        $this->load->view("tpl_header", $data);
        $this->load->view("daftargagal", $data);
        $this->load->view("tpl_footer", $data);
    }

    /* Akun Eksportir Start */
    //halaman home akun
    function beranda() {
        //cek login 
        if($this->decrypt_email=="") {
            redirect('main');
        }
        
        //title
        $data['title'] = "Akun Primaniyarta ".date("Y");

        //nama user
        $data['nmuser'] = $this->nmuser;

        //session idprofil
        $data['sessprofilid'] = $this->decrypt_profilid;

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/eksberanda', $data);
    }

    //halaman cek status pendaftaran perusahaan berdasarkan npwp
    function ceknpwp() {
        //cek login 
        if($this->decrypt_email=="") {
            redirect('main');
        }

        //title
        $data['title'] = "Cek Data Perusahaan | Primaniyarta ".date("Y");

        //nama user
        $data['nmuser'] = $this->nmuser;

        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/eksceknpwp', $data);
    }

    //cek data npwp perusahaan
    function prosesceknpwp() {
        $npwp = $this->input->post('npwp');
        $this->session->set_userdata('sessceknpwp', $npwp);

        $c = $this->primamod->ceknpwp($npwp);
        $nc = $c->num_rows();
        if($nc>0) {
            //ambil data nama perusahaan dan email yang terdaftar
            $np = $c->row()->nmperusahaan;
            $nb = $c->row()->nmbadanusaha;
            $em = $c->row()->email;
            $this->session->set_userdata('sessceknp', $np);
            $this->session->set_userdata('sessceknb', $nb);
            $this->session->set_userdata('sesscekem', $em);

            redirect('main/sudahterdaftar');
        }
        else {
            redirect('main/tambahprofil');
        }
    }

    //halaman tambah profil perusahaan
    function tambahprofil() {
        //cek login 
        if($this->decrypt_email=="") {
            redirect('main');
        }

        if($this->decrypt_profilid==0) {
            if(empty($this->session->sessceknpwp) || $this->session->sessceknpwp=="") {
                redirect('main/ceknpwp');
            }
        }

        //title 
        $data['title'] = "Form Profil Perusahaan | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "";

        //nama user
        $data['nmuser'] = $this->nmuser;

        //ambil kategori
        $data['kat'] = $this->primamod->ambilkategori("", "");

        //ambil data master
        $data['bu'] = $this->primamod->ambilbadanusaha('');
        $data['mo'] = $this->primamod->ambilmodal();
        $data['sb'] = $this->primamod->ambilskalabisnis();
        $data['ju'] = $this->primamod->ambiljenisusaha();
        $data['prov'] = $this->primamod->ambilprovinsi();

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/eksprofiltambah', $data);
    }

    //halaman profil perusahaan
    function profil() {
        //cek login 
        if($this->decrypt_email=="") {
            redirect('main');
        }

        if($this->decrypt_profilid==0) {
            if(empty($this->session->sessceknpwp) || $this->session->sessceknpwp=="") {
                redirect('main/ceknpwp');
            }
        }

        //title 
        $data['title'] = "Form Profil Perusahaan | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "";

        //nama user
        $data['nmuser'] = $this->nmuser;

        //ambil data master
        $data['bu'] = $this->primamod->ambilbadanusaha('');
        $data['mo'] = $this->primamod->ambilmodal();
        $data['sb'] = $this->primamod->ambilskalabisnis();
        $data['ju'] = $this->primamod->ambiljenisusaha();
        $data['prov'] = $this->primamod->ambilprovinsi();

        //variable boolean
        $bp = FALSE;

        //cek data idprofil di tabel pma_users
        $idprofil = $this->decrypt_profilid;
        if(!empty($idprofil)) {
            $p = $this->primamod->ambilprofil($idprofil)->row();
            $np = $this->primamod->ambilprofil($idprofil)->num_rows();
            if($np>0) { $bp = TRUE; }
        }

        //text value
        $data['vidbu'] = $bp==TRUE ? $p->idbadanusaha : "";
        $data['vnmprsh'] = $bp==TRUE ? $p->nmperusahaan : "";
        $data['vnib'] = $bp==TRUE ? $p->nib : "";
        $data['vtahun'] = $bp==TRUE ? $p->tahunberdiri : "";
        $data['vtahunekspor'] = $bp==TRUE ? $p->tahunekspor : "";
        $data['vbank'] = $bp==TRUE ? $p->bank : "";
        $data['vemail'] = $bp==TRUE ? $p->email : "";
        $data['vwebsite'] = $bp==TRUE ? $p->website : "";
        $data['vidmo'] = $bp==TRUE ? $p->idmodal : "";
        $data['vidsb'] = $bp==TRUE ? $p->idskala : "";
        $data['vidju'] = $bp==TRUE ? $p->idjenis : "";
        $data['vidprov'] = $bp==TRUE ? $p->idprovinsi : "";
        $data['vidprovpab'] = $bp==TRUE ? $p->idprovinsipabrik : "";
        $data['vnpwp'] = $bp==TRUE ? $p->npwp : $this->session->sessceknpwp;
        $data['valamat'] = $bp==TRUE ? $p->alamat : "";
        $data['vkota'] = $bp==TRUE ? $p->kota : "";
        $data['vtelepon'] = $bp==TRUE ? $p->telepon : "";
        $data['vfax'] = $bp==TRUE ? $p->fax : "";
        $data['valamatpab'] = $bp==TRUE ? $p->alamatpabrik : "";
        $data['vkotapab'] = $bp==TRUE ? $p->kotapabrik : "";
        $data['vteleponpab'] = $bp==TRUE ? $p->teleponpabrik : "";
        $data['vfaxpab'] = $bp==TRUE ? $p->faxpabrik : "";

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/eksprofil', $data);
    }

    //simpan profil eksportir
    function simpanprofil() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpanprofil($data);
    }

    //halaman data perusahaan sudah terdaftar
    function sudahterdaftar() {
        //title
        $data['title'] = "Perusahaan Sudah Terdaftar | Primaniyarta ".date("Y");


        //email user terdaftar
        $data['npwp_user'] = $this->session->sessceknpwp;
        $data['np_user'] = $this->session->sessceknp;
        $data['nb_user'] = $this->session->sessceknb;
        $data['email_user'] = $this->mask_email($this->session->sesscekem);

        //destroy session sessceknpwp
        $this->session->unset_userdata('sessceknpwp');

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/eksterdaftar', $data);
    }

    //reset npwp
    function resetnpwp() {
        //unset seesio sessceknpwp
        $this->session->unset_userdata('sessceknpwp');

        redirect('main/ceknpwp');
    }

    //halaman pilih kategori
    function pilihkategori() {
        //cek login 
        if($this->decrypt_email=="") {
            redirect('main');
        }

        //title
        $data['title'] = "Pilih Kategori Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "";

        //nama user
        $data['nmuser'] = $this->nmuser;

        //ambil data kategori
        $idprofil = $this->decrypt_profilid;
        $data['kat'] = $this->primamod->ambilkategoripilih($idprofil, "");
        $data['katp'] = $this->primamod->ambilkategorilain($idprofil);

        //variable boolean
        $bp = FALSE;
        
        //ambil data impor untuk ditampilkan ke form
        $idpilih = $this->secure->decrypt_url($this->uri->segment(3));
        if(!empty($idpilih)) {
            $p = $this->primamod->ambilkategoripilih($idprofil, $idpilih)->row();
            $np = $this->primamod->ambilkategoripilih($idprofil, $idpilih)->num_rows();
            if($np>0) { $bp = TRUE; }
        }

        //text value
        $data['idpilih'] = $idpilih;
        $data['vidkat'] = $bp==TRUE ? $p->idkategori : "";
        $data['vnmkat'] = $bp==TRUE ? $p->nmkategori : "";

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/ekskategori', $data);
    }

    //konfirmasi pilihan kategori primaniyarta
    /*function konfirmasikategori() {
        //cek login 
        if($this->decrypt_email=="") {
            redirect('main');
        }

        $idkategori = $this->input->post('idkategori'); 

        //ambil data kategori primaniyarta
        $data['kat'] = $this->primamod->ambilkategori($idkategori)->row();

        //$this->primamod->simpan_kategori_eks($idkategori);

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/ekskonfirmasikategori', $data);
    }*/

    //simpan pilihan kategori primaniyarta lainnya
    function simpankategorilainnya() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpankategorilainnya($data);
    }

    //hapus data pilihan kategori primaniyarta lainnya
    function hapuskategorilainnya() {
        $idpilih = $this->input->post('idpilih');

        $this->primamod->hapuskategorilainnya($idpilih);
    }

    //halaman kontak perusahaan
    function kontakpic() {
        //cek login 
        if(empty($this->session->sessemail) || $this->session->sessemail=="") {
            redirect('main');
        }

        //title 
        $data['title'] = "Informasi Kontak PIC | Primaniyarta ".date("Y");

        //nama user
        $data['nmuser'] = $this->nmuser;

        //variable boolean
        $bk = FALSE;

        //cek data idkontak di tabel pma_kontak_eks
        $idkontak = $this->secure->decrypt_url($this->uri->segment(3));
        if(!empty($idkontak)) {
            $k = $this->primamod->ambilkontak($idkontak, "")->row();
            $nk = $this->primamod->ambilkontak($idkontak, "")->num_rows();
            if($nk>0) { $bk = TRUE; }
        }

        //ambil data kontak perusahaan
        $idprofil = $this->decrypt_profilid;
        $data['kontak'] = $this->primamod->ambilkontak("", $idprofil);

        //text value
        $data['idprofil'] = $idprofil;
        $data['idkontak'] = $idkontak;
        $data['vnama'] = $bk==TRUE ? $k->namakontak : "";
        $data['vjabatan'] = $bk==TRUE ? $k->jabatan : "";
        $data['vemail'] = $bk==TRUE ? $k->email : "";
        $data['vtelp'] = $bk==TRUE ? $k->telepon : "";

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/ekskontak', $data);

    }

    //simpan kontak eksportir
    function simpankontak() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpankontak($data);
    }

    //hapus kontak eksportir
    function hapuskontakpic() {
        $idkontak = $this->input->post('idkontak');

        $this->primamod->hapuskontakpic($idkontak);
    }

    //halaman produk ekspor perusahaan
    function produk() {
        //cek login 
        if(empty($this->session->sessemail) || $this->session->sessemail=="") {
            redirect('main');
        }

        //title 
        $data['title'] = "Form Produk Ekspor | Primaniyarta ".date("Y");

        //nama user
        $data['nmuser'] = $this->nmuser;

        //halaman
        $page = $this->uri->segment(3);
        if(empty($page) || $page=="" || $page==null) { $page="form"; }
        $data['page'] = $page;

        //variable boolean
        $bp = FALSE; $bs = FALSE;

        //cek data idproduk di tabel pma_produk_eks
        $idproduk = $this->secure->decrypt_url($this->uri->segment(4));
        if(!empty($idproduk)) {
            $p = $this->primamod->ambilproduk($idproduk, "")->row();
            $np = $this->primamod->ambilproduk($idproduk, "")->num_rows();
            if($np>0) { $bp = TRUE; }
        }
        
        //cek data idprofil di tabel pma_survey_produk
        $idprofil = $this->decrypt_profilid;
        $s = $this->primamod->ambilsurveyproduk($idprofil)->row();
        $ns = $this->primamod->ambilsurveyproduk($idprofil)->num_rows();
        if($ns>0) { $bs = TRUE; }

        //ambil data produk ekspor perusahaan
        $data['produk'] = $this->primamod->ambilproduk("", $idprofil);
        //ambil data merek
        $data['merek'] = $this->primamod->ambilmerek("", $idprofil);
        //ambil data negara 
        $data['neg'] = $this->primamod->ambilnegara();

        //text value
        $data['idprofil'] = $idprofil;
        $data['idproduk'] = $idproduk;
        $data['vproduk'] = $bp==TRUE ? $p->produk : "";
        $data['vhscode'] = $bp==TRUE ? $p->hscode : "";
        $data['vidmerek'] = $bp==TRUE ? $p->idmerek : "";
        $data['veksmerekbuyer'] = $bs==TRUE ? $s->ekspormerekbuyer : "";
        $data['vbrandsendiri'] = $bs==TRUE ? $s->brandingsendiri : "";
        $data['vwakilluar'] = $bs==TRUE ? $s->perwakilanluarnegeri : "";
        $data['vbrandbuyer'] = $bs==TRUE ? $s->brandingdenganbuyer : "";

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/eksproduk', $data);
    }

    //simpan produk ekspor perusahaan
    function simpanproduk() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpanproduk($data);
    }

    //hapus data produk
    function hapusproduk() {
        $idproduk = $this->input->post('idproduk');

        $this->primamod->hapusproduk($idproduk);
    }

    //simpan survey produk
    function simpansurveyproduk() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpansurveyproduk($data);
    }

    //halaman merek
    function merek() {
        //cek login 
        if(empty($this->session->sessemail) || $this->session->sessemail=="") {
            redirect('main');
        }

        //title 
        $data['title'] = "Form Merek | Primaniyarta ".date("Y");

        //nama user
        $data['nmuser'] = $this->nmuser;

        //halaman
        $page = $this->uri->segment(3);
        if(empty($page) || $page=="" || $page==null) { $page="form"; }
        $data['page'] = $page;

        //variable boolean
        $bp = FALSE; $bs = FALSE;

        //idprofil
        $idprofil = $this->decrypt_profilid;

        //cek data idmerek di tabel pma_merek
        $idmerek = $this->secure->decrypt_url($this->uri->segment(4));
        if(!empty($idmerek)) {
            $p = $this->primamod->ambilmerek($idmerek, "")->row();
            $np = $this->primamod->ambilmerek($idmerek, "")->num_rows();
            if($np>0) { $bp = TRUE; }
        }
        
        //cek data iddaftar di tabel pma_merek_daftar
        $iddaftar = $this->secure->decrypt_url($this->uri->segment(4));
        if(!empty($iddaftar)) {
            $s = $this->primamod->ambilmerekdaftar($iddaftar, "")->row();
            $ns = $this->primamod->ambilmerekdaftar($iddaftar, "")->num_rows();
            if($ns>0) { $bs = TRUE; }
        }

        //ambil data merek
        $data['merek'] = $this->primamod->ambilmerek("", $idprofil);
        //ambil data pendaftaran merek
        $data['daftar'] = $this->primamod->ambilmerekdaftar("", $idprofil);
        //ambil data negara 
        $data['neg'] = $this->primamod->ambilnegara();

        //text value
        $data['idprofil'] = $idprofil;
        $data['idmerek'] = $idmerek;
        $data['iddaftar'] = $iddaftar;
        $data['vnmmerek'] = $bp==TRUE ? $p->nmmerek : "";
        $data['vidmerek'] = $bs==TRUE ? $s->idmerek : "";
        $data['vtgldaftar'] = $bs==TRUE ? $this->primamod->ubahtanggal("-", $s->tgldaftar) : "";
        $data['vidnegara'] = $bs==TRUE ? $s->idnegara : "";

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/eksmerek', $data);
    }

    //simpan data merek
    function simpanmerek() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpanmerek($data);
    }

    //hapus data merek
    function hapusmerek() {
        $idmerek = $this->input->post('idmerek');

        $this->primamod->hapusmerek($idmerek);
    }

    //simpan data pendaftaran merek
    function simpandaftarmerek() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpandaftarmerek($data);
    }

    //hapus data pendaftaran merek
    function hapusdaftarmerek() {
        $iddaftar = $this->input->post('iddaftar');

        $this->primamod->hapusdaftarmerek($iddaftar);
    }

    //halaman bahan baku
    function bahanbaku() {
        //cek login 
        if(empty($this->session->sessemail) || $this->session->sessemail=="") {
            redirect('main');
        }

        //title 
        $data['title'] = "Form Bahan Baku | Primaniyarta ".date("Y");

        //nama user
        $data['nmuser'] = $this->nmuser;

        //halaman
        $page = $this->uri->segment(3);
        if(empty($page) || $page=="" || $page==null) { $page="form"; }
        $data['page'] = $page;

        //variable boolean
        $bb = FALSE; $bs = FALSE;

        //cek data idproduk di tabel pma_produk_eks
        $idbahan = $this->secure->decrypt_url($this->uri->segment(4));
        if(!empty($idbahan)) {
            $b = $this->primamod->ambilbahanbaku($idbahan, "")->row();
            $nb = $this->primamod->ambilbahanbaku($idbahan, "")->num_rows();
            if($nb>0) { $bb = TRUE; }
        }
        
        //cek data idprofil di tabel pma_survey_produk
        $idprofil = $this->decrypt_profilid;
        $s = $this->primamod->ambilsurveybahanbaku($idprofil)->row();
        $ns = $this->primamod->ambilsurveybahanbaku($idprofil)->num_rows();
        if($ns>0) { $bs = TRUE; }

        //ambil data produk ekspor perusahaan
        $data['bahanbaku'] = $this->primamod->ambilbahanbaku("", $idprofil);

        //text value
        $data['idprofil'] = $idprofil;
        $data['idbahan'] = $idbahan;
        $data['vtahun'] = $bb==TRUE ? $b->tahun : "";
        $data['vlokal'] = $bb==TRUE ? $b->persen_lokal : "";
        $data['vimpor'] = $bb==TRUE ? $b->persen_impor : "";
        $data['vnilaiimpor'] = $bb==TRUE ? $b->nilai_impor : "";
        $data['vfrekreject'] = $bs==TRUE ? $s->frekuensi_product_reject : "";
        $data['vqc'] = $bs==TRUE ? $s->quality_control : "";
        $data['vrnd'] = $bs==TRUE ? $s->rnd : "";
        $data['volahlimbah'] = $bs==TRUE ? $s->olah_limbah : "";
        $data['viso9001'] = $bs==TRUE ? $s->iso_9001 : "";
        $data['viso14001'] = $bs==TRUE ? $s->iso_14001 : "";
        $data['vecolabel'] = $bs==TRUE ? $s->sertifikat_ecolabelling : "";

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/eksbahanbaku', $data);
    }

    //simpan bahan baku
    function simpanbahanbaku() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpanbahanbaku($data);
    }

    //hapus data bahan baku
    function hapusbahanbaku() {
        $idbahan = $this->input->post('idbahan');

        $this->primamod->hapusbahanbaku($idbahan);
    }

    //simpan survey bahan baku
    function simpansurveybahanbaku() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpansurveybahanbaku($data);
    }

    //halaman penjualan
    function penjualan() {
        //cek login 
        if(empty($this->session->sessemail) || $this->session->sessemail=="") {
            redirect('web/login');
        }

        //title 
        $data['title'] = "Form Penjualan | Primaniyarta ".date("Y");

        //nama user
        $data['nmuser'] = $this->nmuser;

        //halaman
        $page = $this->uri->segment(3);
        if(empty($page) || $page=="" || $page==null) { $page="nilai"; }
        $data['page'] = $page;

        //variable boolean
        $bp = FALSE; $bs = FALSE; $be = FALSE;

        //cek data idpenjualan di tabel pma_eks_penjualan
        $idjual = $this->secure->decrypt_url($this->uri->segment(4));
        if(!empty($idjual)) {
            $p = $this->primamod->ambilpenjualan($idjual, "")->row();
            $np = $this->primamod->ambilpenjualan($idjual, "")->num_rows();
            if($np>0) { $bp = TRUE; }
        }

        //cek data idekspor di tabel pma_eks_ekspor
        $idproflink = $this->secure->decrypt_url($this->uri->segment(4));
        $idproduk = $this->secure->decrypt_url($this->uri->segment(5));
        $idneglink = $this->secure->decrypt_url($this->uri->segment(6));
        if(!empty($idproflink)) {
            $e = $this->primamod->ambilekspor($idproduk, $idproflink, $idneglink)->row();
            $ne = $this->primamod->ambilekspor($idproduk, $idproflink, $idneglink)->num_rows();
            if($ne>0) { $be = TRUE; }
        }
        
        //cek data idprofil di tabel pma_survey_produk
        $idprofil = $this->decrypt_profilid;
        $s = $this->primamod->ambilsurveypenjualan($idprofil)->row();
        $ns = $this->primamod->ambilsurveypenjualan($idprofil)->num_rows();
        if($ns>0) { $bs = TRUE; }

        //ambil data penjualan ekspor
        $data['jual'] = $this->primamod->ambilpenjualan("", $idprofil);
        //ambil data penjualan ekspor
        $data['eks'] = $this->primamod->ambilekspor("", $idprofil, "");
         //ambil data negara 
         $data['neg'] = $this->primamod->ambilnegara();
         //ambil data produk
         $data['prod'] = $this->primamod->ambilproduk("", $idprofil);
         //ambil data pelabuhan
         $data['pel'] = $this->primamod->ambilpelabuhan();

        //text value
        $data['idprofil'] = $idprofil;
        $data['idproflink'] = $idproflink;
        $data['idneglink'] = $idneglink;
        $data['idproduk'] = $idproduk;
        $data['idjual'] = $idjual;
        $data['vtahun'] = $bp==TRUE ? $p->tahun : "";
        $data['vtotaljual'] = $bp==TRUE ? $p->total_penjualan : "";
        $data['vpersenekspor'] = $bp==TRUE ? $p->persen_ekspor : "";
        $data['vnilaiekspor'] = $bp==TRUE ? $p->nilai_ekspor : "";
        $data['vpersenlokal'] = $bp==TRUE ? $p->persen_lokal : "";
        $data['vnilailokal'] = $bp==TRUE ? $p->nilai_lokal : "";
        
        $data['vfrekkirim'] = $bs==TRUE ? $s->frekuensi_kirim_barang : "";
        $data['vmetodejual'] = $bs==TRUE ? $s->metode_penjualan : "";
        $data['vanakusaha'] = $bs==TRUE ? $s->punya_anak_perusahaan : "";
        $data['vpameran'] = $bs==TRUE ? $s->upaya_pameran_dagang : "";
        $data['vmisidagang'] = $bs==TRUE ? $s->upaya_misi_dagang : "";
        $data['vkatalog'] = $bs==TRUE ? $s->upaya_katalog : "";
        $data['vbinaan'] = $bs==TRUE ? $s->upaya_binaan_instansi : "";
        $data['vagen'] = $bs==TRUE ? $s->upaya_agen : "";
        $data['vonline'] = $bs==TRUE ? $s->upaya_online : "";
        $data['vlangsung'] = $bs==TRUE ? $s->upaya_langsung : "";
        $data['viklan'] = $bs==TRUE ? $s->upaya_iklan : "";
        $data['vpelabuhan'] = $bs==TRUE ? $this->primamod->ambilpelabuhaneks($idprofil) : "";
        $data['vneganakperusahaan'] = $bs==TRUE ? $s->negara_anak_perusahaan : "";

        $data['vnegekspor'] = $be==TRUE ? $e->idnegara : "";
        $data['vrasio2019'] = $be==TRUE ? $this->primamod->ambilpersenekspor($idprofil, $e->idproduk, $e->idnegara, '2019')->row()->persen_ekspor : "";
        $data['vrasio2020'] = $be==TRUE ? $this->primamod->ambilpersenekspor($idprofil, $e->idproduk, $e->idnegara, '2020')->row()->persen_ekspor : "";
        $data['vrasio2021'] = $be==TRUE ? $this->primamod->ambilpersenekspor($idprofil, $e->idproduk, $e->idnegara, '2021')->row()->persen_ekspor : "";
        $data['vprod'] = $be==TRUE ? $e->idproduk : "";;


        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/ekspenjualan', $data);
    }

    //simpan nilai penjualan
    function simpannilai() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpannilai($data);
    }

    //hapus nilai penjualan
    function hapusnilai() {
        $idjual = $this->input->post('idjual');

        $this->primamod->hapusnilai($idjual);
    }

    //simpan kegiatan ekspor
    function simpanekspor() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpanekspor($data);
    }

    //hapus kegiatan ekspor
    function hapusekspor() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->hapusekspor($data);
    }

    //simpan survey penjualan() 
    function simpansurveypenjualan() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpansurveypenjualan($data);
    }

    //halaman perpajakan
    function pajak() {
        //cek login 
        if(empty($this->session->sessemail) || $this->session->sessemail=="") {
            redirect('main');
        }

        //title 
        $data['title'] = "Form Perpajakan | Primaniyarta ".date("Y");

        //nama user
        $data['nmuser'] = $this->nmuser;

        //halaman
        $page = $this->uri->segment(4);
        if(empty($page) || $page=="" || $page==null) { $page="nilai"; }
        $data['page'] = $page;

        //variable boolean
        $bp = FALSE;

        //ambil data pajak
        $idprofil = $this->decrypt_profilid;
        $idpajak = $this->secure->decrypt_url($this->uri->segment(3));
        if(!empty($idpajak)) {
            $p = $this->primamod->ambilpajak($idpajak, "")->row();
            $np = $this->primamod->ambilpajak($idpajak, "")->num_rows();
            if($np>0) { $bp = TRUE; }
        }

        //ambil data pajak untuk ditampilkan ke tabel
        $data['pajak'] = $this->primamod->ambilpajak("", $idprofil);

        //text value
        $data['idpajak'] = $idpajak;
        $data['idprofil'] = $this->decrypt_profilid;
        $data['vtahun'] = $bp==TRUE ? $p->tahun : "";
        $data['vstatuspphbadan'] = $bp==TRUE ? $p->status_pph_badan : "";
        $data['vnilaipphbadan'] = $bp==TRUE ? $p->nilai_pph_badan : "";
        $data['vstatusppn'] = $bp==TRUE ? $p->status_ppn : "";
        $data['vnilaippn'] = $bp==TRUE ? $p->nilai_ppn : "";
        $data['vstatuspph21'] = $bp==TRUE ? $p->status_pph_pasal_21 : "";
        $data['vnilaipph21'] = $bp==TRUE ? $p->nilai_pph_pasal_21 : "";

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/ekspajak', $data);
    }

    //simpan pajak
    function simpanpajak() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpanpajak($data);
    }

    //hapus pajak
    function hapuspajak() {
        $idpajak = $this->input->post('idpajak');

        $this->primamod->hapuspajak($idpajak);
    }

    //halaman kisah keberhasilan
    function kisah() {
        //cek login 
        if(empty($this->session->sessemail) || $this->session->sessemail=="") {
            redirect('main');
        }

        //title 
        $data['title'] = "Kisah Keberhasilan | Primaniyarta ".date("Y");

        //nama user
        $data['nmuser'] = $this->nmuser;

        //variable boolean
        //$bp = FALSE;

        //ambil data pajak
        $idprofil = $this->decrypt_profilid;
        //cek jumlah kategori yang dipilih
        $data['kat'] = $this->primamod->cekkategoripilih($idprofil);
        
        /*$p = $this->primamod->ambilkisah("", "", $idprofil)->row();
        $np = $this->primamod->ambilkisah("", "", $idprofil)->num_rows();
        if($np>0) { $bp = TRUE; }*/

        //text value
        $data['idkisah'] = "";
        $data['idprofil'] = $this->decrypt_profilid;
        //$data['vkisah'] = $bp==TRUE ? $p->kisah : "";

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/ekskisah', $data);
    }

    //simpan kisah
    function simpankisah() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpankisah($data);
    }

    //halaman lain-lain
    function lainlain() {
        //cek login 
        if(empty($this->session->sessemail) || $this->session->sessemail=="") {
            redirect('main');
        }

        //title 
        $data['title'] = "Lain-lain | Primaniyarta ".date("Y");

        //nama user
        $data['nmuser'] = $this->nmuser;

        //halaman
        $page = $this->uri->segment(3);
        if(empty($page) || $page=="" || $page==null) { $page="naker"; }
        $data['page'] = $page;

        //variable boolean
        $bp = FALSE;

        //idprofil
        $idprofil = $this->decrypt_profilid;

        //idnaker
        $idnaker = $this->secure->decrypt_url($this->uri->segment(4));
        if(!empty($idnaker)) {
            $p = $this->primamod->ambilnaker($idnaker, "")->row();
            $np = $this->primamod->ambilnaker($idnaker, "")->num_rows();
            if($np>0) { $bp = TRUE; }
        }

        //ambil data tenaga kerja untuk ditampilkan ke tabel
        $data['naker'] = $this->primamod->ambilnaker("", $idprofil);
        //ambil data sertifikasi untuk ditampilkan ke tabel
        $data['sertifikat'] = "";
        //ambil data penghargaan untuk ditampilkan ke tabel
        $data['penghargaan'] = "";
        //ambil data csr untuk ditampilkan ke tabel
        $data['csr'] = "";
        //ambil data lhk untuk ditampilkan ke tabel
        $data['lhk'] = "";

        //text value
        $data['idprofil'] = $idprofil;

        $data['idnaker'] = $idnaker;
        $data['vtahunnaker'] = $bp==TRUE ? $p->tahun : "";
        $data['vlokal'] = $bp==TRUE ? $p->lokal : "";
        $data['vasing'] = $bp==TRUE ? $p->asing : "";

        $data['idsertifikat'] = "";
        $data['vtahunsertifikat'] = "";
        $data['vnmsertifikat'] = "";
        $data['vdikeluarkan'] = "";

        $data['idpenghargaan'] = "";
        $data['vtahunpenghargaan'] = "";
        $data['vnmpenghargaan'] = "";
        $data['vdiberikan'] = "";

        $data['idcsr'] = "";
        $data['vtahuncsr'] = "";
        $data['vkegiatan'] = "";
        $data['vstakeholder'] = "";

        $data['idlh'] = "";
        $data['vtahunlh'] = "";
        $data['vnmkegiatan'] = "";
        $data['vstakeholder'] = "";
        
        /*$data['vtahun'] = $bp==TRUE ? $p->tahun : "";
        $data['vstatuspphbadan'] = $bp==TRUE ? $p->status_pph_badan : "";
        $data['vnilaipphbadan'] = $bp==TRUE ? $p->nilai_pph_badan : "";
        $data['vstatusppn'] = $bp==TRUE ? $p->status_ppn : "";
        $data['vnilaippn'] = $bp==TRUE ? $p->nilai_ppn : "";
        $data['vstatuspph21'] = $bp==TRUE ? $p->status_pph_pasal_21 : "";
        $data['vnilaipph21'] = $bp==TRUE ? $p->nilai_pph_pasal_21 : "";*/

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/ekslainlain', $data);
    }

    //simpan tenaga kerja
    function simpannaker() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpannaker($data);
    }

    //hapus tenaga kerja
    function hapusnaker() {
        //returns all POST items with XSS filter
        $idnaker = $this->input->post('idnaker'); 

        $this->primamod->hapusnaker($idnaker);
    }

    //ambil data keterangan kategori primaniyarta
    function ambilketerangan() {
        $idkat = $this->input->post('idkat');
        $ket = $this->primamod->ambilketerangan($idkat);
        //$ket = 1;
        //echo $idkat;
        //echo $ket;
    }

    //ambil penjelasan skala bisnis
    function skala_bisnis_desc() {
        $idskala = $this->input->post('idskala');
        $ket = $this->primamod->skala_bisnis_desc($idskala);
    }

    //cek data pendaftaran perusahaan
    function cek_npwp() {
        $npwp = $this->input->post('npwp');

        $l = $this->primamod->cek_npwp($npwp);
        if($l==FALSE) {
            redirect('akun/profil');
        }
        else {
            redirect('akun/sudahterdaftar');
        }
    }

    /* KEPALA DAERAH PENDUKUNG EKSPOR */
    //form profil kepala daerah
    function kepala_daerah_profil() {
        //cek login 
        if($this->decrypt_email=="") {
            redirect('web/login');
        }

        //title 
        $data['title'] = "Profil Kepala Daerah| Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "";

        //nama user
        $data['nmuser'] = $this->nmuser;

        //ambil data master
        $data['prov'] = $this->primamod->ambilprovinsi();

        //variable boolean
        $bp = FALSE;

        //cek data idprofil di tabel pma_users
        $idprofil = $this->decrypt_profilid;
        if(!empty($idprofil)) {
            $p = $this->primamod->ambil_kepala_daerah($idprofil)->row();
            $np = $this->primamod->ambil_kepala_daerah($idprofil)->num_rows();
            if($np>0) { $bp = TRUE; }
        }

        //text value
        $data['vidtingkat'] = $bp==TRUE ? $p->idtingkat : "";
        $data['vidprov'] = $bp==TRUE ? $p->idprovinsi : "";
        $data['vkota'] = $bp==TRUE ? $p->kota : "";
        $data['vnmpejabat'] = $bp==TRUE ? $p->nmpejabat : "";
        $data['vmasa1'] = $bp==TRUE ? $p->masajabatan1 : "";
        $data['vmasa2'] = $bp==TRUE ? $p->masajabatan2 : "";
        $data['vnmpic'] = $bp==TRUE ? $p->nmpic : "";
        $data['vnohppic'] = $bp==TRUE ? $p->nohppic : "";
        $data['vemailpic'] = $bp==TRUE ? $p->emailpic : "";

        //view
        $this->load->view('akun/tpl_header', $data);
        $this->load->view('akun/tpl_sidemenu', $data);
        $this->load->view('akun/gub_profil', $data);
    }

    //simpan profil kepala daerah
    function simpan_profil_gub() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpan_profil_gub($data);
    }

    function kepala_daerah_kebijakan() {
        //cek login 
        if($this->decrypt_email=="") {
            redirect('web/login');
        }

        //title 
        $data['title'] = "Kebijakan Ekspor | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "";

        //nama user
        $data['nmuser'] = $this->nmuser;

        $data['kebijakan'] = $this->primamod->ambil_kebijakan_gub("", $this->decrypt_profilid);

        //variable boolean
        $bp = FALSE;

        //cek data idprofil di tabel pma_users
        $idkebijakan = $this->secure->decrypt_url($this->uri->segment(4));
        if(!empty($idkebijakan)) {
            $p = $this->primamod->ambil_kebijakan_gub($idkebijakan, $this->decrypt_profilid)->row();
            $np = $this->primamod->ambil_kebijakan_gub($idkebijakan, $this->decrypt_profilid)->num_rows();
            if($np>0) { $bp = TRUE; }
        }

        //text value
        $data['vtglkebijakan'] = $bp==TRUE ? $this->primamod->ubahtanggal("-", $p->tglkebijakan) : "";
        $data['vnokebijakan'] = $bp==TRUE ? $p->nokebijakan : "";
        $data['vnmkebijakan'] = $bp==TRUE ? $p->nmkebijakan : "";
        $data['vfile'] = $bp==TRUE ? $p->file : "";

        //view
        $this->load->view('akun/eks_tpl_header', $data);
        $this->load->view('akun/eks_tpl_sidemenu', $data);
        $this->load->view('akun/gub_kebijakan', $data);
    }

    function upload() {
        
        // Set preference 
        $config['upload_path'] = 'assets/uploads/kebijakan/'; 
        $config['allowed_types'] = 'jpg|pdf'; 
        $config['max_size'] = '1000'; // max_size in kb 

        // Load upload library 
        $this->load->library('upload',$config);
        
        // File upload
        if($this->upload->do_upload("file")) {
            // Get data about the file
            $uploadData = $this->upload->data(); 
            $filename = $uploadData['file_name'];
            echo 'successfully uploaded '.$filename;     
        }
        else {
            echo 'failed '.$this->input->post('file'); 
        }
            
    }

    //simpan kebijakan kepala daerahh
    function simpan_kebijakan_gub() {
        //filename
        $idprofil = $this->input->post('idprofil');
        $iduser = $this->decrypt_userid;
        $filename = $idprofil."-".$iduser."-".str_replace(" ", "_", $_FILES["file"]['name']);

        $data = array(
            'filename' => $filename,
            'idprofil' => $this->input->post('idprofil'),
            'tglkebijakan' => $this->input->post('tglkebijakan'),
            'nokebijakan' => $this->input->post('nokebijakan'),
            'nmkebijakan' => $this->input->post('nmkebijakan'),
        );

        // Set preference 
        $config['upload_path'] = 'assets/uploads/kebijakan/'; 
        $config['allowed_types'] = 'pdf'; 
        $config['max_size'] = '5000'; // max_size in kb 
        $config['file_name'] = $filename;

        // Load upload library 
        $this->load->library('upload',$config);
        
        // File upload
        if($this->upload->do_upload("file")) {
            // Get data about the file
            $uploadData = $this->upload->data(); 
            //$data['filename'] = $uploadData['file_name'];
            //returns all POST items with XSS filter
            //$data = $this->input->post(NULL, TRUE); 

            $this->primamod->simpan_kebijakan_gub($data);     
        }
        else {
            echo 'failed '.$this->input->post('file'); 
        }
        
    }

    function kepala_daerah_kebijakan_hapus() {
        $idkebijakan = $this->secure->decrypt_url($this->uri->segment(4));
        
        $h = $this->primamod->kepala_daerah_kebijakan_hapus($idkebijakan);
        if($h==TRUE) {
            $this->session->set_userdata('sessupdatekebijakan', 'Berhasil hapus data');
        }
        else {
            $this->session->set_userdata('sessupdatekebijakan', 'Gagal hapus data');
        }

        redirect('akun/kepaladaerah/kebijakan');
    }

    function kepala_daerah_kisah() {
         //cek login 
         if($this->decrypt_email=="") {
            redirect('web/login');
        }

        //title 
        $data['title'] = "Kisah Keberhasilan Kebijakan Ekspor | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "";

        //nama user
        $data['nmuser'] = $this->nmuser;

        //variable boolean
        $bp = FALSE;

        //cek data idprofil di tabel pma_users
        $idprofil = $this->decrypt_profilid;
        if(!empty($idprofil)) {
            $p = $this->primamod->ambil_kisah_gub($idprofil)->row();
            $np = $this->primamod->ambil_kisah_gub($idprofil)->num_rows();
            if($np>0) { $bp = TRUE; }
        }

        //text value
        $data['vkisah'] = $bp==TRUE ? $p->kisah : "";

        //view
        $this->load->view('akun/eks_tpl_header', $data);
        $this->load->view('akun/eks_tpl_sidemenu', $data);
        $this->load->view('akun/gub_kisah', $data);
    }

    //simpan kisah kepala daerah
    function simpan_kisah_gub() {
        //returns all POST items with XSS filter
        $data = $this->input->post(NULL, TRUE); 

        $this->primamod->simpan_kisah_gub($data);
    }

    //masking email
    function mask_email($email) {
        $prop=2; $start=""; $end="";
        $domain = substr(strrchr($email, "@"), 1);
        $mailname=str_replace($domain,'',$email);
        $name_l=strlen($mailname);
        $domain_l=strlen($domain);
            for($i=0;$i<=$name_l/$prop-1;$i++)
            {
            $start.='*';
            }

            for($i=0;$i<=$domain_l/$prop-1;$i++)
            {
            $end.='*';
            }

        return substr_replace($mailname, $start, 2, $name_l/$prop).substr_replace($domain, $end, 2, $domain_l/$prop);
    }

    //logout primaniyarta
    function logout() {
        //unset session sessemail
        //$this->session->unset_userdata('sessemail');
        //$this->session->unset_userdata('sessemailada');
        //$this->session->unset_userdata('sessnpwp');
        //$this->session->unset_userdata('sessuserid');
        //$this->session->unset_userdata('sessprofilid');

        $this->session->sess_destroy();

        //redirect ke halaman login
        redirect('main');
    }

    //halaman aktivasi akun eksportir
    /*function aktivasi($iduser) {
        $decrypt_id = $this->secure->decrypt_url($iduser);
        $a = $this->primamod->aktivasi_akun($decrypt_id);

        $this->session->unset_userdata('sessemailverif');

        if($a==TRUE) {
            //redirect ke halaman aktivasi sukses
            redirect('web/aktivasisukses');
        }
        else {
            //redirect ke halaman aktivasi sukses
            redirect('web/aktivasigagal');
        }
        
    }

    //halaman sukses aktivasi user eksportir
    function aktivasi_sukses_eks() {
        //title
        $data['title'] = "Aktivsi Akun | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "daftar";

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('eks_verifikasi_sukses', $data);
        $this->load->view('tpl_footer', $data);
    }

    //halaman login eksportir
    function login_eks() {
        //cek status login
        if($this->decrypt_email!="") {
            redirect('akun/profil');
        }

        //title
        $data['title'] = "Login | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "login";

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('eks_login', $data);
        $this->load->view('tpl_footer', $data);
    }*/

    /*//dashboard eksportir
    function akun_primaniyarta() {
        //cek data pendaftaran
        $c = $this->primamod->cek_user_eks($this->session->sessemail);
        if($c==TRUE) {
            redirect('web/profil');
        }

        //title 
        $data['title'] = "Akun | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "";

        //nama user
        $data['nmuser'] = $this->nmuser;

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('akun/cek_profil', $data);
        $this->load->view('tpl_footer', $data);

    }

    //from kontak perusahaan
    function form_kontak_eks() {
        //cek data pendaftaran
        $c = $this->primamod->cek_user_eks($this->session->sessemail);
        if($c==FALSE && empty($this->session->sessnpwp)) {
            redirect('akun');
        }

        //title 
        $data['title'] = "Form Kontak Perusahaan | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "";

        //nama user
        $data['nmuser'] = $this->nmuser;

        //variable boolean
        $bk = FALSE;

        //cek data idprofil di tabel pma_users
        $idkontak = $this->uri->segment(3);
        if(!empty($idkontak)) {
            $p = $this->primamod->ambil_kontak_eks($idkontak)->row();
            $np = $this->primamod->ambil_kontak_eks($idkontak)->num_rows();
            if($np>0) { $bk = TRUE; }
        }

        //ambil data kontak perusahaan
        $data['kontak'] = $this->primamod->ambil_kontak_eks($idkontak);

        //text value
        $data['idkontak'] = $idkontak;
        $data['vidkontak'] = $idkontak;
        $data['vnama'] = $bk==TRUE ? $p->namakontak : "";
        $data['vjabatan'] = $bk==TRUE ? $p->jabatan : "";
        $data['vemail'] = $bk==TRUE ? $p->email : "";
        $data['vtelepon'] = $bk==TRUE ? $p->telepon : "";

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('akun/eks_kontak', $data);
        $this->load->view('tpl_footer', $data);
    }

    //from kontak perusahaan
    function form_produk_eks() {
        //cek data pendaftaran
        $c = $this->primamod->cek_user_eks($this->session->sessemail);
        if($c==FALSE && empty($this->session->sessnpwp)) {
            redirect('akun');
        }

        //title 
        $data['title'] = "Form Produk Ekspor | Primaniyarta ".date("Y");

        //menu aktif
        $data['menu'] = "";

        //nama user
        $data['nmuser'] = $this->nmuser;

        //variable boolean
        $bp = FALSE; $bs = FALSE;

        //cek data idprofil di tabel pma_users
        $idproduk = $this->uri->segment(4);
        if(!empty($idproduk)) {
            $p = $this->primamod->ambil_produk($idproduk)->row();
            $np = $this->primamod->ambil_produk($idproduk)->num_rows();
            if($np>0) { $bp = TRUE; }

            $s = $this->primamod->ambil_survey_produk($idproduk)->row();
            $ns = $this->primamod->ambil_survey_produk($idproduk)->num_rows();
            if($ns>0) { $bs = TRUE; }
        }

        //text value
        $data['idproduk'] = $idproduk;
        $data['vproduk'] = $bp==TRUE ? $p->produk : "";
        $data['vhs'] = $bp==TRUE ? $p->hscode : "";
        $data['vmerek'] = $bp==TRUE ? $p->merek : "";
        $data['vtglmerek'] = $bp==TRUE ? $p->tglmerek : "";
        $data['vnegmerek'] = $bp==TRUE ? $p->negaramerek : "";

        $data['veksmerekbuyer'] = $bs==TRUE ? $s->ekspormerekbuyer : "";
        $data['vbrandsensiri'] = $bs==TRUE ? $s->brandingsendiri : "";
        $data['vwakilluarnegeri'] = $bs==TRUE ? $s->perwakilanluarnegeri : "";
        $data['vbranddenganbuyer'] = $bs==TRUE ? $s->brandingdenganbuyer : "";

        //view
        $this->load->view('tpl_header', $data);
        $this->load->view('akun/eks_produk', $data);
        $this->load->view('tpl_footer', $data);
    }*/

}