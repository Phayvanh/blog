<?php

class Model_Theme
{
    /*********************************Methods**************************/
    public function listAll()
    {
        $sql = 'Select Id, Name, Stylesheet From Theme';

        $Database = new Infrastructure_Database();

        return $Database->query($sql);
    }

    public function getStylesheetForBlog($blogId)
    {
        $sql = 'SELECT Stylesheet
                FROM Theme
                INNER JOIN Blog ON Blog.Theme_Id = Theme.Id
                WHERE Blog.Id =1';

        $Database = new Infrastructure_Database();

        $theme = $Database->queryOne($sql,array($blogId));

        return $theme['Stylesheet'];
    }
}