<?php

// src/Service/TwitterClient.php
namespace App\Service;

use App\Util\Rot13Transformer;
// ...

class TwitterClient
{
    public function __construct(
        private Rot13Transformer $transformer,
    ) {
    }

    public function tweet(string $status): void
    {
        $transformedStatus = $this->transformer->transform($status);
        // ... connect to Twitter and send the encoded status
    }
}
