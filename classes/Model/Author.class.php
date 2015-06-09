<?php

class Model_Author
{
    /*********************************Methods**************************/
    public function listAll()
    {
        $sql = 'Select Id, FirstName, LastName From Author';

        $Database = new Infrastructure_Database();

        return $Database->query($sql);
    }
}