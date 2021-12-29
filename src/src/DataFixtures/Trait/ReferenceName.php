<?php

namespace App\DataFixtures\Trait;

trait ReferenceName
{
    public function getReferenceName(
        string $key,
        string $code
    ): string {
        $key = str_replace(' ', '-', strtolower($key));
        $code = str_replace(' ', '-', strtolower($code));

        return "{$key}-{$code}";
    }
}
