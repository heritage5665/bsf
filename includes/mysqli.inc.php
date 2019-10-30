<?php
// set database access information as constants
define('DB_USER', 'root'); //db username
define('DB_PASSWORD', ''); //database password
define('DB_HOST', 'localhost'); //host name
define('DB_NAME', 'bsf'); //data base name 

function connect()
{
    try {
        $dbh = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
        );
        return $dbh;
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
}
function insertAttentdant(PDO $dbh, $values)
{
    try {

        var_dump($values);
        $sql = "INSERT INTO `attendants` (`full_name`, `phone_num`, `email`,
     `suggestions`,`attending`, `reminder`, `church`)
     VALUES (:name,:phone,:email,:suggestion,:attending,:reminder,:church)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $values['name'], PDO::PARAM_STR);
        $query->bindParam(':phone', $values['phone'], PDO::PARAM_STR);
        $query->bindParam(':attending', $values['attending'], PDO::PARAM_STR);
        $query->bindParam(':email', $values['email'], PDO::PARAM_STR);
        $query->bindParam(':suggestion', $values['suggestion'], PDO::PARAM_STR);
        $query->bindParam(':reminder', $values['reminder'], PDO::PARAM_STR);
        $query->bindParam(':church', $values['church'], PDO::PARAM_STR);
        if ($query->execute()) {
            "echo <h1> inserted</h1>";
        } else {
            echo "<h1> not inserted</h1>";
        }
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo 'Error' . $e->getMessage();
    }
}

function getAttendants(PDO $dbh)
{

    $sql = "SELECT id,full_name,email,phone_num,suggestions, attending, church FROM attendants";
    $query = $dbh->prepare($sql);

    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    if ($query->rowCount() > 0) {
        return $results;
    } else {
        header('location:login.php');
    }
}

function login(PDO $dbh, $data)
{
    $sql = "SELECT id FROM users WHERE usr_name=:email AND pswd=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $data['email'], PDO::PARAM_STR);
    $query->bindParam(':password', $data['password'], PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_NUM);
    if ($query->rowCount() == 1) {
        $_SESSION['user_id'] = $results[0];
        header('location:admin.php');
    } else {
        echo "<h1>we are soory</h1><p>but you entered a wrong password or usrname</p>
      <p>click here to  <a href='login.php'>login again </a> ";
    }
}
