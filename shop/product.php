<?php
session_start();
if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    header("location: login.php");
    exit;
}
if (isset($_GET['id'])) {

    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);

    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {

        exit('Product does not exist!');
    }
} else {

    exit('Product does not exist!');
}
?>
<?=template_header('Product')?>

<div class="product content-wrapper">

    <img src="imgs/<?=$product['img']?>" width="500" height="500" alt="<?=$product['name']?>">

    <?php if ($_SESSION['usertype'] == 0): ?>
        <form action="" method="post">
        <input type="text" name="newname" class="name" value= <?=$product['name']?> >
        <br/>
        <span class="price">
        Preis:<br/>
            <input type="number" name="newprice" value = <?=$product['price']?>>
        </span>
        <br/>
        <span class="price">
            Aktueller Stand: <input type="number" name="newqty" value= <?=$product['quantity']?>  >
        </span>
        <?php endif;?>
    <div>




        <?php if ($_SESSION['usertype'] == 1): ?>
        <h1 class="name"><?=$product['name']?></h1>
        <span class="price">
            &euro;<?=$product['price']?>
        </span>
        <form action="index.php?page=cart" method="post">
        <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
        <input type="hidden" name="product_id" value="<?=$product['id']?>">
        <input type="submit" value="Add To Cart">

          <?php endif;?>

            <?php if ($_SESSION['usertype'] == 0): ?>
            <input type="submit" value="Produkt ändern">
            <?php endif;?>
         </form>

         <?php if ($_SESSION['usertype'] == 0): ?>
         <br/>
        <div class="description">
           <textarea rows="9" cols="50" name="newdesc"> <?=$product['desc_']?> </textarea>
        </div>
        <?php elseif ($_SESSION['usertype'] == 1): ?>
            <div class="description">
            <?=$product['desc_']?>
        </div>
        <?php endif;?>


        <?php if (isset($_POST['newprice'])): ?>
       <?php $stmt = $pdo->prepare('UPDATE shop.products SET name=?, desc_=?, price=?, quantity=? where id=?');

$stmt->bindValue(1, $_POST['newname'], PDO::PARAM_STR);
$stmt->bindValue(2, $_POST['newdesc'], PDO::PARAM_STR);
$stmt->bindValue(3, $_POST['newprice'], PDO::PARAM_INT);
$stmt->bindValue(4, $_POST['newqty'], PDO::PARAM_INT);
$stmt->bindValue(5, $product['id'], PDO::PARAM_INT);
$stmt->execute();
header("Refresh:0");

?>
<div> <h1> Produkt aktualisiert!</h1>
<?php endif;?>
    </div>

</div>

<?=template_footer()?>



