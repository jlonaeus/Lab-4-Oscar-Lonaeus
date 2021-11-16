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
<h2>Are you sure you would like to delete a <?php print $critterCommonName; ?></h2>