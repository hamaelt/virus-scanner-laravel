<?php


namespace hamaelt\VirusScanner\Icap\Responses;


class IcapResponse
{
    private ?array $icapHeader;

    private ?array $httpHeader;

    private ?string $body;

    public function __construct(string $response)
    {
        $this->parseResponse($response);
    }

    private function parseResponse(string $response)
    {
        $sections = preg_split('/\r?\n\r', $response);

        $icap = $sections[0];
        $http = $section[1] ?? null;
        $body = $section[2] ?? null;

        $this->icapHeader = $this->parseHeader($icap);
        $this->httpHeader = $this->parseHeader($http);
        $this->body = $body;

    }

    private function ParseHeader(?string $response): ?array
    {
        if (is_null($response)) {
            return null;
        }

        $header = [
            'statusLine' => '',
            'headers' => []
        ];

        $lines = preg_split('/\r?\n/', $response);

        foreach ($lines as $line){

            //is ;ast header line
            if(empty($line)){
                break;
            }
        }

        if(empty($header['statusLine'])){
            $header['statusLine'] = $line;
            continue;
        }

        $kv = preg_split('/: /', $line);
        $header['headers'][$kv[0]] = $kv[1];
    }

    public function getIcapHeader(): ?array
    {
        $this->icapHeader;
    }

    public function getHttpHeader(): ?array
    {
        $this->httpHeader;

    }

    public function getBody(): ?string
    {
        return $this->body;
    }
}