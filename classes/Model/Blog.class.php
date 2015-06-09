<?php

class Model_Blog
{
    /*********************************Methods**************************/
    public function listAll()
    {
        $sql = 'Select Id, Title, Description, Logo From Blog';

        $Database = new Infrastructure_Database();

        return $Database->query($sql);
    }

    public function getBlogTitle($id)
    {
        $sql = 'SELECT Title FROM Blog WHERE Id = ?';

        $Database = new Infrastructure_Database();

        $blog = $Database->queryOne($sql,array($id));

        return $blog['Title'];
    }

    public function getBlogTheme($id)
    {
        $sql = 'SELECT Theme_Id FROM Blog WHERE Id = ?';

        $Database = new Infrastructure_Database();

        $blog = $Database->queryOne($sql,array($id));

        return $blog['Theme_Id'];
    }

    public function updateTheme($blogId, $themeId)
    {
        $Database = new Infrastructure_Database();

        $sql = 'UPDATE Blog
                SET Theme_Id = ?
                WHERE Id = ?';

        $value = [$themeId,$blogId];

        $Database->executeSql($sql,$value);
    }
}