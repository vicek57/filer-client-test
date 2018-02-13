<?php

namespace Project\Filer\client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class ApiClient
{
    protected $INSTANCE = null;
    protected $cli;

    public static function getInstance()
    {
        if (is_null(self::$INSTANCE)) {
            self::$INSTANCE = new ApiClient();
        }
        return self::$INSTANCE;
    }

    protected function __construct()
    {
        $cli = new GuzzleClient(['base_uri' => 'https://foo.com/api/']);
    }

    public function createFile(array $data = [])
    {
        $promise = $this->cli->postAsync('file', $data);
        $promise->then(
            function(ResponseInterface $res) {
                echo $res->getStatusCode() . "\n";

                // echo all fields from header
                foreach($res->getHeaders() as $name => $values) {
                    echo $name . ": " . implode(', ', $values) . "\r\n";
                }
            },
            function(RequestException $e) {
                echo $e->getMessage() . "\n";
                echo $e->getRequest()->getMethod();
            }
        );
    }

    public function getFile(int $id)
    {
        $promise = $this->cli->getAsync('file/' . $id);
        $promise->then(
            function(ResponseInterface $res) {
                echo $res->getStatusCode() . "\n";
            },
            function(RequestException $e) {
                echo $e->getMessage() . "\n";
                echo $e->getRequest()->getMethod();
            }
        );
    }

    public function updateFile(int $id, array $data = [])
    {
        $promise = $this->cli->putAsync('file/' . $id, $data);
        $promise->then(
            function(ResponseInterface $res) {
                echo $res->getStatusCode() . "\n";
            },
            function(RequestException $e) {
                echo $e->getMessage() . "\n";
                echo $e->getRequest()->getMethod();
            }
        );
    }

    public function deleteFile(int $id)
    {
        $promise = $this->cli->deleteAsync('file/' . $id);
        $promise->then(
            function(ResponseInterface $res) {
                echo $res->getStatusCode() . "\n";
            },
            function(RequestException $e) {
                echo $e->getMessage() . "\n";
                echo $e->getRequest()->getMethod();
            }
        );
    }
}

