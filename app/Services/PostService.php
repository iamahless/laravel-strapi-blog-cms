<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use stdClass;

class PostService
{
    private PendingRequest $strapi;

    private stdClass $payload;

    public function __construct()
    {
        $this->strapi = Http::baseUrl(config('blogapi.url'));
        $this->payload = new stdClass();
    }

    public function index($payload): stdClass
    {
        try {
            $queryString = '/blogs?' .
                'populate=coverImage,categories&' .
                'locale=' . $payload->locale;

            $request = $this->strapi->get($queryString);

            if ($request->successful()) {
                $response = $request->object();

                $this->payload->posts = $response->data;
                $this->payload->meta = $response->meta;
                $this->payload->status = 200;

                return $this->payload;
            }
            $this->payload->status = 500;

            return $this->payload;
        } catch (Exception $exception) {
            $this->payload->message = 'something went wrong';
            $this->payload->status = 500;

            return $this->payload;
        }
    }

    public function show($payload): stdClass
    {
        try {
            $postIdArray = explode('-', $payload->postId);
            $postId = $postIdArray[0];

            $queryString = '/blogs/' . $postId . '?' .
                'populate=coverImage,categories&' .
                'locale=' . $payload->locale;

            $request = $this->strapi->get($queryString);

            if ($request->successful()) {
                $response = $request->object();

                $this->payload->post = $response->data;
                $this->payload->status = 200;

                return $this->payload;
            }
            $this->payload->status = 500;

            return $this->payload;
        } catch (Exception $exception) {
            $this->payload->message = 'something went wrong';
            $this->payload->status = 500;

            return $this->payload;
        }
    }
}
