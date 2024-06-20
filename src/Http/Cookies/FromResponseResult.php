<?php

declare(strict_types=1);

namespace Rb\Http\Cookies;

use Rb\Generic\Result;
use Rb\Http\HttpCookie;

class FromResponseResult
{
    private Result $responseResult;

    public function __construct(Result $responseResult)
    {
        $this->responseResult = $responseResult;
    }

    /**
     * @return HttpCookie[]
     */
    public function cookies(): array
    {
        if (!$this->responseResult->isSuccessful()) {
            return [];
        }

        $response = $this->responseResult->value();

        if (!isset($response['headers']['Set-Cookie']) || empty($response['headers']['Set-Cookie'])) {
            return [];
        }

        return
            array_map(
                function (string $cookie) {
                    parse_str(strtr($cookie, array('&' => '%26', '+' => '%2B', ';' => '&')), $decodedCookie);

                    $lowerCasesKeys = array_change_key_case($decodedCookie);

                    return
                        new HttpCookie(
                            array_key_first($decodedCookie),
                            reset($decodedCookie),
                            $lowerCasesKeys['expires'] ?? '',
                            $lowerCasesKeys['path'] ?? '',
                            $lowerCasesKeys['domain'] ?? '',
                            isset($lowerCasesKeys['secure']),
                            isset($lowerCasesKeys['httponly']),
                        );
                },
                $response['headers']['Set-Cookie']
            );
    }
}