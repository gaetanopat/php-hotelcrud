<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="public/css/app.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css">
    <title></title>
  </head>
  <body>
    <h1>Visualizzazione Numero stanza e Piano</h1>
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $dbname = "hotel_db";
      // Connect
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn && $conn->connect_error) {
      echo ("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT room_number, floor FROM stanze";
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0) { ?>
        <table>
          <tr>
            <th>Numero stanza</th>
            <th>Piano</th>
          </tr>
      <?php // output data of each row
        while($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $row['room_number'] ?></td>
            <td><?php echo $row['floor']; ?></td>
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
  </body>
</html>
