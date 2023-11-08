<?php
//This snippet will print out all the cached elements (foreach) .

$cache  = new CachingIterator(new ArrayIterator(range(1, 100)), CachingIterator::FULL_CACHE);

foreach ($cache as $c) {
}

print_r($cache->getCache());
