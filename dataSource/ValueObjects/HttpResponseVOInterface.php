<?php

namespace DataSource\ValueObjects;

interface HttpResponseVOInterface
{
    public function getCode(): int;

    public function getContent(): string;
}