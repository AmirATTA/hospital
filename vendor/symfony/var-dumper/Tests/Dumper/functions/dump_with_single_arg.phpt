--TEST--
Test dump() with one arg doesn't show line number
--FILE--
<?php
putenv('NO_COLOR=1');

$vendor = __DIR__;
while (!file_exists($vendor.'/vendor')) {
    $vendor = \dirname($vendor);
}
require $vendor.'/vendor/autoload.php';

dump('foo');

--EXPECT--
"foo"
