<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Primamod extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('secure');
        $this->load->database();
        
        $this->decrypt_profilid = $this->secure->decrypt_url($this->session->sessprofilid);
        $this->decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $this->decrypt_email = $this->secure->decrypt_url($this->session->sessemail);;
    }
    
    /*** LUPA PASSWORD START ***/
    
    //cek data email user
    function cekemailuser($email) {
        $this->db->select('email');
        $this->db->from('pma_users');
        $this->db->where('email', $email);
        $nq = $this->db->get()->num_rows();
        if($nq>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    //ambil iduser
    function ambildatauser($iduser, $email) {
        $this->db->select('iduser, nama, email, nohp, gub');
        $this->db->from('pma_users');
        if(!empty($iduser)) {
            $this->db->where('iduser', $iduser);
        }
        if(!empty($email)) {
            $this->db->where('email', $email);   
        }
        $q = $this->db->get();
        
        return $q;
    }
    
    //proses reset password
    function resetpassword($email) {
        //ambil iduser
        $iduser = $this->ambildatauser('', $email)->row()->iduser;
        $nama = $this->ambildatauser('', $email)->row()->nama;
        $encrypt_id = $this->secure->encrypt_url($iduser);
        $data = array(
            'email' => $email,
            'nama' => $nama,
            'tglminta' => date("Y-m-d H:i:s"),
            'linkreset' => base_url().'main/resetpassword/'.$encrypt_id,
            'pesanemail' => 'Yth Bapak/Ibu '.$nama.' <br><br>Berikut disampaikan link untuk reset password Anda.<br>'.base_url().'main/resetpassword/'.$encrypt_id.'<br><br>Demikian disampaikan, terima kasih.<br><br>Admin Primaniyarta'
        );
        
        $this->db->insert('pma_reset_password', $data);
        
        redirect('main/resetpasswordterkirim');
    }
    
    function gantipassword($data) {
        $status = $data['status'];

        //echo $status;
        //exit;
        
        //ganti password
        $encrypt_pass = $this->secure->encrypt_url($data['password']);
        $this->db->set('password', $encrypt_pass);
        $this->db->where('email',  $data['email']);
        $this->db->update('pma_users');
        $r = $this->db->affected_rows();
        if($r>0) {
            if($status=="reset") {
                redirect('main/resetpasswordberhasil');
            }
            if($status=="ganti") {
                $this->session->set_userdata('sessupdatepassword', 'Password berhasil diganti');
                $this->session->set_userdata('sesscw', 'success');
                redirect('main/userpassword');
            }
        }
        else {
            if($status=="reset") {
                redirect('main/resetpasswordgagal');
            }
            if($status=="ganti") {
                $this->session->set_userdata('sessupdatepassword', 'Password gagal diganti');
                $this->session->set_userdata('sesscw', 'danger');
                redirect('main/userpassword');
            }
        }
    }
    
    /*** LUPA PASSWORD END ***/
    
    /*** PROFIL USER START ***/
    
    function updateprofiluser($data) {
        $data1 = array(
            'nama' => $data['nama'],
            'nohp' => $data['nohp']
        );
        
        $this->db->where('iduser', $data['iduser']);
        $this->db->update('pma_users', $data1);
        
        $this->session->set_userdata('sessupdateprofiluser', 'Data profil berhasil diupdate');
        
        redirect('main/userprofil');
    }
    
    /*** PROFIL USER END ***/

    //ambil data kategori primaniyarta
    function ambilkategori($idkategori, $ex) {
        $this->db->select('*');
        $this->db->from('pma_kategori');
        if(!empty($idkategori)) {
            $this->db->where('idkategori', $idkategori);
        }
        if(!empty($ex)) {
            $this->db->where('idkategori!=', $ex);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil data kategori primaniyarta
    function ambilkategorilain($idprofil) {
        $this->db->select('pma_kategori.idkategori, pma_kategori.nmkategori, pma_eks_kategori_pilih.utama');
        $this->db->from('pma_kategori');
        $this->db->join('pma_eks_kategori_pilih', 'pma_eks_kategori_pilih.idkategori=pma_kategori.idkategori', 'LEFT');
        $this->db->join('pma_eks_profil', 'pma_eks_profil.idprofil=pma_eks_kategori_pilih.idprofil', 'LEFT');
        $this->db->where('pma_kategori.idkategori!=', '9');
        $this->db->where('pma_eks_kategori_pilih.idprofil is NULL', NULL, FALSE);
        
        $q = $this->db->get();

        return $q;
    }

    //daftar user eksportir
    function daftaruser($data) {
        //cek email exist
        if($this->cekemail($data['email'])==FALSE) {
            $this->session->set_userdata('sessemailada', $data['email']);
            redirect('main/akunsudahada');
        }
        else {
            $data1 = array(
                'nama' => $data['nama'],
                'email' => $data['email'],
                'nohp' => $data['nohp'],
                'password' => $this->secure->encrypt_url($data['password']),
                'akses' => '1',
                'status' => '1'
            );

            $this->db->insert('pma_users', $data1);

            $iduser = $this->db->insert_id();
            $encrypt_id  = $this->secure->encrypt_url($iduser);
            $encrypt_to = $this->secure->encrypt_url($data['email']);

            //$this->session->set_userdata('sessemailverif', $encrypt_to);

            //kirim email verifikasi
            /*$from = "djpen.prima@gmail.com";
            $nmfrom = "Primaniyarta ".date("2022");
            $to = $data['email'];
            $subject = "Verifikasi Pendaftaran Primaniyarta 2022";
            $body = "
            <html>
            <head>
            <style>
            .btn {
                margin: 5px 0px;
                padding: 5px 10px;
                color: #fff;
                background-color: green;
                text-decoration: none;
            }
            </style>
            </head>
            <body>
            <p>Hi ".$data['nama'].",</p>
            <p>Terima kasih sudah mendaftar untuk mengikuti Pengharagaan Primaniyarta 2022.<br>
            Silahkan klik tombol dibawah untuk aktivasi akun Anda.</p>
            <p><a class='btn' href='".base_url('aktivasi/'.$encrypt_id)."'>AKTIVASI AKUN</a></p>
            </body>
            </html>";

            $this->kirimemail($from, $nmfrom, $to, $subject, $body);*/

            //redirect ke halaman pendaftaran sukses
            redirect('main/daftarsukses/');
        }
    }

    //login primaniyarta
    function logineks($email, $password) {
        $encrypt_pass = $this->secure->encrypt_url($password);
        $this->db->select('iduser, email, idprofil, akses, status');
        $this->db->from('pma_users');
        $this->db->where('email', $email);
        $this->db->where('password', $encrypt_pass);
        $q = $this->db->get();
        $n = $q->num_rows();
        if($n>0) {
            $r = $q->row();
            //if($r->status==1) {
                //if($r->akses==1) {
                    $this->session->set_userdata('sessemail', $this->secure->encrypt_url($email));
                    $this->session->set_userdata('sessuserid', $this->secure->encrypt_url($r->iduser));
                    $this->session->set_userdata('sessprofilid', $this->secure->encrypt_url($r->idprofil));
                    
                    $this->primamod->update_log($email);
                    redirect('main/beranda');
                /*}
                else {
                    redirect('main/tidakbisaakses');
                }
            }
            else {
                redirect('web/belumaktivasi');
            }*/
        }
        else {
            redirect('main/logingagal');
        }
    }

    //cek data pendaftaran user
    function cekuser($email) {
        $this->db->select('idprofil');
        $this->db->from('pma_users');
        $this->db->where('email', $email);
        $q = $this->db->get();
        $n = $q->num_rows();
        if($n>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //cek data pendaftaran profil
    function cekprofil($email) {
        $this->db->select('*');
        $this->db->from('pma_eks_profil');
        $this->db->where('email', $email);
        $q = $this->db->get();
        $n = $q->num_rows();
        if($n>0) {
            return TRUE;
        } 
        else {
            return FALSE;
        }
    }

    //cek data pendaftaran perusahaan
    function ceknpwp($npwp) {
        $this->db->select('npwp, nmperusahaan, pma_users.email, nmbadanusaha');
        $this->db->from('pma_eks_profil');
        $this->db->join('pma_users', 'pma_users.idprofil=pma_eks_profil.idprofil');
        $this->db->join('pma_mst_badanusaha', 'pma_mst_badanusaha.idbadanusaha=pma_eks_profil.idbadanusaha');
        $this->db->where('npwp', $npwp);
        $q = $this->db->get();
        /*$n = $q->num_rows();
        $r = $q->row();
        $this->session->set_userdata('sessnpwp', $npwp);
        $this->session->set_userdata('sessemailnpwp', $r->email);
        if($n>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }*/

        return $q;
    }

    //cek data kategori yang dipilih
    /*function cek_kategori_eks($idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_kategori_pilih');
        $this->db->where('idprofil', $idprofil);
        $q = $this->db->get();
        $n = $q->num_rows();
        $r = $q->row();
        if($n>0) {
            $this->session->set_userdata('sessidkat', $r->idkategori);
            return TRUE;
        }
        else {
            return FALSE;
        }
    }*/

    //email user pendaftar profil perusahaan
    function email_pendaftar($npwp) {
        $this->db->select('email');
        $this->db->from('pma_users');
        $this->db->join('pma_profil_eks', 'pma_users.idperusahaan=pma_profil_eks.idperusahaan');
        $this->db->where('pma_profil_eks.npwp', $npwp);
        $q = $this->db->get()->row()->email;

        return $q;
    }

    //ambil data user
    function data_user($email) {
        $this->db->select('*');
        $this->db->from('pma_users');
        $this->db->where('email', $email);
        $q = $this->db->get();

        return $q;
    }

    //cek email pendaftar
    function cekemail($email) {
        $this->db->select('*');
        $this->db->from('pma_users');
        $this->db->where('email', $email);
        $n = $this->db->get()->num_rows();
        if($n>0) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    //ambil data badan usaha
    function ambilbadanusaha($idbadanusaha) {
        $this->db->select('*');
        $this->db->from('pma_mst_badanusaha');
        if(!empty($idbadanusaha)) {
            $this->db->where('idbadanusaha', $idbadanusaha);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil data penanaman modal
    function ambilmodal() {
        $this->db->select('*');
        $this->db->from('pma_mst_modal');
        $q = $this->db->get();

        return $q;
    }

    //ambil data skala bisnis
    function ambilskalabisnis() {
        $this->db->select('*');
        $this->db->from('pma_mst_skalabisnis');
        $q = $this->db->get();

        return $q;
    }

    //ambil data jenis usaha
    function ambiljenisusaha() {
        $this->db->select('*');
        $this->db->from('pma_mst_jenisusaha');
        $q = $this->db->get();

        return $q;
    }

    //ambil data provinsi
    function ambilprovinsi() {
        $this->db->select('*');
        $this->db->from('pma_mst_provinsi');
        $q = $this->db->get();

        return $q;
    }

     //ambil data negara
     function ambilnegara() {
        $this->db->select('*');
        $this->db->from('pma_mst_negara');
        $this->db->order_by('negara', 'ASC');
        $q = $this->db->get();

        return $q;
    }

    //ambil data profil eksportir
    function ambilprofil($idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_profil');
        $this->db->join('pma_mst_badanusaha', 'pma_mst_badanusaha.idbadanusaha=pma_eks_profil.idbadanusaha');
        $this->db->where('idprofil', $idprofil);
        $q = $this->db->get();

        return $q;
    }

    //ambil data keterangan kategori primaniyarta
    function ambilketerangan($idkategori) {
        $this->db->select('keterangan, kriteria');
        $this->db->from('pma_kategori');
        $this->db->where('idkategori', $idkategori);
        $q = $this->db->get()->row();

        $text ="
        <div class='card rounded-0'>
          <div class='card-body'>
            <p class='text-start pt-2'><b>Penjelasan Kategori</b></p>
            <p class='text-start'>".$q->keterangan."</p>
            <p class='text-start pt-2'><b>Kriteria</b></p>
            <p class='text-start'>".$q->kriteria."</p>
          </div>
        </div>
        ";

        echo json_encode($text);
    }

    //ambil data kategori primaniyarta yang dipilih user
    function ambilkategoripilih($idprofil, $idpilih) {
        $this->db->select('pma_eks_kategori_pilih.idpilih, pma_eks_kategori_pilih.idprofil, pma_eks_kategori_pilih.idkategori, nmkategori, keterangan, utama');
        $this->db->from('pma_eks_kategori_pilih');
        $this->db->join('pma_kategori', 'pma_kategori.idkategori=pma_eks_kategori_pilih.idkategori');
        $this->db->where('idprofil', $idprofil);
        if(!empty($idpilih)) {
            $this->db->where('idpilih', $idpilih);
        }
        $this->db->order_by('utama', 'DESC');
        $q = $this->db->get();

        return $q;
    }
    
    //cek kategori primaniyarta yang dipilih user
    function cekkategorilain($idkategori, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_kategori_pilih');
        $this->db->where('idkategori', $idkategori);
        $this->db->where('idprofil', $idprofil);
        $q = $this->db->get();
        $nq = $q->num_rows();
        if($nq>0) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    //simpan profil eksportir
    function simpanprofil($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idbadanusaha' => $data['idbadanusaha'],
            'nmperusahaan' => $data['nmperusahaan'],
            'npwp' => $data['npwp'],
            'nib' => $data['nib'],
            'idmodal' => $data['idmodal'],
            'idskala' => $data['idskala'],
            'idjenis' => $data['idjenis'],
            'tahunberdiri' => $data['tahunberdiri'],
            'tahunekspor' => $data['tahunekspor'],
            'bank' => $data['bank'],
            'email' => $data['email'],
            'website' => $data['website'],
            'idprovinsi' => $data['idprovinsi'],
            'kota' => $data['kota'],
            'alamat' => $data['alamat'],
            'telepon' => $data['telepon'],
            'fax' => $data['fax'],
            'idprovinsipabrik' => $data['idprovinsipabrik'],
            'kotapabrik' => $data['kotapabrik'],
            'alamatpabrik' => $data['alamatpabrik'],
            'teleponpabrik' => $data['teleponpabrik'],
            'faxpabrik' => $data['faxpabrik'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idprofil'])) {
            $this->db->insert('pma_eks_profil', $data1);
            $idprofil = $this->db->insert_id();
            $encrypt_profilid = $this->secure->encrypt_url($idprofil);
            //simpan idprofil ke session
            $this->session->set_userdata('sessprofilid', $encrypt_profilid);
    
            //update idprofil di data user
            $this->db->set('idprofil', $idprofil);
            $this->db->where('iduser',  $decrypt_userid);
            $this->db->update('pma_users');

            //input kategori pilih
            $data2 = array(
                'idprofil' => $idprofil,
                'idkategori' => $data['idkategori'],
                'tahun' => date("Y"),
                'utama' => '1',
                'iduser' => $decrypt_userid,
                'tglinput' => date("Y-m-d H:i:s"),
                'tgledit' => date("Y-m-d H:i:s")
            );

            $this->db->insert('pma_eks_kategori_pilih', $data2);

             //destroy session sessceknpwp
            $this->session->unset_userdata('sessceknpwp');
        }
        else {
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_profil', $data1);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdateprofil', 'Berhasil update data profil perusahaan');

        if($this->db->affected_rows()>0) {
            //redirect ke halaman pendaftaran sukses
            redirect('main/profil');
        }
        else {
            echo "ERROR";
        }
        
    }

    //simpan pillihan kategori primaniyarta
    function simpankategorilainnya($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'idkategori' => $data['idkategori'],
            'tahun' => date("Y"),
            'utama' => '0',
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'idkategori' => $data['idkategori'],
            'tahun' => date("Y"),
            'utama' => '0',
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idpilih'])) {
            $this->db->insert('pma_eks_kategori_pilih', $data1);
        }
        else {
            $this->db->where('idpilih', $data['idpilih']);
            $this->db->update('pma_eks_kategori_pilih', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatekategori', 'Berhasil update data pilihan kategori Primaniyarta');

        redirect('main/pilihkategori');
    }

    //hapus data pilihan kategori primaniyarta lainnya
    function hapuskategorilainnya($idpilih) {
        $this->db->where('idpilih', $idpilih);
        $this->db->delete('pma_eks_kategori_pilih');
        
        redirect('main/pilihkategori');
    }

    //simpan data kontak pic
    function simpankontak($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'namakontak' => $data['nama'],
            'jabatan' => $data['jabatan'],
            'email' => $data['email'],
            'telepon' => $data['telepon'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'namakontak' => $data['nama'],
            'jabatan' => $data['jabatan'],
            'email' => $data['email'],
            'telepon' => $data['telepon'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idkontak'])) {
            $this->db->insert('pma_eks_kontak', $data1);
        }
        else {
            $this->db->where('idkontak', $data['idkontak']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_kontak', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatekontak', 'Berhasil update kontak perusahaan');

        //echo $idprofil;

        //redirect ke halaman pendaftaran sukses
        redirect('main/kontakpic');
    }

    //hapus data kontak pic
    function hapuskontakpic($idkontak) {
        $this->db->where('idkontak', $idkontak);
        $this->db->delete('pma_eks_kontak');
        
        redirect('main/kontakpic');
    }


    //simpan produk ekspor perusahaan
    function simpanproduk($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'produk' => $data['produk'],
            'hscode' => $data['hscode'],
            'idmerek' => $data['idmerek'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'produk' => $data['produk'],
            'hscode' => $data['hscode'],
            'idmerek' => $data['idmerek'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idproduk'])) {
            $this->db->insert('pma_eks_produk', $data1);
        }
        else {
            $this->db->where('idproduk', $data['idproduk']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_produk', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatekontak', 'Berhasil update kontak perusahaan');

        //echo $idprofil;

        //redirect ke halaman pendaftaran sukses
        redirect('main/produk/form');
    }

    //simpan survey produk
    function simpansurveyproduk($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array (
            'idprofil' => $data['idprofil'],
            'ekspormerekbuyer' => $data['ekspormerekbuyer'],
            'brandingsendiri' => $data['brandingsendiri'],
            'perwakilanluarnegeri' => $data['perwakilanluarnegeri'],
            'brandingdenganbuyer' => $data['brandingdenganbuyer'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'ekspormerekbuyer' => $data['ekspormerekbuyer'],
            'brandingsendiri' => $data['brandingsendiri'],
            'perwakilanluarnegeri' => $data['perwakilanluarnegeri'],
            'brandingdenganbuyer' => $data['brandingdenganbuyer'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idsurvey'])) {
            $this->db->insert('pma_survey_produk', $data1);
        }
        else {
            $this->db->where('idsurvey', $data['idsurvey']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_survey_produk', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdateproduk', 'Berhasil update survey produk perusahaan');

        //echo $idprofil;

        //redirect ke halaman pendaftaran sukses
        redirect('main/produk/survey');
    }

    //hapus data produk
    function hapusproduk($idproduk) {
        $this->db->where('idproduk', $idproduk);
        $this->db->delete('pma_eks_produk');
        
        redirect('main/produk');
    }

    //simpan data merek
    function simpanmerek($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'nmmerek' => $data['nmmerek'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'nmmerek' => $data['nmmerek'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idmerek'])) {
            $this->db->insert('pma_eks_merek', $data1);
        }
        else {
            $this->db->where('idmerek', $data['idmerek']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_merek', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatemerek', 'Berhasil update data merek');

        //echo $idprofil;

        //redirect ke halaman pendaftaran sukses
        redirect('main/merek');
    }

    //hapus data merek
    function hapusmerek($idmerek) {
        $this->db->where('idmerek', $idmerek);
        $this->db->delete('pma_eks_merek');
        
        redirect('main/merek');
    }

    //simpan data pendaftaran merek
    function simpandaftarmerek($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idmerek' => $data['idmerek'],
            'tgldaftar' => $this->ubahtanggal("/", $data['tgldaftar']),
            'idnegara' => $data['idnegara'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idmerek' => $data['idmerek'],
            'tgldaftar' => $this->ubahtanggal("/", $data['tgldaftar']),
            'idnegara' => $data['idnegara'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['iddaftar'])) {
            $this->db->insert('pma_eks_merek_daftar', $data1);
        }
        else {
            $this->db->where('iddaftar', $data['iddaftar']);
            $this->db->where('idmerek', $data['idmerek']);
            $this->db->update('pma_eks_merek_daftar', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatemerek', 'Berhasil update data pendaftaran merek');

        //echo $idprofil;

        //redirect ke halaman pendaftaran sukses
        redirect('main/merek/daftar');
    }

    //hapus data pendaftaran merek
    function hapusdaftarmerek($iddaftar) {
        $this->db->where('iddaftar', $iddaftar);
        $this->db->delete('pma_eks_merek_daftar');
        
        redirect('main/merek/daftar');
    }

    //simpan bahan baku
    function simpanbahanbaku($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'persen_lokal' => $data['persen_lokal'],
            'persen_impor' => $data['persen_impor'],
            'nilai_impor' => $data['nilai_impor'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'persen_lokal' => $data['persen_lokal'],
            'persen_impor' => $data['persen_impor'],
            'nilai_impor' => $data['nilai_impor'],
            'iduser' => $this->session->sessuserid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idbahan'])) {
            $this->db->insert('pma_eks_bahan_baku', $data1);
        }
        else {
            $this->db->where('idbahanbaku', $data['idbahan']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_bahan_baku', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatebahan', 'Berhasil update bahan baku');

        //echo $idprofil;

        //redirect ke halaman pendaftaran sukses
        redirect('main/bahanbaku/form');
    }

    //hapus data bahan baku
    function hapusbahanbaku($idbahan) {
        $this->db->where('idbahanbaku', $idbahan);
        $this->db->delete('pma_eks_bahan_baku');
        
        redirect('main/bahanbaku/form');
    }

    //simpan survey bahan baku
    function simpansurveybahanbaku($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array (
            'idprofil' => $data['idprofil'],
            'frekuensi_product_reject' => $data['frekuensi_product_reject'],
            'quality_control' => $data['quality_control'],
            'rnd' => $data['rnd'],
            'olah_limbah' => $data['olah_limbah'],
            'iso_9001' => $data['iso_9001'],
            'iso_14001' => $data['iso_14001'],
            'sertifikat_ecolabelling' => $data['sertifikat_ecolabelling'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array (
            'idprofil' => $data['idprofil'],
            'frekuensi_product_reject' => $data['frekuensi_product_reject'],
            'quality_control' => $data['quality_control'],
            'rnd' => $data['rnd'],
            'olah_limbah' => $data['olah_limbah'],
            'iso_9001' => $data['iso_9001'],
            'iso_14001' => $data['iso_14001'],
            'sertifikat_ecolabelling' => $data['sertifikat_ecolabelling'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idsurvey'])) {
            $this->db->insert('pma_survey_bahan_baku', $data1);
        }
        else {
            $this->db->where('idsurvey', $data['idsurvey']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_survey_bahan_baku', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatebahan', 'Berhasil update survey bahan baku');

        //echo $idprofil;

        //redirect ke halaman pendaftaran sukses
        redirect('main/bahanbaku/survey');
    }

    //simpan nilai penjualan
    function simpannilai($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'total_penjualan' => $data['total_penjualan'],
            'persen_ekspor' => $data['persen_ekspor'],
            'nilai_ekspor' => $data['nilai_ekspor'],
            'persen_lokal' => $data['persen_lokal'],
            'nilai_lokal' => $data['nilai_lokal'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'total_penjualan' => $data['total_penjualan'],
            'persen_ekspor' => $data['persen_ekspor'],
            'nilai_ekspor' => $data['nilai_ekspor'],
            'persen_lokal' => $data['persen_lokal'],
            'nilai_lokal' => $data['nilai_lokal'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idjual'])) {
            $this->db->insert('pma_eks_penjualan', $data1);
        }
        else {
            $this->db->where('idpenjualan', $data['idjual']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_penjualan', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatepenjualan', 'Berhasil update nilai penjualan');

        //echo $idprofil;

        //redirect ke halaman penjualan
        redirect('main/penjualan/nilai');
    }

    //hapus nilai penjualan
    function hapusnilai($idjual) {
        $this->db->where('idpenjualan', $idjual);
        $this->db->delete('pma_eks_penjualan');
        
        redirect('main/penjualan/nilai');
    }

    //simpan kegiatan ekspor
    function simpanekspor($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $dt = date("Y");
        if(empty($data['idproflink'])) {
            if($this->cekdataekspor($data['idprofil'], $data['idproduk'], $data['idnegara'])==FALSE) {
                for($i=$dt-3; $i<$dt; $i++) {
                    $data1 = array(
                        'idprofil' => $data['idprofil'],
                        'idproduk' => $data['idproduk'],
                        'idnegara' => $data['idnegara'],
                        'persen_ekspor' => $data['rasio_'.$i],
                        'tahun' => $i,
                        'iduser' => $decrypt_userid,
                        'tglinput' => date("Y-m-d H:i:s"),
                        'tgledit' => date("Y-m-d H:i:s")
                    );
    
                    $this->db->insert('pma_eks_ekspor', $data1);
                }

                //tambah session update data berhasil
                $this->session->set_userdata('sesscw', 'success');
                $this->session->set_userdata('sessupdatepenjualan', 'Berhasil input kegiatan ekspor');
            }
            else {
                $this->session->set_userdata('sesscw', 'danger');
                //tambah session update data sudah ada
                $this->session->set_userdata('sessupdatepenjualan', 'Input kegiatan ekspor gagal. Data rasio ekspor sudah diinput sebelumnya. Apabila ingin diganti, harap lakukan edit data.');
            }
        }
        else {
            $e = $this->ambileksporedit($data['idproflink'], $data['idproduk'], $data['idnegara']);
            $ne = $e->num_rows();
            if($ne>0) {
                $re = $e->result();
                for($i=0; $i<$ne; $i++) {
                    $data2 = array(
                        //'idprofil' => $data['idproflink'],
                        //'idproduk' => $data['idproduk'],
                        //'idnegara' => $data['idnegara'],
                        'persen_ekspor' => $data['rasio_'.$re[$i]->tahun],
                        'tahun' => $re[$i]->tahun,
                        'iduser' => $decrypt_userid,
                        'tgledit' => date("Y-m-d H:i:s")
                    );

                    $this->db->where('idekspor', $re[$i]->idekspor);
                    //$this->db->where('idprofil', $data['idproflink']);
                    //$this->db->where('idproduk', $data['idproduk']);
                    //$this->db->where('idnegara', $data['idnegara']);
                    $this->db->update('pma_eks_ekspor', $data2);
                }
            }

            //tambah session update data berhasil
            $this->session->set_userdata('sesscw', 'success');
            $this->session->set_userdata('sessupdatepenjualan', 'Berhasil update kegiatan ekspor');
        }
            
        //redirect ke halaman penjualan
        redirect('main/penjualan/ekspor');
    }

    //ambil idekspor
    function ambilidekspor($idprofil, $idproduk, $idnegara) {
        $this->db->select('idekspor');
        $this->db->from('pma_eks_ekspor');
        $this->db->where('idprofil', $idprofil);
        $this->db->where('idproduk', $idproduk);
        $this->db->where('idnegara', $idnegara);
        $q = $this->db->get();

        return $q;
    }

    //cek data ekspor
    function cekdataekspor($idprofil, $idproduk, $idnegara) {
        $this->db->select('*');
        $this->db->from('pma_eks_ekspor');
        $this->db->where('idprofil', $idprofil);
        $this->db->where('idproduk', $idproduk);
        $this->db->where('idnegara', $idnegara);
        $q = $this->db->get();
        $nq = $q->num_rows();
        if($nq>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //hapus kegiatan ekspor
    function hapusekspor($data) {
        $this->db->where('idprofil', $data['idprofil']);
        $this->db->where('idproduk', $data['idproduk']);
        $this->db->where('idnegara', $data['idnegara']);
        $this->db->delete('pma_eks_ekspor');
        
        redirect('main/penjualan/ekspor');
    }

    //simpan survey penjualan
    function simpansurveypenjualan($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $upameran = ""; $umisi = ""; $ukatalog = ""; $ubinaan = ""; $uagen = ""; $uonline = ""; $ulangsung = ""; $uiklan = "";
        if(!empty($data['upaya_pameran_dagang'])) { $upameran = $data['upaya_pameran_dagang']; } 
        if(!empty($data['upaya_misi_dagang'])) { $umisi = $data['upaya_misi_dagang']; }
        if(!empty($data['upaya_katalog'])) { $ukatalog = $data['upaya_katalog']; }  
        if(!empty($data['upaya_binaan_instansi'])) { $ubinaan = $data['upaya_binaan_instansi']; }
        if(!empty($data['upaya_agen'])) { $uagen = $data['upaya_agen']; }
        if(!empty($data['upaya_online'])) { $uonline = $data['upaya_online']; }  
        if(!empty($data['upaya_langsung'])) { $ulangsung = $data['upaya_langsung']; }
        if(!empty($data['upaya_iklan'])) { $uiklan = $data['upaya_iklan']; }   

        $data1 = array (
            'idprofil' => $data['idprofil'],
            'frekuensi_kirim_barang' => $data['frekuensi_kirim_barang'],
            'metode_penjualan' => $data['metode_penjualan'],
            'punya_anak_perusahaan' => $data['punya_anak_perusahaan'],
            'upaya_pameran_dagang' => $upameran,
            'upaya_misi_dagang' => $umisi,
            'upaya_katalog' => $ukatalog,
            'upaya_binaan_instansi' => $ubinaan,
            'upaya_agen' => $uagen,
            'upaya_online' => $uonline,
            'upaya_langsung' => $ulangsung,
            'upaya_iklan' => $uiklan,
            'negara_anak_perusahaan' => $data['negara_anak_perusahaan'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array (
            'idprofil' => $data['idprofil'],
            'frekuensi_kirim_barang' => $data['frekuensi_kirim_barang'],
            'metode_penjualan' => $data['metode_penjualan'],
            'punya_anak_perusahaan' => $data['punya_anak_perusahaan'],
            'upaya_pameran_dagang' => $upameran,
            'upaya_misi_dagang' => $umisi,
            'upaya_katalog' => $ukatalog,
            'upaya_binaan_instansi' => $ubinaan,
            'upaya_agen' => $uagen,
            'upaya_online' => $uonline,
            'upaya_langsung' => $ulangsung,
            'upaya_iklan' => $uiklan,
            'negara_anak_perusahaan' => $data['negara_anak_perusahaan'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        //cek apakah data sudah ada?
        $this->db->select('*');
        $this->db->from('pma_survey_penjualan');
        $this->db->where('idprofil', $data['idprofil']);
        $q = $this->db->get();
        $n = $q->num_rows();
        if($n>0) {
            //$this->db->where('idsurvey', $data['idsurvey']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_survey_penjualan', $data2);
        }
        else {
            $this->db->insert('pma_survey_penjualan', $data1);
        }

        //update data pelabuhan
        $this->db->set('idpelabuhan', $data['idpelabuhan']);
        $this->db->where('idprofil', $data['idprofil']);
        $this->db->update('pma_eks_profil');

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatepenjualan', 'Berhasil update survey penjualan');

        //echo $idprofil;

        //redirect ke halaman pendaftaran sukses
        redirect('main/penjualan/survey');
    }

    //simpan pajak
    function simpanpajak($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'status_pph_badan' => $data['statuspphbadan'],
            'status_pph_pasal_21' => $data['statuspph21'],
            'status_ppn' => $data['statusppn'],
            'nilai_pph_badan' => $data['nilaipphbadan'],
            'nilai_pph_pasal_21' => $data['nilaipph21'],
            'nilai_ppn' => $data['nilaippn'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'status_pph_badan' => $data['statuspphbadan'],
            'status_pph_pasal_21' => $data['statuspph21'],
            'status_ppn' => $data['statusppn'],
            'nilai_pph_badan' => $data['nilaipphbadan'],
            'nilai_pph_pasal_21' => $data['nilaipph21'],
            'nilai_ppn' => $data['nilaippn'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idpajak'])) {
            $this->db->insert('pma_eks_pajak', $data1);
        }
        else {
            $this->db->where('idpajak', $data['idpajak']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_pajak', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatepajak', 'Berhasil input data pajak');
        $this->session->set_userdata('sesscw', 'success');

        //redirect ke halaman pajak
        redirect('main/pajak');
    }

    //hapus data pajak
    function hapuspajak($idpajak) {
        $this->db->where('idpajak', $idpajak);
        $this->db->delete('pma_eks_pajak');
        
        redirect('main/pajak');
    }

    //simpan tenaga kerja
    function simpannaker($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'lokal' => $data['lokal'],
            'asing' => $data['asing'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'lokal' => $data['lokal'],
            'asing' => $data['asing'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idnaker'])) {
            $this->db->insert('pma_eks_tenaga_kerja', $data1);
        }
        else {
            $this->db->where('idtenagakerja', $data['idnaker']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_tenaga_kerja', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatelainlain', 'Berhasil update data tenaga kerja');
        $this->session->set_userdata('sesscw', 'success');

        //redirect ke halaman lain lain
        redirect('main/lainlain/naker');
    }

    //hapus tenaga kerja
    function hapusnaker($idnaker) {
        $this->db->where('idtenagakerja', $idnaker);
        $this->db->delete('pma_eks_tenaga_kerja');
        
        redirect('main/lainlain/naker');
    }

    //simpan sertifikasi
    function simpansertifikasi($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'nmsertifikat' => $data['nmsertifikat'],
            'dikeluarkan_oleh' => $data['dikeluarkan'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'nmsertifikat' => $data['nmsertifikat'],
            'dikeluarkan_oleh' => $data['dikeluarkan'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idsertifikat'])) {
            $this->db->insert('pma_eks_sertifikat', $data1);
        }
        else {
            $this->db->where('idsertifikat', $data['idsertifikat']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_sertifikat', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatelainlain', 'Berhasil update data sertifikasi');
        $this->session->set_userdata('sesscw', 'success');

        //redirect ke halaman lain lain
        redirect('main/lainlain/sertifikasi');
    }

    //hapus sertifikasi
    function hapussertifikasi($idsertifikat) {
        $this->db->where('idsertifikat', $idsertifikat);
        $this->db->delete('pma_eks_sertifikat');
        
        redirect('main/lainlain/sertifikasi');
    }

    //simpan penghargaan
    function simpanpenghargaan($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'nmpenghargaan' => $data['nmpenghargaan'],
            'diberikan_oleh' => $data['diberikan'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'nmpenghargaan' => $data['nmpenghargaan'],
            'diberikan_oleh' => $data['diberikan'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idpenghargaan'])) {
            $this->db->insert('pma_eks_penghargaan', $data1);
        }
        else {
            $this->db->where('idpenghargaan', $data['idpenghargaan']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_penghargaan', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatelainlain', 'Berhasil update data penghargaan');
        $this->session->set_userdata('sesscw', 'success');

        //redirect ke halaman lain lain
        redirect('main/lainlain/penghargaan');
    }

    //hapus penghargaan
    function hapuspenghargaan($idpenghargaan) {
        $this->db->where('idpenghargaan', $idpenghargaan);
        $this->db->delete('pma_eks_penghargaan');
        
        redirect('main/lainlain/penghargaan');
    }

    //simpan csr
    function simpancsr($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'kegiatan' => $data['kegiatan'],
            'stakeholder' => $data['stakeholder'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'kegiatan' => $data['kegiatan'],
            'stakeholder' => $data['stakeholder'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idcsr'])) {
            $this->db->insert('pma_eks_csr', $data1);
        }
        else {
            $this->db->where('idcsr', $data['idcsr']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_csr', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatelainlain', 'Berhasil update data csr');
        $this->session->set_userdata('sesscw', 'success');

        //redirect ke halaman lain lain
        redirect('main/lainlain/csr');
    }

    //hapus csr
    function hapuscsr($idcsr) {
        $this->db->where('idcsr', $idcsr);
        $this->db->delete('pma_eks_csr');
        
        redirect('main/lainlain/csr');
    }

    //simpan lh
    function simpanlh($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'kegiatan' => $data['kegiatan'],
            'stakeholder' => $data['stakeholder'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'idprofil' => $data['idprofil'],
            'tahun' => $data['tahun'],
            'kegiatan' => $data['kegiatan'],
            'stakeholder' => $data['stakeholder'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idlhr'])) {
            $this->db->insert('pma_eks_lh', $data1);
        }
        else {
            $this->db->where('idlh', $data['idlh']);
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_eks_lh', $data2);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatelainlain', 'Berhasil update data pelestarian dan penyelamatan lingkungan hidup');
        $this->session->set_userdata('sesscw', 'success');

        //redirect ke halaman lain lain
        redirect('main/lainlain/lh');
    }

    //hapus lh
    function hapuslh($idlh) {
        $this->db->where('idlh', $idlh);
        $this->db->delete('pma_eks_lh');
        
        redirect('main/lainlain/lh');
    }
    
    //simpan dokumen pendukung
    function simpandokumen($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        if(!empty($data['file'])) {
            $filename = $data['idprofil']."-".str_replace(" ", "_", $data['file']);
        }
        else {
            $filename = "";
        }
    
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'nmfile' => $data['nmfile'],
            'file' => $filename,
            'linkdownload' => $data['linkdownload'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );
        
        if(empty($data['file'])) {
            $data2 = array(
                'idprofil' => $data['idprofil'],
                'nmfile' => $data['nmfile'],
                'linkdownload' => $data['linkdownload'],
                'iduser' => $decrypt_userid,
                'tgledit' => date("Y-m-d H:i:s")
            );
        }
        else {
            $data2 = array(
                'idprofil' => $data['idprofil'],
                'nmfile' => $data['nmfile'],
                'file' => $filename,
                'linkdownload' => $data['linkdownload'],
                'iduser' => $this->secure->decrypt_url($this->session->sessid),
                'tgledit' => date("Y-m-d H:i:s")
            );
        }
        
            
        if(!empty($data['iddok'])) {
            $this->db->where('iddokumen', $data['iddok']);
            $this->db->update('pma_eks_dokumen', $data2);
        }
        else {
            $this->db->insert('pma_eks_dokumen', $data1);
        }
        
        if($this->db->affected_rows()>0) {
            $this->session->set_userdata('sessudatedok', 'Berhasil update data dokumen pendukung');
        }
        else {
            $this->session->set_userdata('sessupdatedok', 'Gagal update data dokumen pendukung');
        }
        
        redirect('main/dokumen');
    }
    
    //hapus dokumen pendukung buyer
    function hapusdokbuyer($idprofil, $iddok) {
        $nmfile = $this->ambildokumen($idprofil, $iddok)->row()->nmfile;
        if(!empty($nmfile)) {
            unlink('../assets/uploads/dokumen/'.$nmfile);
        }
        
        $this->db->where('iddokumen', $iddok);
        $this->db->delete('pma_eks_dokumen');
        
        redirect('main/dokumen');
    }

    //cek jumlah kategori yang dipilih
    function cekkategoripilih($idprofil) {
        $this->db->select('pma_eks_kategori_pilih.idkategori, nmkategori');
        $this->db->from('pma_eks_kategori_pilih');
        $this->db->join('pma_kategori', 'pma_kategori.idkategori=pma_eks_kategori_pilih.idkategori');
        $this->db->where('idprofil', $idprofil);
        $q = $this->db->get();

        return $q;
    }

    //ambil data pajak
    function ambilpajak($idpajak, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_pajak');
        if(!empty($idpajak)) {
            $this->db->where('idpajak', $idpajak);
        }
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        $this->db->order_by('tahun', 'DESC');
        $q = $this->db->get();

        return $q;
    }

    //konversi status pajak
    function konversistatuspajak($status) {
        if($status=="1") { return "<i class='fa-solid fa-check'></i>"; }
        if($status=="2") { return "<i class='fa-solid fa-circle-xmark'></i>"; }
        if($status=="3") { return "<i class='fa-solid fa-arrow-up-right-from-square'></i>"; }
    }

    //simpan kisah keberhasilan
    function simpankisah($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $count = count($data['idkategori']);
        //echo $count;
        //echo "<br>id kategori: ".$data['idkategori'][1];
        //exit;
        for($i=0; $i<$count; $i++) {
            $data1 = array(
                'idprofil' => $data['idprofil'],
                'idkategori' => $data['idkategori'][$i],
                'kisah' => $data['kisah'][$i],
                'iduser' => $decrypt_userid,
                'tglinput' => date("Y-m-d H:i:s"),
                'tgledit' => date("Y-m-d H:i:s")
            );

            $data2 = array(
                'idprofil' => $data['idprofil'],
                'idkategori' => $data['idkategori'][$i],
                'kisah' => $data['kisah'][$i],
                'iduser' => $decrypt_userid,
                'tgledit' => date("Y-m-d H:i:s")
            );

            if(empty($data['idkisah'][$i])) {
                $this->db->insert('pma_eks_kisah', $data1);
            }
            else {
                $this->db->where('idkisah', $data['idkisah'][$i]);
                $this->db->where('idprofil', $data['idprofil']);
                $this->db->update('pma_eks_kisah', $data2);
            }
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatekisah', 'Berhasil input data kisah keberhasilan');
        $this->session->set_userdata('sesscw', 'success');

        //redirect ke halaman pajak
        redirect('main/kisah');
    }

    //ambil data kisah keberhasilan
    function ambilkisah($idkategori, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_kisah');
        if(!empty($idkategori)) {
            $this->db->where('idkategori', $idkategori);
        }
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        $this->db->order_by('idkategori', 'ASC');
        $q = $this->db->get();

        return $q;
    }

    //ambil data kontak perusahaan
    function ambilkontak($idkontak, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_kontak');
        if(!empty($idkontak)) {
            $this->db->where('idkontak', $idkontak);
        }
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil data produk ekspor perusahaan
    function ambilproduk($idproduk, $idprofil) {
        $this->db->select('pma_eks_produk.idproduk, pma_eks_produk.idprofil, pma_eks_produk.produk, pma_eks_produk.hscode, pma_eks_produk.idmerek, pma_eks_merek.nmmerek');
        $this->db->from('pma_eks_produk');
        $this->db->join('pma_eks_merek', 'pma_eks_merek.idmerek=pma_eks_produk.idmerek', 'LEFT');
        if(!empty($idproduk)) {
            $this->db->where('pma_eks_produk.idproduk', $idproduk);
        }
        if(!empty($idprofil)) {
            $this->db->where('pma_eks_produk.idprofil', $idprofil);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil data merek
    function ambilmerek($idmerek, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_merek');
        if(!empty($idmerek)) {
            $this->db->where('idmerek', $idmerek);
        }
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil data daftar merek
    function ambilmerekdaftar($iddaftar, $idprofil) {
        $this->db->select('pma_eks_merek_daftar.iddaftar, pma_eks_merek_daftar.idmerek, pma_eks_merek.nmmerek, pma_eks_merek_daftar.tgldaftar, pma_eks_merek_daftar.idnegara, pma_mst_negara.negara');
        $this->db->from('pma_eks_merek_daftar');
        $this->db->join('pma_mst_negara', 'pma_mst_negara.idnegara=pma_eks_merek_daftar.idnegara');
        $this->db->join('pma_eks_merek', 'pma_eks_merek.idmerek=pma_eks_merek_daftar.idmerek');
        if(!empty($iddaftar)) {
            $this->db->where('iddaftar', $iddaftar);
        }
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil data bahan baku
    function ambilbahanbaku($idbahan, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_bahan_baku');
        if(!empty($idbahan)) {
            $this->db->where('idbahanbaku', $idbahan);
        }
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil data penjualan
    function ambilpenjualan($idjual, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_penjualan');
        if(!empty($idjual)) {
            $this->db->where('idpenjualan', $idjual);
        }
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil data ekspor
    function ambilekspor($idproduk, $idprofil, $idnegara) {
        $this->db->select('pma_eks_ekspor.idekspor, pma_eks_ekspor.idprofil, pma_eks_ekspor.idproduk, produk, hscode, pma_eks_ekspor.idnegara, negara, pma_eks_ekspor.tahun');
        $this->db->from('pma_eks_ekspor');
        $this->db->join('pma_eks_produk', 'pma_eks_produk.idproduk=pma_eks_ekspor.idproduk');
        $this->db->join('pma_mst_negara', 'pma_mst_negara.idnegara=pma_eks_ekspor.idnegara');
        if(!empty($idproduk)) {
            $this->db->where('pma_eks_ekspor.idproduk', $idproduk);
        }
        if(!empty($idprofil)) {
            $this->db->where('pma_eks_ekspor.idprofil', $idprofil);
        }
        if(!empty($idnegara)) {
            $this->db->where('pma_eks_ekspor.idnegara', $idnegara);
        }
        $this->db->group_by("pma_eks_ekspor.idproduk, pma_eks_ekspor.idnegara");
        $q = $this->db->get();

        return $q;
    }

    //ambil data ekspor edit
    function ambileksporedit($idprofil, $idproduk, $idnegara) {
        $this->db->select('pma_eks_ekspor.idekspor, pma_eks_ekspor.idprofil, pma_eks_ekspor.idproduk, produk, hscode, pma_eks_ekspor.idnegara, negara, pma_eks_ekspor.tahun');
        $this->db->from('pma_eks_ekspor');
        $this->db->join('pma_eks_produk', 'pma_eks_produk.idproduk=pma_eks_ekspor.idproduk');
        $this->db->join('pma_mst_negara', 'pma_mst_negara.idnegara=pma_eks_ekspor.idnegara');
        if(!empty($idprofil)) {
            $this->db->where('pma_eks_ekspor.idprofil', $idprofil);
        }
        if(!empty($idproduk)) {
            $this->db->where('pma_eks_ekspor.idproduk', $idproduk);
        }
        if(!empty($idnegara)) {
            $this->db->where('pma_eks_ekspor.idnegara', $idnegara);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil tenaga kerja
    function ambilnaker($idnaker, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_tenaga_kerja');
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        if(!empty($idnaker)) {
            $this->db->where('idtenagakerja', $idnaker);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil sertifikat
    function ambilsertifikat($idsertifikat, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_sertifikat');
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        if(!empty($idsertifikat)) {
            $this->db->where('idsertifikat', $idsertifikat);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil penghargaan
    function ambilpenghargaan($idpenghargaan, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_penghargaan');
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        if(!empty($idpenghargaan)) {
            $this->db->where('idpenghargaan', $idpenghargaan);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil csr
    function ambilcsr($idcsr, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_csr');
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        if(!empty($idcsr)) {
            $this->db->where('idcsr', $idcsr);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil lh
    function ambillh($idlh, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_eks_lh');
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        if(!empty($idlh)) {
            $this->db->where('idlh', $idlh);
        }
        $q = $this->db->get();

        return $q;
    }

    //ambil persen ekspor
    function ambilpersenekspor($idprofil, $idproduk, $idnegara, $tahun) {
        $this->db->select('persen_ekspor');
        $this->db->from('pma_eks_ekspor');
        $this->db->where('idprofil', $idprofil);
        $this->db->where('idproduk', $idproduk);
        $this->db->where('idnegara', $idnegara);
        $this->db->where('tahun', $tahun);
        $q = $this->db->get();

        return $q;
    }

    //ambil data pelabuhan
    function ambilpelabuhan() {
        $this->db->select('*');
        $this->db->from('pma_mst_pelabuhan');
        $q = $this->db->get();

        return $q;
    }

    //ambil data survey produk perusahaan
    function ambilsurveyproduk($idprofil) {
        $this->db->select('*');
        $this->db->from('pma_survey_produk');
        $this->db->where('idprofil', $idprofil);
        $this->db->order_by('idsurvey', 'DESC');
        $q = $this->db->get();

        return $q;
    }

    //ambil data survey bahanbaku
    function ambilsurveybahanbaku($idprofil) {
        $this->db->select('*');
        $this->db->from('pma_survey_bahan_baku');
        $this->db->where('idprofil', $idprofil);
        $this->db->order_by('idsurvey', 'DESC');
        $q = $this->db->get();

        return $q;
    }

    //ambil data survey bahanbaku
    function ambilsurveypenjualan($idprofil) {
        $this->db->select('*');
        $this->db->from('pma_survey_penjualan');
        $this->db->where('idprofil', $idprofil);
        $this->db->order_by('idsurvey', 'DESC');
        $q = $this->db->get();

        return $q;
    }

    //ambil data pelabuhan eksportir
    function ambilpelabuhaneks($idprofil) {
        $this->db->select('idpelabuhan');
        $this->db->from('pma_eks_profil');
        $this->db->where('idprofil', $idprofil);
        $q = $this->db->get()->row()->idpelabuhan;

        return $q;
    }

    //cek tahun bahan baku
    function cektahunbahanbaku($idprofil, $tahun) {
        $this->db->select('tahun');
        $this->db->from('pma_eks_bahan_baku');
        $this->db->where('idprofil', $idprofil);
        $this->db->where('tahun', $tahun);
        $q = $this->db->get();
        $nq = $q->num_rows();
        if($nq>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //cek tahun penjualan
    function cektahunpenjualan($idprofil, $tahun) {
        $this->db->select('tahun');
        $this->db->from('pma_eks_penjualan');
        $this->db->where('idprofil', $idprofil);
        $this->db->where('tahun', $tahun);
        $q = $this->db->get();
        $nq = $q->num_rows();
        if($nq>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //cek tahun penjualan
    function cektahunpajak($idprofil, $tahun) {
        $this->db->select('tahun');
        $this->db->from('pma_eks_pajak');
        $this->db->where('idprofil', $idprofil);
        $this->db->where('tahun', $tahun);
        $q = $this->db->get();
        $nq = $q->num_rows();
        if($nq>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //cek tahun tenaga kerja
    function cektahunnaker($idprofil, $tahun) {
        $this->db->select('tahun');
        $this->db->from('pma_eks_tenaga_kerja');
        $this->db->where('idprofil', $idprofil);
        $this->db->where('tahun', $tahun);
        $q = $this->db->get();
        $nq = $q->num_rows();
        if($nq>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    //ambil data dokumen pendukung
    function ambildokumen($idprofil, $iddok) {
        $this->db->select('*');
        $this->db->from('pma_eks_dokumen');
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        if(!empty($iddok)) {
            $this->db->where('iddokumen', $iddok);
        }
        $q = $this->db->get();
        
        return $q;
    }

    //ambil penjelasan skala bisnis
    function skalabisnisdesc($idskala) {
        $desc = "";
        if($idskala=="1") {
            $desc = "<p class='pt-2 text-muted'>Modal s.d Rp1 Milyar</p>";
        }
        if($idskala=="2") {
            $desc = "<p class='pt-2 text-muted'>Modal >= Rp1 Milyar s.d Rp5 Milyar</p>";
        }
        if($idskala=="3") {
            $desc = "<p class='pt-2 text-muted'>Modal >= Rp5 Milyar s.d Rp10 Milyar</p>";
        }
        if($idskala=="4") {
            $desc = "<p class='pt-2 text-muted'>Modal > Rp10 Milyar</p>";
        }

        echo json_encode($desc);
    }

    //ambil data kepala daerah
    function ambilkepaladaerah($idprofil) {
        $this->db->select('*');
        $this->db->from('pma_gub_profil');
        $this->db->join('pma_mst_provinsi', 'pma_mst_provinsi.idprovinsi=pma_gub_profil.idprovinsi');
        $this->db->where('pma_gub_profil.idprofil', $idprofil);
        $q = $this->db->get();

        return $q;
    }

    //ambil info user
    function ambil_user($email) {
        $decrypt_email = $this->secure->decrypt_url($email);
        $this->db->select('*');
        $this->db->from('pma_users');
        $this->db->where('email', $decrypt_email);
        $q = $this->db->get();

        return $q;
    }

    //update log login
    function update_log($email) {
        $this->db->set('lastlogin', date("Y-m-d H:i:s"));
        $this->db->where('email', $email);
        $this->db->update('pma_users'); 
    }

    //cek isian form
    function cekform($form, $idprofil) {
        if($form=="kategori") {
            $this->db->select('*');
            $this->db->from('pma_eks_kategori_pilih');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="profil") {
            $this->db->select('*');
            $this->db->from('pma_eks_profil');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="kontak") {
            $this->db->select('*');
            $this->db->from('pma_eks_kontak');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="produk") {
            $this->db->select('*');
            $this->db->from('pma_eks_produk');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="survey_produk") {
            $this->db->select('*');
            $this->db->from('pma_survey_produk');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="bahanbaku") {
            $this->db->select('*');
            $this->db->from('pma_eks_bahan_baku');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="survey_bahanbaku") {
            $this->db->select('*');
            $this->db->from('pma_survey_bahan_baku');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="penjualan") {
            $this->db->select('*');
            $this->db->from('pma_eks_penjualan');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="ekspor") {
            $this->db->select('*');
            $this->db->from('pma_eks_ekspor');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="survey_jual") {
            $this->db->select('*');
            $this->db->from('pma_survey_penjualan');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="pajak") {
            $this->db->select('*');
            $this->db->from('pma_eks_pajak');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="kisah") {
            $this->db->select('*');
            $this->db->from('pma_eks_kisah');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="lainlain") {
            $l = 0;
            //tenaga kerja
            $this->db->select('*');
            $this->db->from('pma_eks_tenaga_kerja');
            $this->db->where('idprofil', $idprofil);
            $q1 = $this->db->get();
            $nq1 = $q1->num_rows();
            if($nq1>0) { $l = $l+1; }
            else { $l; }
            
            //sertifikasi
            $this->db->select('*');
            $this->db->from('pma_eks_sertifikat');
            $this->db->where('idprofil', $idprofil);
            $q2 = $this->db->get();
            $nq2 = $q2->num_rows();
            if($nq2>0) { $l = $l+1; }
            else { $l; }
            
            //penghargaan
            $this->db->select('*');
            $this->db->from('pma_eks_penghargaan');
            $this->db->where('idprofil', $idprofil);
            $q3 = $this->db->get();
            $nq3 = $q3->num_rows();
            if($nq3>0) { $l = $l+1; }
            else { $l; }
            
            //csr
            $this->db->select('*');
            $this->db->from('pma_eks_csr');
            $this->db->where('idprofil', $idprofil);
            $q4 = $this->db->get();
            $nq4 = $q4->num_rows();
            if($nq4>0) { $l = $l+1; }
            else { $l; }
            
            //lh
            $this->db->select('*');
            $this->db->from('pma_eks_lh');
            $this->db->where('idprofil', $idprofil);
            $q5 = $this->db->get();
            $nq5 = $q5->num_rows();
            if($nq5>0) { $l = $l+1; }
            else { $l; }
            
            //cek jumlah $l
            if($l>0) { return TRUE; }
            else { return FALSE; }
        }
        if($form=="dokumen") {
            $this->db->select('*');
            $this->db->from('pma_eks_dokumen');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="profilgub") {
            $this->db->select('*');
            $this->db->from('pma_gub_profil');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="kebijakangub") {
            $this->db->select('*');
            $this->db->from('pma_gub_kebijakan');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        if($form=="kisahgub") {
            $this->db->select('*');
            $this->db->from('pma_gub_kisah');
            $this->db->where('idprofil', $idprofil);
            $q = $this->db->get();
            $nq = $q->num_rows();
            if($nq>0) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
    }

    //icon progress
    function iconprogress($table, $idprofil) {
        if($this->cekform($table, $idprofil)==TRUE) {
            echo "<i class='fa-solid fa-circle-check'></i>";
        }
        else {
            echo  "<i class='fa-solid fa-circle-xmark'></i>";
        }
    }

    //text color progress
    function textcolorprogress($table, $idprofil) {
        if($this->cekform($table, $idprofil)==TRUE) {
            return "text-success";
        }
        else {
            return "text-danger";
        }
    }

    //persen progress
    function persenprogress($idprofil) {
        $p = 0;
        if($this->cekform("kategori", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("profil", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("kontak", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("produk", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("bahanbaku", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("penjualan", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("pajak", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("kisah", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("lainlain", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("dokumen", $idprofil)==TRUE) { $p=$p+1; }

        $persen = ($p/10)*100;

        return $persen;
    }

    //persen progress kepala daerah
    function persenprogressgub($idprofil) {
        $p = 0;
        if($this->cekform("profilgub", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("kebijakangub", $idprofil)==TRUE) { $p=$p+1; }
        if($this->cekform("kisahgub", $idprofil)==TRUE) { $p=$p+1; }

        $persen = ($p/3)*100;

        return $persen;
    }

    //simpan profil eksportir
    function simpanprofilgub($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idtingkat' => $data['idtingkat'],
            'idprovinsi' => $data['idprovinsi'],
            'kota' => $data['kota'],
            'nmpejabat' => $data['nmpejabat'],
            'masajabatan1' => $data['masajabatan1'],
            'masajabatan2' => $data['masajabatan2'],
            'nmpic' => $data['nmpic'],
            'nohppic' => $data['nohppic'],
            'emailpic' => $data['emailpic'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idprofil'])) {
            $this->db->insert('pma_gub_profil', $data1);
            $idprofil = $this->db->insert_id();
            $encrypt_profilid = $this->secure->encrypt_url($idprofil);
            //simpan idprofil ke session
            $this->session->set_userdata('sessprofilid', $encrypt_profilid);
    
            //update idprofil di data user
            $this->db->set('idprofil', $idprofil);
            $this->db->set('gub', '1');
            $this->db->where('email',  $data['emailuser']);
            $this->db->update('pma_users');

             //destroy session sessceknpwp
            $this->session->unset_userdata('sessceknpwp');
        }
        else {
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_gub_profil', $data1);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdateprofil', 'Berhasil update data profil kepala daerah');

        if($this->db->affected_rows()>0) {
            //redirect ke halaman pendaftaran sukses
            redirect('main/kepaladaerah');
        }
        else {
            echo "ERROR";
        }
        
    }

    //simpan kebijakan kepala daerah
    function simpankebijakangub($data) {
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'tglkebijakan' => $this->ubahtanggal("/", $data['tglkebijakan']),
            'nokebijakan' => $data['nokebijakan'],
            'nmkebijakan' => $data['nmkebijakan'],
            'file' => $data['filename'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idkebijakan'])) {
            $this->db->insert('pma_gub_kebijakan', $data1);
        }
        else {
            $this->db->where('idkebijakan', $data['idkebijakan']);
            $this->db->update('pma_gub_kebijakan', $data1);
        }

        //tambah session update data berhasil
        $this->session->set_userdata('sessupdatekebijakan', 'Berhasil update data kebijakan eksor kepala daerah');

        if($this->db->affected_rows()>0) {
            //redirect ke halaman pendaftaran sukses
            redirect('main/kebijakan');
        }
        else {
            echo "ERROR";
        }
    }

    //hapus data kebijakan kepala daerah
    function kepaladaerahkebijakanhapus($idkebijakan) {
        $this->db->where('idkebijakan', $idkebijakan);
        $this->db->delete('pma_gub_kebijakan');

        $r = $this->db->affected_rows();
        if($r>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //simpan kisah kepala daerah
    function simpankisahgub($data) {
        //echo $data['idprofil']." ".$data['kisah'];
        //exit;
        $decrypt_userid = $this->secure->decrypt_url($this->session->sessuserid);
        $data1 = array(
            'idprofil' => $data['idprofil'],
            'kisah' => $data['kisah'],
            'iduser' => $decrypt_userid,
            'tglinput' => date("Y-m-d H:i:s"),
            'tgledit' => date("Y-m-d H:i:s")
        );

        $data2 = array(
            'kisah' => $data['kisah'],
            'iduser' => $decrypt_userid,
            'tgledit' => date("Y-m-d H:i:s")
        );

        if(empty($data['idkisah'])) {
            $this->db->insert('pma_gub_kisah', $data1);
        }
        else {
            $this->db->where('idprofil', $data['idprofil']);
            $this->db->update('pma_gub_kisah', $data2);
        }

         //tambah session update data berhasil
         //$this->session->set_userdata('sessupdatekisah', 'Berhasil update data kisah keberhasilan kepala daerah');

        //if($this->db->affected_rows()>0) {
            //redirect ke halaman pendaftaran sukses
             redirect('main/kisahkepaladaerah');
        //}
        //else {
        //    echo "ERROR";
        //}
    }

    //ambil data kebijakan kepala daerah
    function ambilkebijakangub($idkebijakan, $idprofil) {
        $this->db->select('*');
        $this->db->from('pma_gub_kebijakan');
        if(!empty($idkebijakan)) {
            $this->db->where('idkebijakan', $idkebijakan);
        }
        if(!empty($idprofil)) {
            $this->db->where('idprofil', $idprofil);
        }
        
        $q = $this->db->get();

        return $q;
    }

    //ambil kisah kepala daerah
    function ambilkisahgub($idprofil) {
        $this->db->select('*');
        $this->db->from('pma_gub_kisah');
        $this->db->where('idprofil', $idprofil);
        $q = $this->db->get();

        return $q;
    }

    //text color persen progress
    function textpersenprogress($idprofil) {
        if($this->persenprogress($idprofil)<50) { echo "danger"; }
        if($this->persenprogress($idprofil)>=50 && $this->persenprogress($idprofil)<80) { echo "warning"; }
        if($this->persenprogress($idprofil)>=80 && $this->persenprogress($idprofil)<100) { echo "info"; }
        if($this->persenprogress($idprofil)==100) { echo "success"; }
    }

    //text color persen progress kepala daerah
    function textpersenprogressgub($idprofil) {
        if($this->persenprogressgub($idprofil)<50) { echo "danger"; }
        if($this->persenprogressgub($idprofil)>=50 && $this->persenprogress($idprofil)<80) { echo "warning"; }
        if($this->persenprogressgub($idprofil)>=80 && $this->persenprogress($idprofil)<100) { echo "info"; }
        if($this->persenprogressgub($idprofil)==100) { echo "success"; }
    }

    //fungsi kirim email
    function kirim_email($subject, $body, $to, $cc=null, $bcc=null) {
	    require 'assets/email/class.phpmailer.php';
	    $mail = new PHPMailer;
	    $mail->SingleTo   = true;
	    $mail->IsSMTP();
	    $mail->Host = '10.30.30.248';
	    $mail->From = 'ricky.rinaldi@kemendag.go.id';
	    //$mail->Username = 'csc@kemendag.go.id';
	    //$mail->Password = '123456';
	    //$mail->SMTPSecure = 'tls';

	    $mail->SMTPDebug = 0;
	    //$mail->Host      = 'akmalsqual.com';
	    //$mail->SMTPAuth  = true;
	    //$mail->Username  = 'noreply@akmalsqual.com';
	    //$mail->Password  = '123456';

	    //$mail->Port      = 587;    
	    //$mail->From      = 'noreply@akmalsqual.com';
	    $mail->FromName  = 'Primaniyarta 2022';
	    if(is_array($to)){
	        foreach ($to as $to_value) {
	            $mail->AddAddress($to_value['emailAddress'], $to_value['name']);
	        }
	    }
	    
	    if(is_array($cc)){
	        foreach ($cc as $cc_value) {
	            $mail->AddCC($cc_value['emailAddress'], $cc_value['name']);
	        }
	    }
	    
	    if(is_array($bcc)){
	        foreach ($bcc as $bcc_value) {
	            $mail->AddBCC($bcc_value['emailAddress'], $bcc_value['name']);
	        }
	    }
	    
	    //$mail->AddCC('cc@example.com');
	    //$mail->AddBCC('bcc@example.com');
	    $mail->IsHTML(true);
	    $mail->Subject = $subject;
	    $mail->Body = $body;
	    $mail->Send();
	    $mail->clearAllRecipients();
	    $mail->clearAttachments();
	}

    //fungsi kirim email
    function kirimemail($from, $nmfrom, $to, $subject, $body) {
        // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'djpen.prima@gmail.com',  // Email gmail
            'smtp_pass'   => 'psiep2ie',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from($from, $nmfrom);

        // Email penerima
        $this->email->to($to); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
       // $this->email->attach('https://images.pexels.com/photos/169573/pexels-photo-169573.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');

        // Subject email
        $this->email->subject($subject);

        // Isi email
        $this->email->message($body);

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function aktivasi_akun($iduser) {
        $this->db->set('status', '1');
        $this->db->where('iduser', $iduser);
        $this->db->update('pma_users');

        if($this->db->affected_rows()>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //cek pendaftaran kategori
    function cekkategoriuser($iduser) {
        $this->db->select('*');
        $this->db->from('pma_eks_kategori_pilih');
        $this->db->where('iduser', $iduser);
        $q = $this->db->get();
        $nq = $q->num_rows();
        if($nq>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //cek kategori kepala daerah
    function cekkepaladaerah($iduser) {
        $this->db->select('*');
        $this->db->from('pma_gub_profil');
        $this->db->join('pma_users', 'pma_users.iduser=pma_gub_profil.iduser');
        $this->db->where('pma_gub_profil.iduser', $iduser);
        $this->db->where('pma_users.gub', '1');
        $q = $this->db->get();
        $nq = $q->num_rows();
        if($nq>0) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //ubah format tanggal
    function ubahtanggal($format, $tanggal) {
        if($format=="-") {
            $x = explode("-", $tanggal);
            $nx = $x[2]."/".$x[1]."/".$x[0];
        }
        if($format=="/") {
            $x = explode("/", $tanggal);
            $nx = $x[2]."-".$x[1]."-".$x[0];
        }

        return $nx;
    }

}