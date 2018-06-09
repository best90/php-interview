<?php

class HttpServer
{
    private $_ip;
    private $_port;
    private $_socket;

    public function __construct($ip = '127.0.0.1', $port = '8081')
    {
        $this->_ip = $ip;
        $this->_port = $port;
        $this->_socket = socket_create(AF_INET,SOCK_STREAM, SOL_TCP);
        if ($this->_socket === false) {
            die(socket_strerror(socket_last_error($this->_socket)));
        }
    }

    public function run()
    {
        try {
            socket_bind($this->_socket, $this->_ip, $this->_port);
            socket_listen($this->_socket, 10);

            while (true) {
                $socketAccept = socket_accept($this->_socket);
                $request = socket_read($socketAccept, 1024);
                echo $request;

                $fileName = $this->getUri($request);
                $fileExt = preg_replace('/^.*\.(\w+)$/', '$1', $fileName);
                $fileName = __DIR__.'/'.$fileName;
                if (is_dir($fileName)) $fileName .= 'index.html';

                if (file_exists($fileName)) {
                    socket_write($socketAccept, 'HTTP/1.1 200 OK'.PHP_EOL);
                    switch ($fileExt) {
                        case 'php':
                            //socket_write($socketAccept, 'Content-Type: text/html'.PHP_EOL);
                            exec('php '.$fileName, $fileContent);
                            $fileContent = implode(PHP_EOL, $fileContent);
                            break;
                        default:
                            socket_write($socketAccept, 'Content-Type: '.$this->getContentType($fileExt).PHP_EOL);
                            $fileContent = file_get_contents($fileName);
                    }
                } else {
                    socket_write($socketAccept, 'HTTP/1.1 404 NOT FOUND'.PHP_EOL);
                    socket_write($socketAccept, 'Content-Type:text/html'.PHP_EOL);
                    $fileContent = '<h1>404 NOT FOUND</h1>';
                }

                socket_write($socketAccept, 'Content-Encoding:keep-alive'.PHP_EOL);
                socket_write($socketAccept, 'Connection:keep-alive'.PHP_EOL);
                socket_write($socketAccept, 'Date:'.date('Y-m-d H:i:s').PHP_EOL);
                socket_write($socketAccept, 'Server:http server/1.0.0'.PHP_EOL);
                socket_write($socketAccept,''.PHP_EOL);
                socket_write($socketAccept, $fileContent, strlen($fileContent));
                socket_close($socketAccept);
            }
        } catch (Exception $exception) {
            isset($socketAccept) ? socket_close($socketAccept) : null;
        }
    }

    protected function getUri($request = '')
    {
        $arrayRequest = explode(PHP_EOL, $request);
        $line = $arrayRequest[0];
        $file = trim(preg_replace('/(\w+)\s\/(.*)\sHTTP\/1.1/i','$2', $line));
        return $file;
    }

    public function getContentType($fileExtension)
    {
        switch ($fileExtension) {
            case 'htm':
            case 'html':
                return 'text/html';
            case 'xml':
            case 'xhtml':
                return 'text/xml';
            case 'xls':
                return 'application/x-xls';
            case 'pdf':
                return 'application/pdf';
            case 'doc':
                return 'application/msword';
            case 'txt':
                return 'text/plain';
            case 'gif':
                return 'image/gif';
            case 'jpg':
                return 'image/jpeg';
            case 'png':
                return 'image/png';
            default:
                return 'text/html';
        }
    }

    public function close()
    {
        socket_close($this->_socket);
    }
}

set_time_limit(0);
$server = new HttpServer();
$server->run();