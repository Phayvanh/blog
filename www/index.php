<?php
/*********************************Accueil**********************/
include '../Autoload.php';
//nous somme sur la page d'accueil par defaut !
$page = 1;

//on récupère ensuite le numéro de page dans la query string
if(array_key_exists('page',$_GET) == true)
{
    if(ctype_digit($_GET['page']) == true)
    {
        $page = $_GET['page'];
    }
}
$post = new Model_Post();
$pagePrevious = $page -1;
if($pagePrevious < 1)
{
    $pagePrevious = 1;
}

$pageNext = $page +1;
$pageMax = ceil($post->countForBlog(BLOG_ID)/5);
if($pageNext > $pageMax)
{
    $pageNext = $pageMax;
}


//on récupère les informations du blog
$blog = new Model_Blog();
$blogTitle = $blog->getBlogTitle(BLOG_ID);
$blogtheme = $blog->getBlogTheme(BLOG_ID);

//on récupère les articles du blog
$posts = $post->listForBlog(BLOG_ID,$page);

//themes du blog et récupération des feuilles de styles
$theme = new Model_Theme();
$themes = $theme->listAll();
$stylesheet = $theme->getStylesheetForBlog(BLOG_ID);

//on affiche la vue
$template = 'index.phtml';
include "$wwwPath/layout.phtml";