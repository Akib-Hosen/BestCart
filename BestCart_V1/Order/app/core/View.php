<?php
class View
{
    public static function render(string $view, array $data = []): void
    {
        $path = __DIR__ . '/../views/' . $view . '.php';
        if (!file_exists($path)) {
            http_response_code(404);
            echo 'View not found';
            return;
        }
        extract($data, EXTR_SKIP);
        require $path;
    }
}
