<link rel="stylesheet" href="style.css">

<?php echo $_SERVER['PHP_SELF']; ?>

<?php
    if (isset($message)) {
        foreach ($message as $msg) {  // Avoid reusing the same variable
            echo '<p class="message">' . $msg . '</p>';  // Fixed closing tag
        }
    }
?>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'contact-db')
or die('connection failed');

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $date = $_POST['date'];

    // Correct SQL statement
    $insert = mysqli_query($conn, "INSERT INTO `contact_form` (`name`, `email`, `number`, `date`) 
                                   VALUES ('$name', '$email', '$number', '$date')")
    or die('query failed');

    if ($insert) {
        $message[] = 'Appointment made successfully';
    } else {
        $message[] = 'Appointment failed';
    }
}


