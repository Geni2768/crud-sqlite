<?php
$id= 1;
$sql = 'DELETE FROM tugas WHERE id = :id';

$statement = $conn->prepare($sql);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

if ($statement->execute()) {
 echo "Tugas dengan id $id berhasil dihapus!";
}
