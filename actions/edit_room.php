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
  // dato che mi servirà per vedere se la stanza già esiste
  $stanza_iniziale = $_POST['stanza_iniziale'];
  // dato che mi servirà per il piano iniziale associato ad una stanza
  $floor_iniziale = intval($_POST['floor_iniziale']);

  // recupero i dati ricevuti in POST
  $id_stanza = intval($_POST['id']);
  $room_number = $_POST['room_number'];
  $floor = intval($_POST['floor']);
  $beds = intval($_POST['beds']);
  var_dump($stanza_iniziale);
  echo '<br>';
  var_dump($floor_iniziale);
  include '../layout/head.php';
  include '../layout/header.php';
?>

<section class="show_single_room">
  <div class="container">
    <?php
    // query che mi servirà per vedere se il numero della stanza già esiste
    $sql1 = "SELECT room_number FROM stanze";
    $result1 = $conn->query($sql1);
    // query che mi servirà per sapere il numero di stanze per piano
    $sql2 = "SELECT COUNT(*) FROM stanze WHERE floor = $floor";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_array();
    // prendo il risultato della query che sarà un intero
    $row2 = intval($row2[0]);

    if ($result1 && $result1->num_rows > 0) {
      while($row = $result1->fetch_assoc()){
        //  pusho in un array tutti i numeri stanza
        $array_stanze[] = $row['room_number'];
      }
    }

    // verifico che il valore di stanza_iniziale sia compreso nell'array
    if(in_array($stanza_iniziale, $array_stanze)){
      // rimuovo il valore passando ad unset la chiave dell'item
      // recuperata usando array_search
      unset($array_stanze[array_search($stanza_iniziale, $array_stanze)]);
    }
    // controllo che nell'array non ci sia un valore = $room_number che inserisco
    // Esempio: io voglio modificare solo i letti della stanza 100, quindi posso lasciare 100 e modificare il letto
    // Se voglio modificare il numero della stanza devo controllare che non ci sia già quindi faccio questo controllo, perchè se tipo
    // voglio usare la 101 che già esiste non posso, non possono esserci 2 stanze con lo stesso numero, quindi
    // devo usare una stanza con un numero diverso
    if(!in_array($room_number, $array_stanze)){
      // trasformo in int il valore di $room_number
      $room_number = intval($room_number);
      // per modificare tipo la stanza 100 piano 1 letti 2
      // visto che ho messo che le stanze per piano devono essere 6, se l'utente
      // vuole modificare questa stanza e metterla nel piano 2 per esempio
      // se nel piano 2 ci sono < 6 stanze allora può, altrimenti no
      // in più se vuole modificare tipo solo il numero dei letti quindi il piano deve rimanere invariato
      // può lo stesso mantenendo sempre lo stesso piano
      if(($floor == $floor_iniziale) || ($floor != $floor_iniziale && $row2 < 6)){
        // controllo che i dati siano giusti
        if($room_number != "" && $room_number > 0 && $floor != "" && $floor > 0 && $beds != "" && $beds > 0){
          $sql = "UPDATE stanze SET room_number = $room_number, floor = $floor, beds = $beds, updated_at = NOW() WHERE id = $id_stanza";

          $result = $conn->query($sql); ?>
          <h2>Modifica avvenuta con successo </h2>
    <?php
      } else {
        // se sbaglia a inserire dati
        echo '<h2>Hai sbagliato l\'inserimento, riprova</h2>'; ?>
        <a class="mt-3 mb-3" href="edit.php?id=<?php echo $id_stanza ?>" class="card-link">Rimodifica</a>
    <?php
      }
    } else {
      // se l'utente nell'inserimento ha inserito un piano diverso da quello iniziale
      // e quello inserito è pieno (quindi ha già 6 stanze per piano)
      echo '<h2>Il piano '.$floor.' è già pieno, riprova</h2>';
    }
    } else {
      // se inserisce un numero di stanza che già esiste
      echo '<h2>Hai inserito una stanza già esistente, riprova</h2>'; ?>
      <a class="mt-3 mb-3" href="edit.php?id=<?php echo $id_stanza ?>" class="card-link">Rimodifica</a>
    <?php
    }
    $conn->close();
    ?>
    <a href="../index.php" class="card-link">Torna alla Home</a>
  </div>
</section>

<?php include '../layout/footer.php' ?>
