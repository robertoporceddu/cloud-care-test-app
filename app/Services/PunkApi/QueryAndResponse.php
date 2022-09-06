<?php

namespace App\Services\PunkApi;

use Symfony\Component\HttpKernel\Exception\HttpException;

trait QueryAndResponse {

    private function query()
    {
        return http_build_query(request()->input());
    }

    private function response($response)
    {
        if($response->status() != 200 and $response->status() != 204)
        {
            throw new HttpException(
                $response->status(),
                $response->object()->message
            );

        }

        return $response->object();
    }
}
