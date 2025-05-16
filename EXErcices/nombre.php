<!DOCTYPE html>
<html>
<head>
    <title>Vérification de la valeur</title>
</head>
<body>

<?php

$valeur1 = 5; 
$valeur2 = -1;
$valeur3 = $valeur1 * $valeur2 ;


if ($valeur1 >= 0) {
    $valeur1 = $valeur1 * 2;
} else {
   
    $valeur1 = $valeur3 ;
   
}
?>
<table border="1">
    <tr>
        <td>
       La valeur positive
        </td>
    </tr>
    <tr>
        <td>
        <?php  
        echo $valeur1;
        ?>
        </td>
    </tr>
</table>

</body>
</html>
