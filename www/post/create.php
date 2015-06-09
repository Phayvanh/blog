<?php
include '../../Autoload.php';


if(empty($_POST) == false)
{
    /***********************************mode Http POST*******************************************/
    $photoFileName = null;
    $photoTitle = null;

    if(array_key_exists('photo',$_FILES) == true)
    {
        //est ce que la photo à bien été uploader ?
        if($_FILES['photo']['error'] == 0)
        {
            //oui, extraction de l'extention du fichier
            $photoExtension = pathinfo($_FILES['photo']['name'],PATHINFO_EXTENSION);

            $photoFileName = uniqid('photo',true).'.'.$photoExtension;
            //uploader un fichier avec une chaine d'une longueur de 23 caractères

            $photoTitle = $_FILES['photo']['name'];
            //contient le nom du fichier original

            move_uploaded_file
            (//on déplace le nom du fichier temporaire dans le dossier de destination
                $_FILES['photo']['tmp_name'],
                "$wwwPath/images/photos/$photoFileName"
            );
        }
    }

    $post = new Model_Post();
    $post->createPost
        (
            $_POST['blog'],
            $_POST['author'],
            $_POST['category'],
            $_POST['title'],
            $_POST['contents'],
            $_POST['tags'],
            $photoFileName,
            $photoTitle
        );

    header("Location: $wwwUrl/index.php");
    exit();
}
else
{
    /***************************************mode Http GET******************************************/
    $author = new Model_Author();
    $authors = $author->listAll();

    $blog = new Model_Blog();
    $blogs = $blog->listAll();
    $blogTitle = $blog->getBlogTitle(BLOG_ID);

    $category = new Model_Category();
    $categories = $category->listAll();

    $theme = new Model_Theme();
    $stylesheet = $theme->getStylesheetForBlog(BLOG_ID);

    $template = 'create.phtml';

    include "$wwwPath/layout.phtml";
}

