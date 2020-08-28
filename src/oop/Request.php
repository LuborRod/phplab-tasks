<?php


namespace src\oop;


use http\Exception\InvalidArgumentException;

class Request
{
    private array $query;
    private array $request;
    private Cookies $cookies;
    private Session $session;

    public function __construct()
    {
        $this->query = $_GET;
        $this->request = $_POST;
        $this->cookies = new Cookies();
        $this->session = new Session();
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function query($key, $default = null)
    {
        Helper::isIndexStringOrInt($key);

        if (array_key_exists($key, $this->query)) {
            return $this->query[$key];
        }

        return $default;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function post($key, $default = null)
    {
        Helper::isIndexStringOrInt($key);

        if (array_key_exists($key, $this->request)) {
            return $this->request[$key];
        }

        return $default;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        Helper::isIndexStringOrInt($key);

        if (array_key_exists($key, $this->request)) {
            return $this->request[$key];
        }

        if (array_key_exists($key, $this->query)) {
            return $this->query[$key];
        }

        return $default;
    }

    /**
     * @param array $only
     * @return array
     */
    public function all(array $only = [])
    {
        // array_merge will replace string_keys, if GET and POST will have the same key.
        // That`s why we have to return 2 arrays GET and POST.
        if (empty($only)) {
            return array_merge_recursive($this->query, $this->request);
        }
        $values = [];
        foreach ($only as $searchKey) {
            foreach ($this->query as $key => $value) {
                if ($searchKey === $key) {
                    $values['GET'][] = $value;
                }
            }
        }
        foreach ($only as $searchKey) {
            foreach ($this->request as $key => $value) {
                if ($searchKey === $key) {
                    $values['POST'][] = $value;
                }
            }
        }

        return $values;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        Helper::isIndexStringOrInt($key);

        if (array_key_exists($key, $this->query) || array_key_exists($key, $this->request)) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function ip()
    {
        $resources = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];
        foreach ($resources as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    /**
     * @return mixed|null
     */
    public function userAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? null;
    }

    public function cookies()
    {
        return $this->cookies;
    }

    public function session()
    {
        return $this->session;
    }

}


