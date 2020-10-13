<?php session_start();
require_once('../inc/login.inc.php'); ?>
<?php
/**
 * Anmeldung
 */
if (isset($_GET['login'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));
    //Benutzereingaben validieren
    if (!empty($username) && !empty($password)) {
        // $hash = $con->query("SELECT password FROM user WHERE username = $username");
        $query = $con->prepare("SELECT username, password FROM user WHERE username = ?");
        // $password = password_hash($password, PASSWORD_DEFAULT);
        $query->bind_param("s", $username);
        $query->execute();
        $query->bind_result($username, $passwordDB);
        $query->store_result();
        if ($query->num_rows() == 1) {
            if ($query->fetch()) {
                if (password_verify($password, $passwordDB)) {
                    $_SESSION['username'] = $username;
                    //redirect to index.php
                    header("Location: ../index.php");
                }
            }
        } else {
            header("Location: ../index.php");
            $error = 'Ihre Anmeldedaten sind nicht korrekt. Bitte wiederholen Sie den Vorgang.';
            echo $error;
        }
    } else {
        header("Location: ../index.php");
        $error = "Bitte f&uuml;llen Sie alle Felder aus.";
        echo $error;
    }
} else {
    $error = NULL;
    $username = NULL;
}
?>