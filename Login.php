<?php
//List with the accepted users
$user_list = [
    1 => ["name" => "Pepe", "password" => "123passPepe"],
    2 => ["name" => "Maria", "password" => "MariaLoginPass"],
    3 => ["name" => "Marco", "password" => "321Marco"],
    4 => ["name" => "Alba", "password" => "Alba_Pass123"],
    5 => ["name" => "Admin", "password" => "AdminPassABC123."]
];

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkUser($name, $pass, $list)
{
    foreach ($list as $user => $data) {
        if ($name == $data["name"] && $pass == $data["password"]) {
            $user = $name;
            return $user;
        }
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = test_input($_POST["name"]);
    $userPass = test_input($_POST["password"]);

    $user = checkUser($userName, $userPass, $user_list);

    if ($user == false) {
        $err = true;
        $user = "none";
    } else {
        session_start();
        $_SESSION['user'] = $user;
        header("Location: Home.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="./styles/loginStyle.css">
</head>

<body>
    <h1>Login</h1>
    <?php
    if (isset($err) && $err == true) {
        echo '<p class="err"> The user or the password are wrong, please introduce a valid login to continue</p>';
    }


    if (isset($_GET["redirected"]) && $_GET["redirected"] == true) {
        echo '<p> You have logged out!</p>';
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="field">
            User name:
            <input type="text" name="name">
            <p class="err">*</p><br>
        </div>

        <div class="field">
            Password:
            <input type="password" name="password">
            <p class="err">*</p><br><br>
        </div>
        <br>

        <div class="field">
            <input type="radio" name="rememberPass">Remember password
        </div>
        <br><br>

        <input type="submit" name="confirm" value="Login">
    </form>


    <footer>
        <p>Login page</p>
    </footer>



</body>

</html>