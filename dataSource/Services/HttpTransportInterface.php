<?php

namespace DataSource\Services;


use DataSource\ValueObjects\HttpResponseVOInterface;

interface HttpTransportInterface
{
    public function get(string $url): HttpResponseVOInterface;
}
