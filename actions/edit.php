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
    <h4>Modifica stanza numero: <?php echo $row['room_number'] ?> (ID: <?php echo $row['id'] ?>)</h4>

    <form action="edit_room.php" method="post">
      <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
      <input type="hidden" value="<?php echo $row['room_number'] ?>" name="stanza_iniziale">
      <input type="hidden" value="<?php echo $row['floor'] ?>" name="floor_iniziale">
      <div class="form-group row">
        <label class="col-5 col-form-label">Numero stanza: </label>
        <div class="col-7">
          <input type="number" class="form-control" placeholder="Inserisci numero stanza" name="room_number" value="<?php echo $row['room_number'] ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-5 col-form-label">Piano: </label>
        <div class="col-7">
          <input type="number" class="form-control" placeholder="Inserisci piano" name="floor" value="<?php echo $row['floor'] ?>">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-5 col-form-label">Numero letti: </label>
        <div class="col-7">
          <input type="number" class="form-control" placeholder="Inserisci numero letti" name="beds" value="<?php echo $row['beds'] ?>">
        </div>
      </div>
      <div class="form-group text-center">
        <input type="submit" value="Modifica" class="btn btn-primary mr-2">
        <a href="../index.php" class="btn btn-primary">Torna alla Home</a>
      </div>
    </form>
    <?php
      }
    } elseif ($result) {
      echo "0 results";
    } else {
      echo "query error";
    }
    $conn->close();
    ?>
  </div>
</section>


 <?php include '../layout/footer.php' ?>
