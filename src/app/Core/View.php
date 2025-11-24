<?php

namespace App\Core;

class View {
    public static function render($template, $data = []) {
        extract($data);
        include "../app/Views/includes/header.php";
        include "../app/Views/$template";
        include "../app/Views/includes/footer.php";
    }
}