<?php

namespace App;


class UrlHelper
{
    /**
     * Преобразует доменное имя URL в формат IDNA ASCII
     * @param string $url
     * @return string
     */
    public static function idnToAscii(string $url): string
    {
        $urlParts = parse_url($url);
        return $urlParts['scheme'] . '://' . idn_to_ascii($urlParts['host']) . $urlParts['path'];
    }

    /**
     * Преобразует доменное имя URL из IDNA ASCII в Unicode
     * @param string $url
     * @return string
     */
    public static function idnToUtf8(string $url): string
    {
        $urlParts = parse_url($url);
        return $urlParts['scheme'] . '://' . idn_to_utf8($urlParts['host']) . $urlParts['path'];
    }
}