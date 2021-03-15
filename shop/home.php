
<?php
session_start();
if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)) {
    header("location: login.php");
    exit;
}
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$usern = $_SESSION['username'];

?>
<?=template_header('Home')?>

<div class="featured">
    <h2 >Willkommen!</h2>
    <h2><?=$usern?></h1>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Kürzlich hinzugefügt</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                &euro;<?=$product['price']?>
            </span>
        </a>
        <?php endforeach;?>
    </div>
</div>

<?=template_footer()?>
