<?php

namespace App\Services\App;

use Psr\Http\Message\ServerRequestInterface;

final class Client
{
    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
        private readonly ServerRequestInterface $request
    ) {}

    private function client(): ?ServerRequestInterface
    {
        return $this->request->withParsedBody([
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => $this->request->getParsedBody()['grant_type'],
            'username' => $this->request->getParsedBody()['username'],
            'password' => $this->request->getParsedBody()['password'],
        ]);
    }

    public function parseRequestBody(): ?ServerRequestInterface
    {
        return $this->client();
    }

    public function getUsername(): string
    {
        return $this->request->getParsedBody()['username'];
    }

    public function getGrantType(): string
    {
        return $this->request->getParsedBody()['grant_type'];
    }
}
