<?=template_header('Home')?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" method="post" action="">
<fieldset>

<!-- Form Name -->
<legend>Neues Produkt</legend>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_name">Produktname</label>
  <div class="col-md-4">
  <input id="product_name" name="product_name" placeholder="Produktname" class="form-control input-md" required="" type="text">

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="product_name_fr">Produktbeschreibung(HTML)</label>
  <div class="col-md-4">
  <textarea id="product_name_fr" col="4" rows="10" name="product_desc" placeholder="Produktbeschreibung (HTML)" class="form-control input-md" required="" >
    </textarea>
  </div>
</div>



<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" for="price">Preis</label>
  <div class="col-md-4">
  <input id="price" name="product_price" placeholder="Quantität" min="1" max="10000" class="form-control input-md" required="" type="number">

  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="available_quantity">Quantität</label>
  <div class="col-md-4">
  <input id="available_quantity" name="available_quantity" placeholder="Quantität" min="1" max="1000" class="form-control input-md" required="" type="number">

  </div>
</div>


 <!-- File Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">Produktfoto</label>
  <div class="col-md-4">
    <input id="filebutton" name="filebutton" class="input-file" type="file">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton">Hinzufügen</label>
  <div class="col-md-4">
    <input type="submit" value="Hinzufügen" class = "btn btn-primary">
  </div>
  </div>
  <?php if (isset($_POST['product_name'])): ?>

<?php
$stmt = $pdo->prepare('INSERT INTO shop.products SET name=?, desc_=?, price=?, quantity=?, img=?');

$stmt->bindValue(1, $_POST['product_name'], PDO::PARAM_STR);
$stmt->bindValue(2, $_POST['product_desc'], PDO::PARAM_STR);
$stmt->bindValue(3, $_POST['product_price'], PDO::PARAM_INT);
$stmt->bindValue(4, $_POST['available_quantity'], PDO::PARAM_INT);
$stmt->bindValue(5, $_POST['filebutton'], PDO::PARAM_STR);
$stmt->execute();
?>

  <div class="form-group">
  <h1 class="col-md-4 control-label" for="singlebutton">Produkt hinzugefügt!</h1>
  </div>
  <?php endif;?>
</fieldset>

</form>

<?=template_footer()?>

