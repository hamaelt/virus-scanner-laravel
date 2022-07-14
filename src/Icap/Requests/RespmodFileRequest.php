<?php


namespace hamaelt\VirusScanner\Icap\Requests;


use Hamaelt\VirusScanner\Icap\IcapConstant;

class RespmodFileRequest extends IcapRequest
{
    private string $filepath;

    public function __construct(string $host, string $service)
    {
        parent::__construct($host, $service);
    }

    public function raw(): string
    {
        $requestLine = "HTTP/1,0 200 OK";

        $body = [
            "date" => date("D M j G:i:s Y"),
            "Last-Modified" => date("D M j G:i:s Y", filemtime($this->filepath)),
            "Content-Length" => filesize($this->filepath),
        ];

        $resBody = $this->parseRequest($requestLine, $body);

        $requestLine = "RESPMOD ica[://$this->host/$this->service ICAP/1.0";
        $body = [
            "Host" => $this->host,
            "User-Agent" => IcapConstant::USER_AGENT,
            "Preview" => filezise($this->filepath),
            "Encapsulated" => "res-hdr=0, res-body=" . strlen($resBody)
        ];

        $resHeader = $this->parseRequest($requestLine, $body);

        return $resHeader .
            $resBody .
            dechex(filesize($this->filepath)) . IcapConstant::REQUEST_EOL .
            $this->readFile($this->filepath) . IcapConstant::REQUEST_EOL .
            IcapConstant::REQUEST_EOL . IcapConstant::REQUEST_EOL .
            IcapConstant::REQUEST_EOL;
    }

    private function readFile(string $filepath)
    {
        $fileHandle = fopen($filepath, "r");
        $fileContent = fread($fileHandle, filesize($filepath));
        fclose($fileHandle);

        return $fileContent;
    }
}