<?php
  include '../layout/head.php';
  include '../layout/header.php';
?>

<section class="show_single_room">
  <div class="container">
    <h4>Creazione nuova stanza</h4>

    <form action="create_room.php" method="post">
      <div class="form-group row">
        <label class="col-5 col-form-label">Numero stanza: </label>
        <div class="col-7">
          <input type="number" class="form-control" placeholder="Inserisci NUM stanza" name="room_number">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-5 col-form-label">Piano: </label>
        <div class="col-7">
          <input type="number" class="form-control" placeholder="Inserisci piano" name="floor">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-5 col-form-label">Numero letti: </label>
        <div class="col-7">
          <input type="number" class="form-control" placeholder="Inserisci numero letti" name="beds">
        </div>
      </div>
      <div class="form-group text-center">
        <input type="submit" value="Crea" class="btn btn-primary mr-2">
        <a href="../index.php" class="btn btn-primary">Torna alla Home</a>
      </div>
    </form>
  </div>
</section>


 <?php include '../layout/footer.php' ?>
