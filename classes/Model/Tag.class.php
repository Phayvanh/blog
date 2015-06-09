<?php

class Model_Tag
{
    public function createTags($postId, $tagList)
    {
        $tags = explode(",",$tagList);

        $Database = new Infrastructure_Database();

        $tagIds = array();

        foreach($tags as $tag)
        {
            $sql = "INSERT INTO Tag(Name)
                    VALUES (?)";

            $tagId = $Database->executeSql($sql, array($tag));
            array_push($tagIds,$tagId);
            //on récupère dans un nouveau tableau les Ids des différent Tag
        }

        foreach($tagIds as $tagId)
        {//on parcours le tableau des tags pour récupèrer les Ids de chaque Tag
            $sql = "INSERT INTO Post_Tag(Post_Id, Tag_Id)
                    VALUES (?,?)";

            $values = [$postId,$tagId];

            $Database->executeSql($sql, $values);
        }
    }

    public function listForPost($postId)
    {
        $sql = 'Select Name
                From Tag
                INNER JOIN Post_Tag on Tag.Id = Post_Tag.Tag_Id
                WHERE Post_Id = ?';

        $Database = new Infrastructure_Database();

        $tags = array();

        foreach($Database->query($sql, array($postId)) as $tag)
        {
            array_push($tags,$tag['Name']);
        }

        return  implode(', ', $tags);


    }
}