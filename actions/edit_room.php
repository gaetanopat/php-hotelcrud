<?php
  include '../db_config.php';
  // Connect
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn && $conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
    exit();
  }
  if(empty($_POST)) {
    echo "si è verificato un errore";
    exit();
  }
  // recupero i dati ricevuti in POST
  $id_stanza = intval($_POST['id']);
  $room_number = intval($_POST['room_number']);
  $floor = intval($_POST['floor']);
  $beds = intval($_POST['beds']);

  include '../layout/head.php';
  include '../layout/header.php';
?>
  <section class="show_single_room">
    <div class="container">
      <?php // controllo che i dati siano giusti
      if($room_number != "" && $room_number > 0 && $floor != "" && $floor > 0 && $beds != "" && $beds > 0){
        $sql = "UPDATE stanze SET room_number = $room_number, floor = $floor, beds = $beds, updated_at = NOW() WHERE id = $id_stanza";

        $result = $conn->query($sql); ?>
        <h2>Modifica avvenuta con successo </h2>
      <?php
      } else {
        echo '<h2>Hai sbagliato l\'inserimento, riprova</h2>';?>
        <a class="mt-3 mb-3" href="edit.php?id=<?php echo $id_stanza ?>" class="card-link">Rimodifica</a>
      <?php } ?>
      <a href="../index.php" class="card-link">Torna alla Home</a>
    </div>
  </section>

<?php include '../layout/footer.php' ?>
