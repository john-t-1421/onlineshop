
<?=template_header('Home')?>
<?php session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
}?>
<div class="container">
    <div class="row my-2">
        <div class="col-lg-8 order-lg-2">
           
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">User Profil</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Über mich</h6>
                            <p>
                           <?php echo("Profil von {$_SESSION['username']}"."<br />");?>
                            </p>
                            <h6>Hobbys</h6>
                            <p>
                                Dafür fehlt noch eine Spalte in der Datenbank ...
                            </p>
                          </div>
                         <form action="index.php?page=delete" method="POST">
                         <input type="hidden" name="id" value="<?php
       echo $tools['id']; ?>"/>
     <br><div><input type="submit" value="Profil löschen" onClick="return confirm('Wollen Sie sich wirklich löschen?')"></div>
                         </form>
    </div>
</div>
<?=template_footer()?>