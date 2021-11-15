<?php 
include 'top.php';

$sql = 'SELECT pmkWildlifeId, fldType, fldCommonName, fldDescription, fldHabitat, fldReproduction, fldDiet, fldManagement, fldStatus, fldMainImage ';
$sql .= 'FROM tblWildlife ';
$sql .= 'ORDER BY fldCommonName';

$data = '';
$animals = $thisDataBaseReader->select($sql, $data);

?>

<main>
    <h2>Which of Vermont's Wildlife would you like to Delete?</h2>
    <?php
    if(is_array($animals)){
        foreach($animals as $animal){
            print '<figure class="animals">';
            print '<a href="displayCritter.php?cid=' . $animal['pmkWildlifeId'] . '"><img alt="' . $animal['fldCommonName'] . '" src="images/' . $animal['fldMainImage'] . '"></a>';
            print '<figcaption>' . $animal['fldCommonName'] . '</figcaption>';
            print '</figure>';
        }
    }
print '</main>';


include 'footer.php';
?>