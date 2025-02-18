<?php
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP dari shared internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP dari proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // IP dari remote address
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Mendapatkan IP
$user_ip = getUserIP();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['user'] ?? '';
    $score = $_POST['score'] ?? '';

    $filename = "output.txt";
    $data = "Nama: $nama, Score: $score, IP Address: $user_ip\n";

    if (file_put_contents($filename, $data, FILE_APPEND)) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Gagal menyimpan data!";
    }
} else {
    echo "Akses tidak valid.";
}
?>