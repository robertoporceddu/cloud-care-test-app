<?php

namespace App\Services\PunkApi;

trait QueryAndResponse {

    private function query()
    {
        return http_build_query(request()->input());
    }

    private function response($response)
    {
        if($response->status() != 200)
        {
            throw new \Exception(
                $response->object()->message,
                $response->object()->statusCode
            );
        }

        return $response->object();
    }
}
