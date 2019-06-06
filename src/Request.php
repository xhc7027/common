<?php
/**
 * 金融新业务 REQUEST 方法
 * @author 杜鑫 <duxin7@xin.com>
 * @copyright 2019 优信金融新业务研发组
 * @category jrcomposer
 */
namespace Jrcomposer\Common;

use GuzzleHttp\Client;

/**
 *
 * @author duxin7
 * @method delete
 * @tutorial <pre>
 *           Request::put();
 *          
 *           (new Request())->setUri('zxx')->put([]);
 *           (new Request($uri))->put([]);
 *           Request::put([], $uri);
 *           </pre>
 *          
 */
final class Request extends CommonAbstract
{

    private static $headers = [
        'jr_client' => 'Jrcomposer Http Request'
    ];

    private static $client;

    private static $uri;

    private static $response;

    private static $method;

    public function __construct($config = [], $uri = '')
    {
        $config = array_merge($this->headers, $config);
        
        if (self::$client) {
            self::$client = new Client();
        }
        
        if ($uri) {
            self::$uri = $uri;
        }
    }

    /**
     * 删除资源
     *
     * @param array $parameters            
     * @param string $uri            
     * @param array $headers            
     * @return string|array|json
     * @throws RequestException
     */
    private function delete($parameters = [], $uri = '', $headers = [])
    {
        self::$method = 'DELETE';
        return $this->doRequest($parameters = [], $uri = '', $headers = []);
    }

    private function get($parameters = [], $uri = '', $headers = [])
    {
        self::$method = 'GET';
        return $this->doRequest($parameters = [], $uri = '', $headers = []);
    }

    private function patch($parameters = [], $uri = '', $headers = [])
    {
        self::$method = 'GET';
        return $this->doRequest($parameters = [], $uri = '', $headers = []);
    }

    private function post($parameters = [], $uri = '', $headers = [])
    {
        self::$method = 'GET';
        return $this->doRequest($parameters = [], $uri = '', $headers = []);
    }

    private function put($parameters = [], $uri = '', $headers = [])
    {
        self::$method = 'GET';
        return $this->doRequest($parameters = [], $uri = '', $headers = []);
    }

    public function doRequest($parameters = [], $uri = '', $headers = [])
    {
        $headers = array_merge(self::$headers,$headers);
        
        ($uri = $uri ? $uri : self::$uri);
        if (empty($uri)) {
            throw  (new \Exception('aaa'));
            throw (new RequestException($headers));
        }
        
        
        self::$response = self::$client->request(self::$method, $uri, [
            'body' => $parameters,
            'headers' => $headers
        ]);
        return $this;
    }

    public function setUri($uri)
    {
        self::$uri = $uri;
        return $this;
    }

    public function getUri($uri)
    {
        return self::$uri;
    }

    public function setHeader($key, $value)
    {
        self::$headers['jr_' . $key] = $value;
        return $this;
    }

    public function getHeader()
    {
        return self::$headers;
    }

    public function response($header = false)
    {
        $headers = self::$response->getHeaders();
        
        if ($headers['http_code'] > 400) {
            throw (new RequestException($headers));
        }
        
        $body = self::$response->getBody();
        
        if ($header) {
            return [
                'headers' => $headers,
                'body' => $body
            ];
        } else {
            return $body;
        }
    }
}
