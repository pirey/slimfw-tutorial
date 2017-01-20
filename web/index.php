<?php
require 'lib/functions.php';
$list = api_call('http://localhost/slimfw-tutorial/api/test');

$list = json_decode($list, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>

    <?php include 'menu.php'; ?>

    <h1>List</h1>
    <ul>
    <?php foreach ($list as $item) : ?>
    <li>
      <?php echo $item['judul']; ?>
      <p><?php echo $item['isi']; ?></p>
    </li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
