<?php

class ApiService
{
    /**
     * Get the API base URL from environment variable or use default
     *
     * @return string
     */
    protected static function getBaseURL()
    {
        return getenv('YG_API_BASE_URL') ?? 'https://app.tuyglu.com/api/rest/';
    }

    /**
     * Make a GET request to the API
     *
     * @param string $endpoint
     * @param array $headers
     * @return array
     */
    public static function get($endpoint, $headers = [])
    {
        $url = self::getBaseURL() . $endpoint;

        $args = [
            'method' => 'GET',
            'headers' => $headers,
        ];

        return self::makeRequest($url, $args);
    }

    /**
     * Make a POST request to the API
     *
     * @param string $endpoint
     * @param mixed $body
     * @param array $headers
     * @return array
     */
    public static function post($endpoint, $body = [], $headers = [])
    {
        $url = self::getBaseURL() . $endpoint;

        $args = [
            'method' => 'POST',
            'headers' => $headers,
            'body' => $body,
        ];

        return self::makeRequest($url, $args);
    }

    /**
     * Make a PUT request to the API
     * 
     * @param string $endpoint
     * @param mixed $body
     * @param array $headers
     * @return array
     */
    public static function put($endpoint, $body = [], $headers = [])
    {
        $url = self::getBaseURL() . $endpoint;

        $args = [
            'method' => 'PUT',
            'headers' => $headers,
            'body' => $body,
        ];

        return self::makeRequest($url, $args);
    }

    /**
     * Make a DELETE request to the API
     *
     * @param string $endpoint
     * @param array $headers
     * @return array
     */
    public static function delete($endpoint, $headers = [])
    {
        $url = self::getBaseURL() . $endpoint;

        $args = [
            'method' => 'DELETE',
            'headers' => $headers,
        ];

        return self::makeRequest($url, $args);
    }

    /**
     * Make an HTTP request using WordPress HTTP API
     *
     * @param string $url
     * @param array $args
     * @return array
     */
    protected static function makeRequest($url, $args)
    {
        $response = wp_remote_request($url, $args);

        if (is_wp_error($response)) {
            return [
                'success' => false,
                'error' => $response->get_error_message(),
                'data' => null
            ];
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        return [
            'success' => $status_code >= 200 && $status_code < 300,
            'status_code' => $status_code,
            'data' => json_decode($body, true),
            'raw_response' => $response
        ];
    }
}
