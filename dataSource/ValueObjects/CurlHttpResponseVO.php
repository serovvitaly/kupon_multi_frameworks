<?php

namespace DataSource\ValueObjects;

class CurlHttpResponseVO implements HttpResponseVOInterface
{
    protected $code;
    protected $content;

    public function __construct(int $code, string $content)
    {
        $this->code = $code;
        $this->content = trim($content);
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}