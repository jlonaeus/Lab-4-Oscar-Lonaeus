<?php
include 'top.php';
?>
<main>
    <p>Select Wildlife:</p>
    <pre>
    SELECT pmkWildlifeId, fldType, fldCommonName, fldDescription, fldHabitat, fldReproduction, fldDiet, fldManagement, fldStatus, fldMainImage
    FROM tblWildlife
    ORDER BY fldCommonName

    <h2>Create Adopter Table</h2>
        CREATE TABLE tblAdopter (
    pmkAdopterEmail varchar(50) NOT NULL,
    fldFirstName varchar(50) NOT NULL,
    fldLastName varchar(60) NOT NULL,
    fldAgreedToTerms tinyint(1) NOT NULL DEFAULT '1',
    fldRecieveCommunication tinyint(1) NOT NULL DEFAULT '1'
    );

    <h2>Create Adopter Wildlife Table</h2>
        CREATE TABLE tblAdopterWildlife (
    pmkDonationId int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fpkAdopterEmail varchar(50) NOT NULL,
    fpkWildlifeId int(11) NOT NULL,
    fldDonationAmount int(11) NOT NULL DEFAULT '0'
    );

    </pre>

</main>
<?php
include 'footer.php';
?>
</body>
</html>