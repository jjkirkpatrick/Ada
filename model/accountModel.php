<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 02/03/2018
 * Time: 09:04 PM
 */

class accountModel extends model{


    public function getUser($username)
    {
      $sql = "SELECT users.*
              FROM   users
              where 
              name = :username";

        //Prepare the SQL query with the parametrized variable
        $query = $this->connection->prepare($sql);
        //Execute the query with the actual value substituted for the parameter variable
        $query->execute(array(':username' => $username));
        $result = $query->fetchAll();

        //Check to see if user is returned, if not return false.
        if ($query->rowCount() == 1) {
            return $result;
        }else{
            return false;
        }

    }

    public function insertUser($username, $pasword)
    {
        //Prepare the SQL query with the parametrized variable
        $query = $this->connection->prepare("INSERT INTO users
                                            (name, password, email)
                                            VALUES     (:username,:password,:email)");
        //Execute the query with the actual value substituted for the parameter variable
        $query->execute(array(':username' => $username, ':password' => $pasword, ':email' => "qwe@qwe.com"));
        $count = $query->rowCount();

        //Check to see if user is entered, if not return false.
        if ($count == 1) {
            return true;
        }else{
            return false;
        }
    }



}