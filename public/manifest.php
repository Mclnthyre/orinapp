<?php
// Garante que o navegador reconheça como manifest PWA
header("Content-Type: application/manifest+json; charset=utf-8");

// Caminho completo do seu manifest original
$manifestPath = __DIR__ . '/manifest.webmanifest';

if (file_exists($manifestPath)) {
    echo file_get_contents($manifestPath);
} else {
    echo json_encode([
        "error" => "manifest not found",
        "path" => $manifestPath
    ]);
}
