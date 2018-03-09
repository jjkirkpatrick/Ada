<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 02/03/2018
 * Time: 09:04 PM
 */

class authModel extends model{


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
        $result = $query->fetch(PDO::FETCH_ASSOC);

        //Check to see if user is returned, if not return false.
        if ($query->rowCount() == 1) {
            return $result;
        }else{
            return false;
        }

    }

    public function insertUser($username, $pasword,$email)
    {
        $sql = "INSERT INTO users
                                            (name, password, email)
                                            VALUES     (:username,:password,:email)";


        //Prepare the SQL query with the parametrized variable
        $query = $this->connection->prepare($sql);
        //Execute the query with the actual value substituted for the parameter variable
        $query->execute(array(':username' => $username, ':password' => $pasword, ':email' => $email));

        $count = $query->rowCount();

        //Check to see if user is entered, if not return false.
        if ($count == 1) {
            return true;
        }else{
            return false;
        }
    }

    public function getProfile($username)
    {

        $sql = "SELECT
                  users.id,
                  profile.firstName,
                  profile.middleName,
                  profile.surname,
                  profile.height,
                  profile.weight,
                  profile.systolicBloodPressure,
                  profile.diastolicBloodPressure
              FROM
                  users
              INNER JOIN profile ON users.id = profile.userID
              WHERE
                  users.name = :username";

        //Prepare the SQL query with the parametrized variable
        $query = $this->connection->prepare($sql);
        //Execute the query with the actual value substituted for the parameter variable
        $query->execute(array(':username' => $username));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        //Check to see if user is returned, if not return false.
        if ($query->rowCount() == 1) {
            return $result;
        }else{
            return false;
        }

    }


     public function updateProfile($username, $userID, $firstName, $middleName, $surname, $height, $weight, $systolic, $diastolic) {
            if($this->getProfile($username)){
                $sql = "
              UPDATE profile
              SET
                  firstName = :firstName,
                  middleName = :middleName,
                  surname = :surname,
                  height = :height,
                  weight = :weight,
                  systolicBloodPressure = :systolic,
                  diastolicBloodPressure = :diastolic
              WHERE
                  userID = :userID
            ";

                //Prepare the SQL query with the parametrized variable
                $query = $this->connection->prepare($sql);

                $query->execute(array(
                    ':firstName' => $firstName,
                    ':middleName' => $middleName,
                    ':surname' => $surname,
                    ':height' => $height,
                    ':weight' => $weight,
                    ':systolic' => $systolic,
                    ':diastolic' => $diastolic,
                    ':userID' => $userID
                ));

                $count = $query->rowCount();
                //Check to see if user is entered, if not return false.
                if ($count == 1) {
                    return true;
                }else{
                    return false;
                }
            }else{
                return $this->createProfile($userID, $firstName, $middleName, $surname, $height, $weight, $systolic, $diastolic);
            }
    }


    public function createProfile($userID, $firstName, $middleName, $surname, $height, $weight, $systolic, $diastolic)
    {
        $sql = "
            INSERT INTO profile(
            userID,
            firstName,
            middleName,
            surname,
            height,
            weight,
            systolicBloodPressure,
            diastolicBloodPressure)
            VALUES (
            :userID,
            :firstName,
            :middleName,
            :surname,
            :height,
            :weight,
            :systolic,
            :diastolic)
            ";


        //Prepare the SQL query with the parametrized variable
        $query = $this->connection->prepare($sql);
        //Execute the query with the actual value substituted for the parameter variable
        $query->execute(array(
            ':userID' => $userID,
            ':firstName' => $firstName,
            ':middleName' => $middleName,
            ':surname' => $surname,
            ':height' => $height,
            ':weight' => $weight,
            ':systolic' => $systolic,
            ':diastolic' => $diastolic,
        ));

        $count = $query->rowCount();

        //Check to see if user is entered, if not return false.
        if ($count == 1) {
            return true;
        }else{
            return false;
        }
    }

}