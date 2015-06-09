<?php

include 'Global.php';

spl_autoload_register(function($class)
{
    include __DIR__.'/classes/'.str_replace('_','/',$class).'.class.php';
});