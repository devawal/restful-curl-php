<?php 

namespace RestfullCurl;

/**
 * Restfull CURL
 * 
 * @author Abdul Awal <awal.ashu@gmail.com>
 * @link https://github.com/devawal/restful-curl-php
 */
class RestCurl
{
	/**
     * Restful Curl get request
     *
     * @param string $url               The request url
     * @param null|array $method        Request type
     * @param string $parameters        Request parameters. Default null
     * @param array $json_post          Set true if request data is json
     * @param boolean $header           Request header data. Default Content-Type:application/json
     * @param boolean $object
     * @return object
     */
    public static function get($url, $parameters = null, $json_post = false, $header = array('Content-Type:application/json'), $object = true)
    {
        return self::restClient($url, 'GET', $parameters, $json_post, $header, $object);
    }

    /**
     * Restful Curl post request
     *
     * @param string $url               The request url
     * @param null|array $method        Request type
     * @param string $parameters        Request parameters. Default null
     * @param array $json_post          Set true if request data is json
     * @param boolean $header           Request header data. Default Content-Type:application/json
     * @param boolean $object
     * @return object
     */
    public static function post($url, $parameters = null, $json_post = false, $header = array('Content-Type:application/json'), $object = true)
    {
        return self::restClient($url, 'POST', $parameters, $json_post, $header, $object);
    }

    /**
     * Restful Curl put request
     *
     * @param string $url               The request url
     * @param null|array $method        Request type
     * @param string $parameters        Request parameters. Default null
     * @param array $json_post          Set true if request data is json
     * @param boolean $header           Request header data. Default Content-Type:application/json
     * @param boolean $object
     * @return object
     */
    public static function put($url, $parameters = null, $json_post = false, $header = array('Content-Type:application/json'), $object = true)
    {
        return self::restClient($url, 'PUT', $parameters, $json_post, $header, $object);
    }

    /**
     * Restful Curl patch request
     *
     * @param string $url               The request url
     * @param null|array $method        Request type
     * @param string $parameters        Request parameters. Default null
     * @param array $json_post          Set true if request data is json
     * @param boolean $header           Request header data. Default Content-Type:application/json
     * @param boolean $object
     * @return object
     */
    public static function patch($url, $parameters = null, $json_post = false, $header = array('Content-Type:application/json'), $object = true)
    {
        return self::restClient($url, 'PATCH', $parameters, $json_post, $header, $object);
    }

    /**
     * Restful Curl options request
     *
     * @param string $url               The request url
     * @param null|array $method        Request type
     * @param string $parameters        Request parameters. Default null
     * @param array $json_post          Set true if request data is json
     * @param boolean $header           Request header data. Default Content-Type:application/json
     * @param boolean $object
     * @return object
     */
    public static function options($url, $parameters = null, $json_post = false, $header = array('Content-Type:application/json'), $object = true)
    {
        return self::restClient($url, 'OPTIONS', $parameters, $json_post, $header, $object);
    }

    /**
     * Restful Curl delete request
     *
     * @param string $url               The request url
     * @param null|array $method        Request type
     * @param string $parameters        Request parameters. Default null
     * @param array $json_post          Set true if request data is json
     * @param boolean $header           Request header data. Default Content-Type:application/json
     * @param boolean $object
     * @return object
     */
    public static function delete($url, $parameters = null, $json_post = false, $header = array('Content-Type:application/json'), $object = true)
    {
        return self::restClient($url, 'DELETE', $parameters, $json_post, $header, $object);
    }

    /**
     * Restful Curl request
     *
     * @param string $url               The request url
     * @param null|array $method        Request type
     * @param string $parameters        Request parameters
     * @param array $json_post          Set true if request data is json
     * @param boolean $header           Request header data
     * @param boolean $object
     * @return object
     */
    public static function restClient($url, $method, $parameters, $json_post, $header, $object)
    {
        if (!empty($parameters))
            $parameters = $json_post ? json_encode($parameters) : http_build_query($parameters);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method == 'GET' && !empty($parameters))
            $url .= '?' . $parameters;
        elseif ($method == 'POST')
            curl_setopt($ch, CURLOPT_POST, true);
        elseif ($method == 'PUT')
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        elseif ($method == 'PATCH')
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        elseif ($method == 'OPTIONS')
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'OPTIONS');
        elseif ($method == 'DELETE')
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

        // Set curl parameters
        if ($method != 'GET' && !empty($parameters)) curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);

        // Here you can set the Response Content Type you prefer to get :
        // application/json, application/xml, text/html, text/plain, etc
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // Let's give the Request Url to Curl
        curl_setopt($ch, CURLOPT_URL, $url);

        // Yes we want to get the Response Header
        // (it will be mixed with the response body but we'll separate that after)
        curl_setopt($ch, CURLOPT_HEADER, false);

        // Allows Curl to connect to an API server through HTTPS
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Let's get the Response !
        $api_response = curl_exec($ch);

        // We need to get Curl infos for the header_size and the http_code
        $api_response_info = curl_getinfo($ch);

        // Don't forget to close Curl
        curl_close($ch);

        return $object ? json_decode($api_response) : $api_response;
    }
}