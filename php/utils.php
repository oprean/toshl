<?php
require_once 'CVarDumper.php';
require_once 'CJSON.php';
function dump($target, $depth=10, $highlight = true)
{
	echo CVarDumper::dumpAsString($target, $depth, $highlight);
}
?>