<?php
// array multi-dimensi
$array = Array (
    "0" => Array (
        "ID Mata Pelajaran" => "1",
        "Kode Mata Pelajaran" => "MP01",
        "Nama Mata Pelajaran" => "Ilmu Hukum",
        "ID Guru" => "4",
        "Nama Guru" => "Bahtin Ruga Tomayahu",
        "ID Kelas" => "1",
        "Kelas" => "A",
        "Status" => "Aktif",
        "Hari" => "Senin",
        "Jam Mulai" => "10.30",
        "Jam Selesai" => "12.30"
    ),
    "1" => Array (
        "ID Mata Pelajaran" => "2",
        "Kode Mata Pelajaran" => "MP02",
        "Nama Mata Pelajaran" => "Ilmu Negara",
        "ID Guru" => "4",
        "Nama Guru" => "Bahtin Ruga Tomayahu",
        "ID Kelas" => "1",
        "Kelas" => "A",
        "Status" => "Aktif",
        "Hari" => "Selasa",
        "Jam Mulai" => "09.00",
        "Jam Selesai" => "11.30"
    ),
    "2" => Array (
        "ID Mata Pelajaran" => "3",
        "Kode Mata Pelajaran" => "MP03",
        "Nama Mata Pelajaran" => "Hukum Indonesia",
        "ID Guru" => "5",
        "Nama Guru" => "Farida Pakaya",
        "ID Kelas" => "2",
        "Kelas" => "B",
        "Status" => "Aktif",
        "Hari" => "Rabu",
        "Jam Mulai" => "07.00",
        "Jam Selesai" => "08.30"
    ),
    "3" => Array (
        "ID Mata Pelajaran" => "4",
        "Kode Mata Pelajaran" => "MP04",
        "Nama Mata Pelajaran" => "Hukum Pidana",
        "ID Guru" => "5",
		"Nama Guru" => "Farida Pakaya",
        "ID Kelas" => "2",
        "Kelas" => "B",
        "Status" => "Aktif",
        "Hari" => "Kamis",
        "Jam Mulai" => "08.30",
        "Jam Selesai" => "10.00"
    )
);

// encode array to json
$json = json_encode(array('data' => $array));

// write json to file
if (file_put_contents("data.json", $json)){
    echo "File JSON sukses dibuat...";
} else {
    echo "Oops! Terjadi error saat membuat file JSON...";
}
?>