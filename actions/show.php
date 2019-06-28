<?php
  include '../db_config.php';
  // Connect
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn && $conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
    exit();
  }
  // recupero l'id della stanza da modificare dal paramentro in GET
  $id_stanza = intval($_GET['id']);

  $sql = "SELECT * FROM stanze WHERE id = $id_stanza";

  $result = $conn->query($sql);

  include '../layout/head.php';
  include '../layout/header.php';
?>

<section class="show_single_room">
  <div class="container">
    <?php
      if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
    ?>
    <div class="card" style="width: 19rem;">
      <div class="card-body">
        <h5 class="card-title">Stanza numero: <?php echo $row['room_number'] ?></h5>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>ID stanza:</strong> <?php echo $row['id'] ?></li>
        <li class="list-group-item"><strong>Piano:</strong> <?php echo $row['floor'] ?></li>
        <li class="list-group-item"><strong>Numero letti:</strong> <?php echo $row['beds']; ?></li>
        <li class="list-group-item"><strong>Creata il:</strong> <?php echo $row['created_at']; ?></li>
        <li class="list-group-item"><strong>Aggiornata il:</strong> <?php echo $row['updated_at']; ?></li>
      </ul>
      <div class="card-body">
        <a href="edit.php?id=<?php echo $row['id'] ?>" class="card-link">Modifica stanza</a>
        <a href="../index.php" class="card-link">Torna alla Home</a>
      </div>
    </div>
    <?php }
      } elseif ($result) {
        echo "0 results";
      } else {
        echo "query error";
      }
    ?>
  </div>
</section>

<?php include '../layout/footer.php' ?>
