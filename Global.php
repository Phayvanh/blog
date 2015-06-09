<?php

$wwwPath = __DIR__.'/www';//chemin sur le disque dur vers le dossier publique de l'application

$wwwUrl = '/'.substr($wwwPath,strlen($_SERVER['DOCUMENT_ROOT']));
//url vers le dossier publique de l'application

const BLOG_ID = 1;

const DATABASE_DSN = 'mysql:host=localhost;dbname=blog';
const DATABASE_USER = 'root';
const DATABASE_PASSWORD = '';

