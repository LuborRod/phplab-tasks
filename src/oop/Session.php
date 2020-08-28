<?php


namespace src\oop;


class Session
{
    private array $values;

    public function __construct()
    {
        $this->values = &$_SESSION;
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
        $searchSessions = [];
        foreach ($only as $searchKey) {
            foreach ($this->values as $key => $value) {
                if ($searchKey === $key) {
                    $searchSessions[] = $value;
                }
            }
        }

        return $searchSessions;
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
     */
    public function set($key,$value)
    {
        Helper::isIndexStringOrInt($key);

        $this->values[$key] = $value;
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
            unset($this->values[$key]);
        }
    }

    public function clear()
    {
        $this->values = [];
    }
}