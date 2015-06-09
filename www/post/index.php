<?php

include '../../Autoload.php';

if(array_key_exists('id',$_GET) == true)
{
    if(ctype_digit($_GET['id']) == true)//vérifie que la chaine donnée n'a que des chiffres
    {
        $post = new Model_Post();
        $posts = $post->find($_GET['id']);

        $tag = new Model_Tag();
        $taglist = $tag->listForPost($_GET['id']);

        $comment = new Model_Comment();
        $comments = $comment->listForPost($_GET['id']);

        $blog = new Model_Blog();
        $blogTitle = $blog->getBlogTitle(BLOG_ID);

        $theme = new Model_Theme();
        $stylesheet = $theme->getStylesheetForBlog(BLOG_ID);

        $template = 'index.phtml';

        include "$wwwPath/layout.phtml";
        exit();
    }
}
//sinon on pourrait afficher un template 404.phtml
