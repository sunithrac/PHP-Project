<?php
$plainPassword = "mypassword";
$hashedPassword = '$2y$10$abcdefghijklmnopqrstuv';
echo $hash = password_hash($plainPassword, PASSWORD_BCRYPT);
echo "<br>";
if (password_verify($plainPassword, $hashedPassword)) {
    echo "Password is correct";
} else {
    echo "Invalid password";
}
?>
