<?php

class Model_Category
{
    /*********************************Methods**************************/
    public function listAll()
    {
        $sql = 'Select Id, Name From Category';

        $Database = new Infrastructure_Database();

        return $Database->query($sql);
    }
}