<?php
$sql = "SELECT * FROM shop.carts INNER JOIN shop.products ON shop.carts.product_id = shop.products.id INNER JOIN shop.users on shop.users.id = shop.carts.user_id";
$carts = $pdo->query($sql);
$carts->setFetchMode(PDO::FETCH_ASSOC);

?>


<?=template_header('Cart')?>

<div class="cart content-wrapper">
    <h1>Gekaufte Waren</h1>
        <table>
            <thead>
                <tr>
                    <td colspan="2">Produkt</td>
                    <td>Preis</td>
                    <td>Menge</td>
                    <td>User</td>
                    <td>Summe</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($carts)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Es wurde noch nichts gekauft</td>
                </tr>
                <?php else: ?>

                <?php foreach ($carts as $cart): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$cart['id']?>">
                            <img src="imgs/<?=$cart['img']?>" width="50" height="50" alt="<?=$cart['name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$cart['id']?>"><?=$cart['name']?></a>
                        <br>
                    </td>
                    <td class="price">&euro;<?=$cart['price']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$cart['id']?>" value="<?=$cart['qty']?>"  readonly>
                    </td>
                    <td class="quantity">
                       <h4> <?=$cart['username']?> </h4>
                    </td>
                    <td class="price">&euro;<?=$cart['price'] * $cart['qty']?></td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>

</div>

<?=template_footer()?>
