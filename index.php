<?php
// Koneksi ke SQLite
$conn = new PDO('sqlite:database.db');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ========== CREATE ==========
$deskripsi = 'Tidur siang';
$waktu = 90;

$sqlCreate = 'INSERT INTO tugas(deskripsi, waktu) VALUES(:deskripsi, :waktu)';
$statementCreate = $conn->prepare($sqlCreate);
$statementCreate->execute([
    ':deskripsi' => $deskripsi,
    ':waktu' => $waktu
]);
$tugas_id = $conn->lastInsertId();
echo "<h3>✅ Tugas baru ditambahkan dengan ID $tugas_id</h3><hr>";

// ========== READ (SEMUA TUGAS) ==========
echo "<h3>📋 Daftar Semua Tugas:</h3>";
$sqlAll = 'SELECT id, deskripsi, waktu FROM tugas';
$statementAll = $conn->query($sqlAll);
$tugas = $statementAll->fetchAll(PDO::FETCH_ASSOC);

if ($tugas) {
    foreach ($tugas as $t) {
        echo $t['id'] . '. ' . $t['deskripsi'] . ' (' . $t['waktu'] . ' menit)<br>';
    }
} else {
    echo "Tidak ada tugas.";
}
echo "<hr>";

// ========== READ (TUGAS TERTENTU) ==========
$id = 1; // bisa diganti sesuai kebutuhan
$sqlOne = 'SELECT id, deskripsi, waktu FROM tugas WHERE id = :tugas_id';
$statementOne = $conn->prepare($sqlOne);
$statementOne->bindParam(':tugas_id', $id, PDO::PARAM_INT);
$statementOne->execute();
$tugasOne = $statementOne->fetch(PDO::FETCH_ASSOC);

echo "<h3>🔍 Detail Tugas ID $id:</h3>";
if ($tugasOne) {
    echo $tugasOne['id'] . '. ' . $tugasOne['deskripsi'] . ' (' . $tugasOne['waktu'] . ' menit)<br>';
} else {
    echo "Tugas dengan ID $id tidak ditemukan.<br>";
}
echo "<hr>";

// ========== UPDATE ==========
$tugasUpdate = [
    'id' => 1,
    'deskripsi' => 'Hiking Gunung Batur',
    'waktu' => 50
];

$sqlUpdate = 'UPDATE tugas SET deskripsi = :deskripsi, waktu = :waktu WHERE id = :id';
$statementUpdate = $conn->prepare($sqlUpdate);
$statementUpdate->bindParam(':id', $tugasUpdate['id'], PDO::PARAM_INT);
$statementUpdate->bindParam(':deskripsi', $tugasUpdate['deskripsi']);
$statementUpdate->bindParam(':waktu', $tugasUpdate['waktu'], PDO::PARAM_INT);

echo "<h3>✏️ Update Tugas:</h3>";
if ($statementUpdate->execute()) {
    echo "Tugas ID " . $tugasUpdate['id'] . " berhasil diupdate!<br>";
}
echo "<hr>";

// ========== DELETE ==========
$idToDelete = 2; // ubah sesuai ID yang ingin dihapus
$sqlDelete = 'DELETE FROM tugas WHERE id = :id';
$statementDelete = $conn->prepare($sqlDelete);
$statementDelete->bindParam(':id', $idToDelete, PDO::PARAM_INT);

echo "<h3>🗑️ Hapus Tugas:</h3>";
if ($statementDelete->execute()) {
    echo "Tugas dengan ID $idToDelete berhasil dihapus.<br>";
}

