<?php
...

$deskripsi = 'Tidur siang';
$waktu = 90;
$sql = 'INSERT INTO tugas(deskripsi, waktu) VALUES(:deskripsi, :waktu)';

$statement = $conn->prepare($sql);

$statement->execute([
 ':deskripsi' => $deskripsi,
 ':waktu' => $waktu
]);

$tugas_id = $conn->lastInsertId();

... // lakkan redirect di sini
