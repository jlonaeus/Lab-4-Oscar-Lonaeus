<?php
include 'top.php';

$critterId = (isset($_GET['cid'])) ? (int) htmlspecialchars($_GET['cid']) : 0;
//print '<p>Critter Id = ' . $critterId;

$sql = 'SELECT pmkWildlifeId, fldType, fldCommonName, fldDescription, fldHabitat, ';
$sql .= 'fldReproduction, fldDiet, fldManagement, fldStatus, fldMainImage ';
$sql .= 'FROM tblWildlife ';
$sql .= 'WHERE pmkWildlifeId = ? ';
$sql .= 'ORDER BY fldCommonName';

$data = array($critterId);
$animals = $thisDataBaseReader->select($sql, $data);

?>

<main>
<?php

if(is_array($animals)){
    foreach($animals as $animal){
        print '<a class="button_fixed" href="adoptCritter.php?cid=' . $animal['pmkWildlifeId'] . '">Adopt This Animal</a>';
        print '<figure class="animals">';
        print '<img alt="' . $animal['fldCommonName'] . '" src="images/' . $animal['fldMainImage'] . '"></a>';
        print '<figcaption>' . $animal['fldCommonName'] . '</figcaption>';
        print '</figure>';
        print '<h3>Description</h3>';
        print '<p>' . $animal['fldDescription'] . '</p>';
        print '<h3>Habitat</h3>';
        print '<p>' . $animal['fldHabitat'] . '</p>';
        print '<h3>Reproduction</h3>';
        print '<p>' . $animal['fldReproduction'] . '</p>';
        print '<h3>Diet</h3>';
        print '<p>' . $animal['fldDiet'] . '</p>';
        print '<h3>Management</h3>';
        print '<p>' . $animal['fldManagement'] . '</p>';
        print '<h3>Status</h3>';
        print '<p>' . $animal['fldStatus'] . '</p>';
    }
}
?>