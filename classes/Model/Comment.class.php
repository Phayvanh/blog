<?php

class Model_Comment
{
    public function createComment($postId, $contents, $name, $email, $website)
    {
        $sql = 'INSERT INTO Comment(Post_Id,Contents,Name,Email,WebsiteUrl,CreationTimestamp)
                VALUES(?,?,?,?,?,now())';

        $Database = new Infrastructure_Database();

        $values =
            [
                $postId,
                $contents,
                $name,
                $email,
                $website
            ];

        $Database->executeSql($sql, $values);
    }

    public function listForPost($postId)
    {
        $sql = 'SELECT Post_Id, Contents, Name, Email, WebsiteUrl,DATE_fORMAT(Creationtimestamp,"%d-%m-%y à %Hh%i") as Timestamp
                FROM Comment
                WHERE Post_Id = ?
                ORDER BY Creationtimestamp desc';

        $Database = new Infrastructure_Database();

        return $Database->query($sql,array($postId));
    }

}