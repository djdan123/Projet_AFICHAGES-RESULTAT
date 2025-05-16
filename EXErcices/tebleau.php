<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
    <?php
    $valeur1= 30;
    $valeur2  =0;
    $addition = $valeur1 + $valeur2 ;
    $soustraction= $valeur1- $valeur2;
    $multi = $valeur1 * $valeur2;
    $div = $valeur1 / $valeur2;

    ?>

    <table border="1">
    <tr>
        <td>Valeur1</td>
        <td>Operateur</td>
        <td>Valeur2</td>
        <td>Resultats</td>
    </tr>
    <tr>
        <td><?php 
        echo $valeur1;
        ?></td>
        <td>+</td>
        <td><?php 
        echo $valeur2;
        ?></td>
        <td><?php 
        echo $addition;
        ?></td>
    </tr>
    <tr>
    <td><?php 
        echo $valeur1;
        ?></td>
        <td>-</td>
        <td><?php 
        echo $valeur2;
        ?></td>
        <td><?php 
        echo $soustraction;
        ?></td>
    </tr>
    <tr>
    <td><?php 
        echo $valeur1;
        ?></td>
        <td>*</td>
        <td><?php 
        echo $valeur2;
        ?></td>
        <td><?php 
        echo $multi;
        ?></td>
    </tr>
    <tr>
    <td><?php 
        echo $valeur1;
        ?></td>
        <td>/</td>
        <td><?php 
        echo $valeur2;
        ?></td>
        <td><?php 
        echo $div;
        ?></td>
    </tr>
    
    
</table>
</body>
</html>
