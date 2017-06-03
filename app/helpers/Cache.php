<?php

namespace Griff;

use Doctrine\Common\Cache\FilesystemCache;

class Cache
{
  private static $instance;
  private $cache_driver;

  public static function get_instance()
  {
    if (!empty(self::$instance)) {
      return self::$instance;
    }

    return self::$instance = new Cache();
  }

  private function __construct()
  {
    $this->cache_driver = new FilesystemCache(
      __DIR__.'/../cache/'
    );
  }

  public function set($cache_id, $data, $lifetime = 0)
  {
    return $this->cache_driver->save($cache_id, $data, $lifetime);
  }

  public function get($cache_id)
  {
    if (!$this->cache_driver->contains($cache_id)) {
      return false;
    }
    return $this->cache_driver->fetch($cache_id);
  }
}