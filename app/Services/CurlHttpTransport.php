<?php

namespace App\Services;


use DataSource\Services\HttpTransportInterface;
use DataSource\ValueObjects\CurlHttpResponseVO;
use DataSource\ValueObjects\HttpResponseVOInterface;

class CurlHttpTransport implements HttpTransportInterface
{
    public function get(string $url): HttpResponseVOInterface
    {
        $urlParts = parse_url($url);
        $url = $urlParts['scheme'] . '://' . idn_to_ascii($urlParts['host']) . $urlParts['path'];

        $ch = \curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = \curl_exec($ch);
        $response = new CurlHttpResponseVO(\curl_getinfo($ch, CURLINFO_HTTP_CODE), $content);
        \curl_close($ch);
        return $response;
    }
}