<?php

namespace App\Services\PunkApi;

use Illuminate\Support\Facades\Http;

class PunkApiService
{
    use QueryAndResponse;

    private $baseUrl = 'https://api.punkapi.com/v2/';

    protected $resource;

    public function all()
    {
        return $this->response(
            Http::get($this->baseUrl.$this->resource.'?'.$this->query())
        );
    }

    public function show($id)
    {
        return $this->response(
            Http::get($this->baseUrl.$this->resource.'/'.$id)
        );
    }

    public function random()
    {
        return $this->response(
            Http::get($this->baseUrl.$this->resource.'/random')
        );
    }
}
