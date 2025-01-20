<?php
$file = 'data.json';

if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
    echo json_encode($data);
} else {
    echo json_encode([]);
}
