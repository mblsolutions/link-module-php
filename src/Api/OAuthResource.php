<?php

namespace MBLSolutions\LinkModule\Api;

use GuzzleHttp\Client;

class OAuthResource extends ApiResource
{
    public function __construct(
        private string $tokenUri,

        private string $clientId,

        private string $clientSecret
    )
    {
        parent::__construct();

        $client = new Client();

        $this->setApiRequestor(new ApiRequestor($client));
    }

    public function getToken(): AccessToken
    {
        $response = $this->getApiRequestor()
            ->getHttpClient()
            ->request('post', $this->tokenUri, [
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ],
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                    'Accept' => 'application/json'
                ]
            ]);

        $decodedResponse = json_decode($response->getBody()->getContents(), true);

        return new AccessToken(
            accessToken: $decodedResponse['access_token'],
            tokenType: $decodedResponse['token_type'],
            expiresIn: $decodedResponse['expires_in']
        );
    }
}