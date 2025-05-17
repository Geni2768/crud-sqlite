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

<?php
$sql = 'SELECT id, deskripsi, waktu FROM tugas';

$statement = $conn->query($sql);
$tugas = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($tugas) {
 foreach ($tugas as $t) {
  echo $t['deskripsi'] . '<br>';
 }
}

<?php 
$id = 1;
$sql = 'SELECT id, deskripsi, waktu FROM tugas WHERE id = :tugas_id';

$statement = $conn->prepare($sql);
$statement->bindParam(':tugas_id', $id, PDO::PARAM_INT);
$statement->execute();
$tugas = $statement->fetch(PDO::FETCH_ASSOC);

if ($tugas) {
 echo $tugas['id'] . '.' . $tugas['deskripsi'];
} else {
 echo "Tugas dengan id $id tidak ditemukan.";
}

<?php
$id= 1;
$sql = 'DELETE FROM tugas WHERE id = :id';

$statement = $conn->prepare($sql);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

if ($statement->execute()) {
 echo "Tugas dengan id $id berhasil dihapus!";
}

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
