<?php
  include '../db_config.php';
  // Connect
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn && $conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
    exit();
  }

  if(empty($_POST)){
    echo 'Si è verificato un errore';
    exit();
  }
  // recupero l'id della stanza da modificare dal paramentro in POST
  $id_stanza = intval($_POST['id']);

  $sql = "DELETE FROM stanze WHERE id = $id_stanza";

  $result = $conn->query($sql);

  include '../layout/head.php';
  include '../layout/header.php';
?>

<section class="show_single_room">
  <div class="container">
    <?php
    if($result){
    ?>
    <h2>Modifica avvenuta con successo </h2>
    <?php
    } else {
      echo '<h2>Si è verificato un errore</h2>';
    }
    $conn->close();
    ?>
    <a href="../index.php" class="card-link">Torna alla Home</a>
  </div>
</section>

<?php include '../layout/footer.php' ?>
