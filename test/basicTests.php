<?php

$a = array('a','x','c','y','w');
$b = array('a','b','y','z');
$c = array_intersect($a, $b); // c contains ('a', 'y')

$result = array_diff($a, $c); // removed from a what is in c

print_r($c);
print_r($result);
