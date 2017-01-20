<?php
require 'lib/functions.php';

if (isset($_POST['submit'])) {
    $post = api_call('http://localhost/slimfw-tutorial/api/testpost', 'post', $_POST);
    var_dump($post);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>

    <?php include 'menu.php'; ?>

    <h1>Tes post</h1>
    <form method="post">
        <p>Judul:</p>
        <p><input name="judul" /></p>

        <p>Isi:</p>
        <p><textarea name="isi"></textarea></p>

        <p><input name="submit" type="submit" /></p>
    </form>
</body>
</html>
