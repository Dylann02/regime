<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    <h1>Ajout de solde :  <strong><?= $utilisateur['prenom']?></h1>
    <form action="<?= base_url("traitementCredit");?>" method="post">
        <?= csrf_field() ?>
        <p>code de recharge : <input type="text" name="credit"></p>
        <input type="submit" value="recharger">
    </form>
    <?php if (session()->getFlashdata('error')) :?>
        <p style="color:red"><?= session()->getFlashdata('error')?> </p>
    <?php endif;?>
   </strong>
</body>
</html>