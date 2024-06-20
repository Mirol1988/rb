<?php

declare(strict_types=1);

namespace Rb\Http\Transport;

use Rb\Generic\Result;
use Rb\Generic\Result\Failed;
use Rb\Generic\Result\Successful;
use Rb\Http\Request;
use Rb\Http\Transport;

class JsonDecoded implements Transport
{
    private Transport $transport;

    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    public function response(Request $request): Result
    {
        $result = $this->transport->response($request);

        if (!$result->isSuccessful()) {
            return $result;
        }

        $body = $result->value()['body'];

        if (empty($body)) {
            return new Successful([]);
        }

        $response = json_decode($body, true);

        if(!is_array($response)){
            return new Failed(['The json decoded result is not an array']);
        }

        return new Successful($response);
    }
}