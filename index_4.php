<?php

/**
 * Interface I
 */
interface I
{
    /**
     * @param $key
     * @param $value
     * @param null $expire
     * @return mixed
     */
    public function put($key, $value, $expire = null);

    /**
     * @param $key
     * @return mixed
     */
    public function get($key);
}

/**
 * Class C
 */
abstract class C implements I
{
    /**
     * @var string
     */
    public $file_name = 'cache.txt';

    /**
     * @var
     */
    public $cache;

    public function __construct()
    {
        if (is_writable($this->file_name)) {
            $this->cache = file($this->file_name);

        } else {
            die( 'File not exist or bad permission');
        }
    }

    /**
     * @param $key
     * @param $value
     * @param null $expire
     * @return bool
     */
    public function put($key, $value, $expire = null)
    {
        foreach ($this->cache as $fkey => $cache) {
            $arr = explode(';', $cache);
            if (isset($arr) && $arr[0] == $fkey) {
                unset($this->cache[$fkey]);
            }
        }
        $this->cache[] = $key . ';' . $expire . ';' . $value;
        file_put_contents($this->file_name, implode("", $this->cache));
        return true;
    }

    /**
     * @param $key
     * @return bool
     */
    public function get($key)
    {
        foreach ($this->cache as $key => $cache) {
            $arr = explode(';', $cache);
            if (isset($arr) && $arr[0] == $key && ($arr[1] + 30) >= time()) {

                return $arr[2];

            }
        }
        return false;
    }
}

/**
 * Class myClass - realization cache
 */
class myClass extends C
{
    function index()
    {
        if (($random = $this->get('random')) !== false) {
            return $random;
        } else {
            $foo = rand(100000, 999999);
            $this->put('random', $foo, time()+30);
            return $foo;
        }
    }
}

$foo = new myClass();
echo 'super code does change every 30 sec:' . $foo->index();