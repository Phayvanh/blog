<?php
include '../../../Autoload.php';

    $comment = new Model_Comment();
    $comment->createComment
        (
            $_POST['postId'],
            $_POST['contents'],
            $_POST['name'],
            $_POST['email'],
            $_POST['url']
        );

    header("Location: $wwwUrl/post/index.php?id=".$_POST['postId']);
    exit();

