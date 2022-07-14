<?php


namespace hamaelt\VirusScanner\Icap\Requests;


use Hamaelt\VirusScanner\Icap\IcapConstant;

abstract class IcapRequest
{
    protected string $host;

    protected string $service;

    public function __construct(string $host, string $service)
    {
        $this->host = $host;
        $this->service = $service;
    }

    protected function parseRequest(string $startLine, array $header): string
    {
        $request = $startLine . IcapConstant::REQUEST_EOL;

        foreach($header as $k => $v) {
            $request .= "$k: $v";
            $request .= IcapConstant::REQUEST_EOL;
        }
        $request .= IcapConstant::REQUEST_EOL;

        return $request;
    }

    abstract public function raw(): string;
}