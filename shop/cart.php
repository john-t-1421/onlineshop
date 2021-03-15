<?php
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
}
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product && $quantity > 0) {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($_SESSION['id'], $_SESSION['cart'])) {
                $_SESSION['cart'][$_SESSION['id']][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$_SESSION['id']][$product_id] = $quantity;
            }
        } else {
            $_SESSION['cart'] = array( $_SESSION['id'] => array($product_id => $quantity));
        }
    }
    header('location: index.php?page=cart');
    exit;
}
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart'][$_SESSION['id']]) && isset($_SESSION['cart'][$_SESSION['id']][$_GET['remove']])) {
    unset($_SESSION['cart'][$_SESSION['id']][$_GET['remove']]);
}
if (isset($_POST['update']) && isset($_SESSION['cart'][$_SESSION['id']])) {
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            if (is_numeric($id) && isset($_SESSION['cart'][$_SESSION['id']][$id]) && $quantity > 0) {
                $_SESSION['cart'][$_SESSION['id']][$id] = $quantity;
            }
        }
    }

    header('location: index.php?page=cart');
    exit;
}
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;
}

$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;

if ($products_in_cart) {
        $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart[$_SESSION['id']]), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
   
    $stmt->execute(array_keys($products_in_cart[$_SESSION['id']]));
   
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    
    foreach ($products as $product) {
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$_SESSION['id']][$product['id']];
    }

}


?>
<?=template_header('Cart')?>

<div class="cart content-wrapper">
    <h1>Warenkorb</h1>
    <form action="index.php?page=cart" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Produkt</td>
                    <td>Preis</td>
                    <td>Menge</td>
                    <td>Summe</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Sie haben noch keine Produkte hinzugefügt</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=product&id=<?=$product['id']?>">
                            <img src="imgs/<?=$product['img']?>" width="50" height="50" alt="<?=$product['name']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a>
                        <br>
                        <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove">Entfernen</a>
                    </td>
                    <td class="price">&euro;<?=$product['price']?></td>
                    <td class="quantity">
                        <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$_SESSION['id']][$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                    </td>
                    <td class="price">&euro;<?=$product['price'] * $products_in_cart[$_SESSION['id']][$product['id']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Gesamt</span>
            <span class="price">&euro;<?=$subtotal?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Aktualisieren" name="update">
            <input type="submit" value="Bestellen" name="placeorder">
        </div>
    </form>
</div>

<?=template_footer()?>
