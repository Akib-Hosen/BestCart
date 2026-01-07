<?php
class Controller
{
    protected function render(string $view, array $data = []): void
    {
        View::render($view, $data);
    }
}
