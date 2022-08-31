<?php

namespace App\HTML;

class Nav
{


    public static function item(string $link, string $name): ?string
    {
        $class = $_SERVER["REQUEST_URI"] === $link ? "nav-link active" : "nav-link";
        $ariaCurrent = $_SERVER["REQUEST_URI"] === $link ? "aria-current=\"page\"" : null;
        return <<<HTML
            <li class="nav-item">
                <a class="{$class}" $ariaCurrent href="{$link}">{$name}</a>
            </li>
        HTML;
    }
}
