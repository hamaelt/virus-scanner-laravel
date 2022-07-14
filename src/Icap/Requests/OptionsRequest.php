<?php


namespace hamaelt\VirusScanner\Icap\Requests;


use Hamaelt\VirusScanner\Icap\IcapConstant;

class OptionsRequest extends IcapRequest
{
    public function __construct(string $host, string $service)
    {
        parent::__construct($host, $service);
    }

    public function raw(): string
    {
        $startLine = "OPTION icap://{$this->host}/{$this->service} ICAP/1.0";
        $headers = [
            'Host' => $this->host,
            'User-Agent' => IcapConstant::USER_AGENT
        ];

        return parent::parseRequest($startLine,$headers);
    }
}