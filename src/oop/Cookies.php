<?php


namespace src\oop;

class Cookies
{
    private array $values;

    public function __construct()
    {
        $this->values = $_COOKIE;
    }

    /**
     * @param array $only
     * @return array
     */
    public function all(array $only = []): array
    {
        if (empty($only)) {
            return $this->values;
        }
        $searchCookies = [];
        foreach ($only as $searchKey) {
            foreach ($this->values as $key => $value) {
                if ($searchKey === $key) {
                    $searchCookies[] = $value;
                }
            }
        }

        return $searchCookies;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        Helper::isIndexStringOrInt($key);

        if (array_key_exists($key, $this->values)) {
            return $this->values[$key];
        }

        return $default;
    }


    /**
     * @param $key
     * @param $value
     * @throws \Exception
     */
    public function set($key, $value)
    {
        Helper::isIndexStringOrInt($key);
        Helper::isString($key);

        if (setcookie($key, $value) === false) {
            throw new \Exception('Undefined error');
        }
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        Helper::isIndexStringOrInt($key);

        return array_key_exists($key, $this->values);
    }

    /**
     * @param $key
     * @throws \Exception
     */
    public function remove($key)
    {
        Helper::isIndexStringOrInt($key);

        if (array_key_exists($key, $this->values)) {
            if (setcookie($key, "", time() - 3600) === false) {
                throw new \Exception('Undefined error');
            }
        }
    }
}