<?php
function e(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }
function url(string $route, array $params = []): string {
    $q = array_merge(['r' => $route], $params);
    return 'index.php?' . http_build_query($q);
}
function redirect(string $route, array $params = []): void {
    header('Location: ' . url($route, $params));
    exit;
}
