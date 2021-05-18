<?php

class Http
{
    /**
     * redirect
     *
     * @param  string $url
     * @return void
     */
    public static function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }
}