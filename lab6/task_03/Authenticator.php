<?php
class Authenticator
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function authenticate($username, $password): bool
    {
        $sql = "SELECT * FROM users WHERE email = '$username' LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }
        return false;
    }

}
?>
