<?php


class Model_Post
{
    /***********************************Methods*********************************************/
    public function createPost($blogId, $authorId, $categoryId, $title, $contents, $tagList, $Photo, $PhotoTitle)
    {
       $sql = 'INSERT INTO Post(Blog_Id,Author_Id,Category_Id,Title,Contents,CreationTimestamp,photo, photoTitle)
         VALUES(?,?,?,?,?,now(),?,?)';

        $Database = new Infrastructure_Database();

        $values =
        [
            $blogId,
            $authorId,
            $categoryId,
            $title,
            $contents,
            $Photo,
            $PhotoTitle
        ];

        $postId = $Database->executeSql($sql, $values);


        if(empty($tagList) == false)
        {
            $tag = new Model_Tag();
            $tag->createTags($postId,$tagList);
        }
    }

    public function listForBlog($id, $page =1)
    {
        $cursor=($page-1) * 5;

        $sql = "SELECT Post.Blog_Id,
                       Post.Id,
                       Category.Name as Category_Name,
                       Author.LastName,
                       Author.FirstName,
                       Post.Title,
                       Post.Contents,
                       DATE_fORMAT(Post.Creationtimestamp,'%d-%m-%y à %Hh%i') as Timestamp,
                       COUNT(Comment.Id) as CommentCount
                FROM Post
                INNER JOIN Author ON Author.Id = Post.Author_Id
                INNER JOIN Category ON Category.Id = Post.Category_Id
                LEFT JOIN Comment ON Comment.Post_Id = Post.Id
                GROUP BY Post.Id,
                       Category_Name,
                       Author.LastName,
                       Author.FirstName,
                       Post.Title,
                       Post.Contents,
                       Timestamp
                HAVING Post.Blog_Id = ?
                ORDER BY Post.Creationtimestamp desc
                LIMIT $cursor, 5";
        //si on fait un HAVING on est obliger de faire le SELECT de la colonne
       //LEFT JOIN Cela permet de lister tous les résultats de la table de gauche (left = gauche) même s’il n’y a pas de correspondance dans la deuxième tables

        $Database = new Infrastructure_Database();

        return $Database->query($sql,array($id));
    }

    public function find($id)
    {
        $sql = 'SELECT Post.Id,
                       Post.Category_Id,
                       Name as Category_Name,
                       Post.Author_Id,
                       LastName,
                       FirstName,
                       Title,
                       Photo,
                       PhotoTitle,
                       Contents,
                       DATE_fORMAT(Creationtimestamp,"%d-%m-%y à %Hh%i") as Timestamp,
                       UpdateTimestamp
                FROM Post
                INNER JOIN Author ON Author.Id = Post.Author_Id
                INNER JOIN Category ON Category.Id = Post.Category_Id
                WHERE Post.Id = ?
                ORDER BY Creationtimestamp desc';

        $Database = new Infrastructure_Database();

        $post = $Database->queryOne($sql,array($id));

        return $post;
    }

    public function countForBlog($blogId)
    {
        $sql = 'SELECT count(Id) as PostCount
                FROM Post
                WHERE Blog_Id = ?';

        $Database = new Infrastructure_Database();

        $result = $Database->queryOne($sql, array($blogId));

        return $result['PostCount'];
    }
}