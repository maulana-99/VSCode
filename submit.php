<?php
$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'POST':
        $data = [
            'namaLengkap' => $_POST['namaLengkap'] ?? '',
            'tanggalBayar' => $_POST['tanggalBayar'] ?? '',
            'kelas' => $_POST['kelas'] ?? '',
            'jurusan' => $_POST['jurusan'] ?? '',
            'totalBayar' => $_POST['totalBayar'] ?? '',
            'keterangan' => $_POST['keterangan'] ?? '',
        ];

        $file = 'data.json';
        $currentData = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $currentData[] = $data;

        if (file_put_contents($file, json_encode($currentData, JSON_PRETTY_PRINT))) {
            http_response_code(200);
            echo json_encode(['message' => 'Data berhasil disimpan']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Data tidak berhasil disimpan']);
        }
        break;

    default:
        http_response_code(400);
        echo json_encode(['message' => 'Permintaan tidak valid']);
        break;
}
