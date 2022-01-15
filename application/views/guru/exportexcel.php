<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Rekap Penilaian.xls");
?>

<table>
    <tr>
        <td colspan="6"><b><center>REKAP PENILAIAN</center></b></td>
    </tr>
    <tr>
        <td colspan="6">Tanggal Rekap : <?= date('d F Y H:i:s') ?></td>
    </tr>
    <tr>
        <td>#</td>
        <td>Siswa</td>
        <td>File</td>
        <td>Tanggal</td>
        <td>Nilai</td>
        <td>Keterangan</td>
    </tr>
    <?php
        $no = 1;
        foreach ($siswa->result_array() as $row) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>
                <?php
                    $this->db->where('id', $row['idSiswa']);
                    foreach ($this->db->get('tb_user')->result() as $dSwa) {
                        echo $dSwa->username.' - '.$dSwa->nama;
                    }
                ?>
            </td>
            <td><?= $row['file'] ?></td>
            <td><?= date('d F Y H:i:s', strtotime($row['tanggal'])) ?></td>
            <td><?= $row['nilai'] ?></td>
            <td><?= $row['keterangan'] ?></td>
        </tr>
    <?php } ?>
</table>