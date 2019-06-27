<?php
  include 'db_config.php';
  // Connect
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn && $conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
    exit();
  }

  $sql = "SELECT * FROM stanze";
  $result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css">
    <title></title>
  </head>
  <?php include 'layout/header.php'; ?>
  <body>
  <section class="show_all_rooms">
    <div class="container">
      <h3>Visualizzazione stanze hotel</h3>
      <?php
        if ($result && $result->num_rows > 0) { ?>
          <table>
            <tr>
              <th class="text-center">ID stanza</th>
              <th class="text-center">Numero stanza</th>
              <th class="text-center">Piano</th>
              <th class="text-center">Numero letti</th>
              <th class="text-center">Creata il</th>
              <th class="text-center">Aggiornata il</th>
              <th class="text-center">Actions</th>
            </tr>
        <?php // output data of each row
          while($row = $result->fetch_assoc()) { ?>
            <tr>
              <td class="text-center"><strong><?php echo $row['id'] ?></strong></td>
              <td class="text-center"><?php echo $row['room_number'] ?></td>
              <td class="text-center"><?php echo $row['floor']; ?></td>
              <td class="text-center"><?php echo $row['beds']; ?></td>
              <td class="text-center"><?php echo $row['created_at']; ?></td>
              <td class="text-center"><?php echo $row['updated_at']; ?></td>
              <td class="text-center"><a href="actions/show.php?id=<?php echo $row['id'] ?>">Visualizza</a> - <a href="actions/edit.php?id=<?php echo $row['id'] ?>">Modifica</a></td>
            </tr>
        <?php } ?>
          </table>
        <?php
        } elseif ($result) {
          echo "0 results";
        } else {
          echo "query error";
        }

        $conn->close();
      ?>
    </div>
  </section>

<?php include 'layout/footer.php' ?>
