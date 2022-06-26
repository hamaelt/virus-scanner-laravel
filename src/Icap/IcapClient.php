<?php

declare(strict_types=1);

use Socket;

class IcapClient
{
    private string $host;

    private int $port;

    private string $service;

    Private Socket $socket;

    /**
     * IcapClient constructor.
     * @param $
     */
    public function __construct(string $host, int $port, string $service)
    {

    }

    public function connect(): bool
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        return @socket_connect($this->socket, $this->host, $this->port);
    }

    public function disconnect(): void
    {
        @socket_shutdown($this->socket);
        @socket_close($this->socket);
    }

}