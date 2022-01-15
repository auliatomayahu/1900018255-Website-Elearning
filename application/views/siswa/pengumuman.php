<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Data Pengumuman
            <small>Semua data pengumuman</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pengumuman</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th width="15px">#</th>
                                <th>Keterangan</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($pengumuman->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td><?= date('d F Y H:i', strtotime($row['waktu'])) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>