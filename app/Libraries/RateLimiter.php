<?php
namespace App\Libraries;

use CodeIgniter\Cache\CacheInterface;

class RateLimiter
{
    protected $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function limit($key, $maxAttempts = 10, $decayMinutes = 1)
    {
        $key = 'ratelimit_' . md5($key);
        $attempts = $this->cache->get($key) ?? 0;

        if ($attempts >= $maxAttempts) {
            return false;
        }

        $this->cache->save($key, $attempts + 1, $decayMinutes * 60);
        return true;
    }
}