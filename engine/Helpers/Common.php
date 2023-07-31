<?php

namespace Engine\Helpers;

class Common
{
    public static function getHttpMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    private static function getUri(): string
    {
        return rtrim($_SERVER['REQUEST_URI'], '/');
    }

    public static function getPath(): string
    {
        $pathUrl = self::getUri();

        if ($position = strpos($pathUrl, '?')) {
            $pathUrl = substr($pathUrl, 0, $position);
        }

        return $pathUrl;
    }

    public static function isPost(): bool
    {
        return self::getHttpMethod() === 'POST';
    }

    public static function isGet(): bool
    {
        return self::getHttpMethod() === 'GET';
    }
}