<?php

include 'Global.php';

/* Code d'auto-chargement des fichiers de classes */
spl_autoload_register(function($class)
{
    include __DIR__.'/classes/'.str_replace('_','/',$class).'.class.php';
});