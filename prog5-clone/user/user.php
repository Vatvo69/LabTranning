<?php
require_once '../config/connect.php';

class User
{
    private $id;
    private $username;
    private $password;
    private $fullname;
    private $email;
    private $phone;
    private $role;
    private $avatar;

    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    function __construct7($username, $password, $fullname, $email, $phone, $role, $avatar)
    {
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
        $this->avatar = $avatar;
    }

    function __construct8($id, $username, $password, $fullname, $email, $phone, $role, $avatar)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
        $this->avatar = $avatar;
    }



    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFullName()
    {
        return $this->fullname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function getAll()
    {
        $rows = array();
        $conn = Database::connection();
        $query = "SELECT * FROM users";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_object($res)) {
                $user = new User($row->id, $row->username, $row->password, $row->fullname, $row->email, $row->phone, $row->role, $row->avatar);
                $rows[] = $user;
            }
        }

        return $rows;
    }

    public function save()
    {
        $conn = Database::connection();
        $username = $this->getUsername();
        $password = $this->getPassword();
        $fullname = $this->getFullName();
        $email = $this->getEmail();
        $phone = $this->getPhone();
        $role = $this->getRole();
        $avatar = $this->getAvatar();
        $query = "INSERT INTO users (username,password,fullname,email,phone,role,avatar) VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssss", $username, $password, $fullname, $email, $phone, $role, $avatar);
        $ret = $stmt->execute();
        $stmt->close();
        return $ret;
    }

    public function update()
    {
        $conn = Database::connection();
        $username = $this->getUsername();
        $password = $this->getPassword();
        $email = $this->getEmail();
        $phone = $this->getPhone();
        $avatar = $this->getAvatar();
        $query = "UPDATE users set password=?, email=?, phone=?, avatar=? where username=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $password, $email, $phone, $avatar, $username);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

}

?>