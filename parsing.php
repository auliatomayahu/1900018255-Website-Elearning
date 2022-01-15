<!DOCTYPE html>
<html>
<head>
<title>Data</title>

<!--Bagian CSS untuk Styling Table-->
<style type="text/css">
          table, th, td
          {
               border: 1px solid black;
          }
</style>
</head>
<body>
 
<h2>Data E-learning</h2>
<?php
// untuk meload data xml (mapel.xml) dengan cara SimpleXML 
$data = new SimpleXMLElement('http://localhost/elearning/data.xml', null, true);
 
// menampilkan data ke XML ke dalam tabel HTML
echo "
<table>
<tr>
     <th>Kode Mata Pelajaran</th>
     <th>Nama Mata Pelajaran</th>
     <th>ID Guru</th>
     <th>Nama Guru</th>
     <th>ID Kelas</th>
     <th>Kelas</th>
     <th>Status</th>
     <th>Hari</th>
     <th>Jam Mulai</th>
     <th>Jam Selesai</th>
</tr>
";
 
// melakukan looping penampilan data mapel
foreach($data as $id)
{
        echo "
<tr>
<td width='200'>{$id->kode}</td>
<td width='200'>{$id->mapel}</td>
<td width='200'>{$id->idGuru}</td>
<td width='200'>{$id->guru}</td>
<td width='200'>{$id->idKelas}</td>
<td width='200'>{$id->kelas}</td>
<td width='200'>{$id->status}</td>
<td width='200'>{$id->hari}</td>
<td width='200'>{$id->jam_mulai}</td>
<td width='200'>{$id->jam_selesai}</td>
</tr>
 
";
}
echo '</table>';
?>
 
</body>
</html>