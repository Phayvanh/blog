<?php

include '../../Autoload.php';

$blog = new Model_Blog();
$blog->updateTheme($_POST['blogId'],$_POST['themeId']);