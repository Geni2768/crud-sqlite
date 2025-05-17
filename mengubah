<?php 
$tugas = [
 'id' => 1,
 'deskripsi' => 'Hiking Gunung Batur',
 'waktu' => 50
];

$sql = 'UPDATE tugas SET deskripsi = :deskripsi, waktu = :waktu WHERE id = :id';

$statement = $conn->prepare($sql);
$statement->bindParam(':id', $publisher['id'], PDO::PARAM_INT);
$statement->bindParam(':deskripsi', $publisher['deskripsi']);
$statement->bindParam(':waktu', $publisher['waktu'], PDO::PARAM_INT);

if ($statement->execute()) {
 //lakukan redirect untuk menampilkan tugas yang baru saja diupdate
}
