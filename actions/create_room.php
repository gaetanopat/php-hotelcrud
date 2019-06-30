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
  $room_number = intval($_POST['room_number']);
  $floor = intval($_POST['floor']);
  $beds = intval($_POST['beds']);

  include '../layout/head.php';
  include '../layout/header.php';
?>


<section class="show_single_room">
  <div class="container">
    <?php
    // query che mi servirà per vedere se il numero della stanza già esiste
    $sql1 = "SELECT * FROM stanze WHERE room_number = $room_number";
    $result1 = $conn->query($sql1);
    // query che mi servirà per sapere il numero di stanze per piano
    $sql2 = "SELECT COUNT(*) FROM stanze WHERE floor = $floor";
    $result2 = $conn->query($sql2);
    $row = $result2->fetch_array();
    $row = intval($row[0]);
    // controllo che la stanza non esista già
    if($result1->num_rows == 0){
      // controllo che le stanze per piano siano < 6
      if($row < 6){
        // controllo che i dati siano giusti
        if($room_number != "" && $room_number > 0 && $floor != "" && $floor > 0 && $beds != "" && $beds > 0){
          $sql = "INSERT INTO stanze (room_number, floor, beds, created_at, updated_at) VALUES ($room_number, $floor, $beds, NOW(), NOW())";

          $result = $conn->query($sql); ?>
          <h2>Modifica avvenuta con successo </h2>
    <?php
        // se l'utente sbaglia a inserire qualche dato
        } else {
          echo '<h2>Hai sbagliato l\'inserimento, riprova</h2>'; ?>
          <a class="mt-3 mb-3" href="create.php" class="card-link">Rimodifica</a>
    <?php
        }
      // se le stanze per piano sono > 6
      } else {
        echo '<h2>Massimo 6 stanze per piano, il piano '.$floor.' è pieno, riprova</h2>'; ?>
        <a class="mt-3 mb-3" href="create.php" class="card-link">Rimodifica</a>
    <?php
      }
    // se il numero della stanza già esiste
    } else {
        echo '<h2>Questa stanza già esiste, cambia il numero</h2>'; ?>
        <a class="mt-3 mb-3" href="create.php" class="card-link">Rimodifica</a>
    <?php
    }
    $conn->close();
    ?>
    <a href="../index.php" class="card-link">Torna alla Home</a>
  </div>
</section>

<?php include '../layout/footer.php' ?>
