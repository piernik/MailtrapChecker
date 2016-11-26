<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2016-11-23
 * Time: 10:13
 */

namespace Lukana\MailtrapChecker;


use GuzzleHttp\Client;

class Request
{
    /** @var Client */
    protected $guzzle;

    /** @var  string */
    protected $url;
    /** @var string */
    protected $method = 'GET';
    /** @var  array */
    protected $headers;


    public function __construct()
    {
        $this->guzzle = new Client();
    }

    public function sendRequest()
    {
        return $this->guzzle->request($this->getMethod(), $this->getUrl(), $this->getHeaders());
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}