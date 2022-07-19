<?php
declare(strict_types=1);

namespace hamaelt\VirusScanner;


use hamaelt\VirusScanner\Exceptions\IcapException;
use Hamaelt\VirusScanner\Icap\IcapClient;

class VirusScanner
{
    public function __construct(private IcapClient $icapClient)
    {
    }

    public function isVirus(string $filePath): bool
    {
        if (!$this->icapClient->connect()) {
            $error = $this->icapClient->getLastSocketError();
            $message = "Can not connect  to ICAP. Socket error: $error";
            throw new IcapException($message);
        }

        try {
            $this->icapClient->options(); //required for respmod file request
            $respmod = $this->icapClient->respmod($filePath);

            $icapHeader = $respmod->getIcapHeader();
            return array_key_exists('X-Infection-Found', $icapHeader['headers']);
        } catch (\Exception$e) {
            throw new IcapException($e);
        } finally {
            $this->icapClient->diconnect();
        }
    }


}