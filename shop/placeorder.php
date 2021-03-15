<?php
session_start();
foreach ($_SESSION['cart'][$_SESSION['id']] as $productid => $qty) {
    $stmt = $pdo->prepare('UPDATE shop.products set quantity = quantity - ? where id = ?');
    $stmt->bindValue(1, $qty, PDO::PARAM_INT);
    $stmt->bindValue(2, $productid, PDO::PARAM_INT);
    $stmt->execute();

    $stmt2 = $pdo->prepare('INSERT INTO shop.carts SET user_id=?, product_id=?, qty=? ON DUPLICATE KEY UPDATE qty = qty + ?');
    $stmt2->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
    $stmt2->bindVAlue(2, $productid, PDO::PARAM_INT);
    $stmt2->bindValue(3, $qty, PDO::PARAM_INT);
    $stmt2->bindValue(4, $qty, PDO::PARAM_INT);
    $stmt2->execute();
}

unset($_SESSION['cart'][$_SESSION['id']]);

?>
<?=template_header('Place Order')?>
<div class="placeorder content-wrapper">
    <h1>Ihre Bestellung wurde aufgegeben!</h1>
    <p>Danke für Ihr Vertrauen, Sie erhalten in Kürze eine Bestätigungs-Email.</p>
</div>

<?=template_footer()?>