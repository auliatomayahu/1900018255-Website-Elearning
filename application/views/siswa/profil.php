<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Profil
            <small>Atur profil anda disini</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/siswa/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Profil</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <form class="form-horizontal" action="<?= base_url('index.php/siswa/profil/update/').$this->session->userdata('id') ?>" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">NIS</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?= $this->session->userdata('username'); ?>" placeholder="Username" required disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Lengkap</label>

                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?= $this->session->userdata('nama'); ?>" placeholder="Nama Lengkap" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis Kelamin</label>

                  <div class="col-sm-10">
                    <select name="jenisKelamin" class="form-control" required>
                        <?php if($this->session->userdata('jenisKelamin') == 'Laki-Laki') { ?>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        <?php } else { ?>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tempat Lahir</label>

                  <div class="col-sm-10">
                    <input type="text" name="tptLahir" class="form-control" value="<?= $this->session->userdata('tptLahir'); ?>" placeholder="Tempat Lahir" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Lahir</label>

                  <div class="col-sm-10">
                    <input type="date" name="tglLahir" class="form-control" value="<?= $this->session->userdata('tglLahir'); ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">No. Telephone</label>

                  <div class="col-sm-10">
                    <input type="number" name="telp" class="form-control" value="<?= $this->session->userdata('telp'); ?>" placeholder="No. Telephone" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat</label>

                  <div class="col-sm-10">
                    <input type="text" name="alamat" class="form-control" value="<?= $this->session->userdata('alamat'); ?>" placeholder="Alamat" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">New Password <font color="red">*)</font></label>

                  <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" placeholder="New Password">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Skin</label>

                  <div class="col-sm-10">
                    <select name="skin" class="form-control" required>
                        <option value="<?= $this->session->userdata('skin') ?>" selected><?= $this->session->userdata('skin') ?></option>
                        <option value="" disabled> -- Pilih Skin Lain -- </option>
                        <option value="yellow">yellow</option>
                        <option value="red">red</option>
                        <option value="green">green</option>
                        <option value="purple">purple</option>
                        <option value="blue">blue</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Kelas</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php
                        $this->db->where('id', $this->session->userdata('idKelas'));
                        $kelas = $this->db->get('tb_kelas');
                        foreach ($kelas->result() as $kls) {
                            echo $kls->kelas;
                        }
                    ?>" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Level</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?= $this->session->userdata('level') ?>" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Terdaftar</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?= date('d M Y H:i:s', strtotime($this->session->userdata('terdaftar'))) ?>" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto Profil <font color="red">*)</font></label>

                  <div class="col-sm-10">
                    <input type="file" class="form-control-file" name="foto"> <br>
                  </div>
                </div>
              </div>
              <div class="box-footer">
              <small><b><i><font color="red">*) Kosongkan jika tidak ingin diubah <br> NB : Logo yang bisa diupload yaitu berformat PNG, JPG dan JPEG ukuran maximal 5MB</font></i></b></small>
                <div class="pull-right">
                    <button type="reset" class="btn btn-danger">
                        <div class="fa fa-trash"></div> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <div class="fa fa-save"></div> Update
                    </button>
                </div>
              </div>
            </form>
        </div>
    </section>
</div>