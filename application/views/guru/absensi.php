<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Absensi
            <!-- <small>Dashboard</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/guru/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Absensi</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <form action="<?= base_url('index.php/guru/absensi/absensiswa') ?>" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">Pilih Kelas</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="idKelas" required>
                                    <option value="" disabled selected>-- Pilih Kelas --</option>
                                    <?php foreach ($mapel->result_array() as $row) { ?>
                                        <option value="<?= $row['idKelas'] ?>">
                                            <?php
                                                $this->db->where('id', $row['idKelas']);
                                                foreach ($this->db->get('tb_kelas')->result() as $dKls) {
                                                    echo $dKls->kelas;
                                                }
                                            ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <button type="submit" class="btn btn-success" style="margin-top: 10px;">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>