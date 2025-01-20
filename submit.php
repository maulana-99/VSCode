<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'namaLengkap' => $_POST['namaLengkap'] ?? '',
        'tanggalBayar' => $_POST['tanggalBayar'] ?? '',
        'kelas' => $_POST['kelas'] ?? '',
        'jurusan' => $_POST['jurusan'] ?? '',
        'totalBayar' => $_POST['totalBayar'] ?? '',
        'keterangan' => $_POST['keterangan'] ?? '',
    ];

    $file = 'data.json';

    if (file_exists($file)) {
        $currentData = json_decode(file_get_contents($file), true);
        $currentData[] = $data;
    } else {
        $currentData = [$data];
    }

    file_put_contents($file, json_encode($currentData, JSON_PRETTY_PRINT));
    http_response_code(200);
    echo json_encode(['message' => 'Data berhasil disimpan']);
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Metode tidak diizinkan']);
}
