<?php
include 'top.php';

function getData($field){
    if(!isset($_POST[$field])){
        $data = "";
    }
    else{
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data, ENT_QUOTES);
    }
    return $data;
}

//initialize variables 


$critterId = (isset($_GET['cid'])) ? (int) htmlspecialchars($_GET['cid']) : 0;
if(isset($_POST['hidCritterId'])){
    $critterId = (int) htmlspecialchars($_POST['hidCritterId']);
}
if(DEBUG) print "<p>Critter Id = " . $critterId . "</p>";

print "<p>Critter Id = " . $critterId;
$sql = 'SELECT pmkWildlifeId, fldCommonName ';
$sql .= 'FROM tblWildlife ';
$sql .= 'WHERE pmkWildlifeId = ?';

$data = array($critterId);
$animalToAdopt = $thisDataBaseReader->select($sql, $data);
print $thisDataBaseReader->displayQuery($sql, $data);
print_r($animalToAdopt);
print $sql;

//if data doesnt exist
$critterCommonName = $animalToAdopt[0]['fldCommonName'];

$donationAmount = 50;
$adopterEmail = 'jlonaeus@uvm.edu';
$adopterFirstName = "";
$adopterLastName = "";
$agreeToTerms = '1';
$junkMail = '1';

$saveData = true;
?>
<?php
function verifyAlphaNum($testString){
    return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}
?>

<main>
    <h2>Adopt a <?php print $critterCommonName; ?></h2>
    <?php
    if(isset($_POST['btnSubmit'])){
        if(DEBUG){
            print '<p>POST array:</p><pre>';
            print_r($_POST);
            print '</pre>';
        }
        
        //sanitize data 
        $donationAmount = (int) getData('rngDonationAmount');
        $adopterEmail = filter_var($_POST['txtAdopterEmail'], FILTER_SANITIZE_EMAIL);
        $adopterFirstName = filter_var($_POST['txtAdopterFirstName'], FILTER_SANITIZE_STRING);
        $adopterLastName = filter_var($_POST['txtAdopterLastName'], FILTER_SANITIZE_STRING);
        $agreeToTerms = (int) getData('chkAgreeToTerms');
        $junkMail = (int) getData('chkJunkMail');

        //validate data
        if($donationAmount <= 25 or $donationAmount >= 1000){
            print '<p class="mistake">Please choose a valid amount to donate.</p>';
            $saveData = false;
        }

        if (!filter_var($adopterEmail, FILTER_VALIDATE_EMAIL)){
            print '<p class="mistake">Please enter a valid email adress.</p>';
            $saveData = false;
        }

        if ($adopterFirstName != ""){
            if($adopterFirstName == ""){
                print '<p class="mistake">Please enter a valid First Name.</p>';
                $saveData = false;
            }elseif (!verifyAlphaNum($adopterFirstName)){
                print '<p class="mistake">Make sure to input only numeric characters for your name.</p>';
            $saveData = false;
            }elseif (is_numeric($adopterFirstName)== true){
                print '<p class="mistake">Please do not input numeric characters for your name.</p>';
            $saveData = false;
            }
        }

        if ($adopterLastName != ""){
            if($adopterLastName == ""){
                print '<p class="mistake">Please enter a valid First Name.</p>';
                $saveData = false; 
            }elseif (!verifyAlphaNum($adopterLastName)){
                print '<p class="mistake">Make sure to input only numeric characters for your name.</p>';
            $saveData = false;
        }elseif (is_numeric($adopterLastName)== true){
                print '<p class="mistake">Please do not input numeric characters for your name.</p>';
            $saveData = false;
            }
        }

        if ($agreeToTerms != 1){
            $agreeToTerms = 0;
            $saveData = true;
        }

        if ($junkMail != 1){
            $junkMail = 0;
            $saveData = true;
        }

        if (!is_numeric($critterId)){
            print '<p class="mistake">Critter Id must be an integer value.</p>';
            $saveData = false;
        }
        
        if($saveData){

            $sql = 'INSERT INTO tblAdopterWildlife SET ';
            $sql .= 'fldDonationAmount = ?, ';
            $sql .= 'fpkAdopterEmail = ?, ';
            $sql .= 'fpkWildlifeId = ?';

            $data = array();
            $data[] = $donationAmount;
            $data[] = $adopterEmail;
            $data[] = $critterId;

            if(DEBUG){
                print $thisDataBaseReader->displayQuery($sql, $data);
            }
            $thisDataBaseWriter->insert($sql, $data);


            //table adopters
            $sql2 = 'INSERT INTO tblAdopter SET ';
            $sql2 .= 'pmkAdopterEmail = ?, ';
            $sql2 .= 'fldFirstName = ?, ';
            $sql2 .= 'fldLastName = ?, ';
            $sql2 .= 'fldAgreedToTerms = ?, ';
            $sql2 .= 'fldRecieveCommunication = ?';

            $data2 = array();
            $data2[] = $adopterEmail;
            $data2[] = $adopterFirstName;
            $data2[] = $adopterLastName;
            $data2[] = $agreeToTerms;
            $data2[] = $junkMail;

            
            if(DEBUG){
                print $thisDataBaseReader->displayQuery($sql2, $data2);
            }
            $thisDataBaseWriter->insert($sql2, $data2);

            // for testing the update function
            $sql3 = 'UPDATE tblWildlife SET fldCommonName = ? WHERE pmkWildlifeId = ?';
            $data3 = array('Oscar the Grouch', 1);
            if (DEBUG){
                print $thisDataBaseReader->displayQuery($sql3, $data3);
            }
            $saved = $thisDataBaseWriter->update($sql3, $data3);
        }
    }
    ?>
    <form action="<?php print PHP_SELF; ?>" id="frmAdopt" method="post">
        <fieldset class="range">
            <p>
                <lable for="rngDonationAmount">Donation Amount $<span id="donationValue"></span></label>
                <input type="range" min="25" max="1000" step="25" value="<?php print $donationAmount; ?>" name="rngDonationAmount" id="rngDonationAmount">
                <script>
                    var slider = document.getElementById("rngDonationAmount");
                    var output = document.getElementById("donationValue");
                    output.innerHTML = slider.value;
                    slider.oninput = function() {
                        output.innerHTML = this.value;
                    }
                </script>
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <label for="txtAdopterEmail">Email Address</label>
                <input type="email" id="txtAdopterEmail" name="txtAdopterEmail" value="<?php print $adopterEmail; ?>" tabindex="200">
            </p>
        </fieldset>


        <fieldset class="textbox">
            <p>
                <label for="txtAdopterFirstName">First Name</label>
                <input type="text" id="txtAdopterFirstName" name="txtAdopterFirstName" value="<?php print $adopterFirstName; ?>" tabindex="200">
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <label for="txtAdopterLastName">Last Name</label>
                <input type="text" id="txtAdopterLastName" name="txtAdopterLastName" value="<?php print $adopterLastName; ?>" tabindex="200">
            </p>
        </fieldset>

        <fieldset class="checkbox">
            <p>
                <label for="chkAgreeToTerms">Do you agree to the terms and conditions?</label>
                <input type="checkbox" id="chkAgreeToTerms" name="chkAgreeToTerms" value="<?php print $agreeToTerms; ?>" checked>
            </p>
        </fieldset>

        <fieldset class="checkbox">
            <p>
                <label for="chkJunkMail">Would you like to be sent emails?</label>
                <input type="checkbox" id="chkJunkMail" name="chkJunkMail" value="<?php print $junkMail; ?>" checked>
            </p>
        </fieldset>

        <fieldset class="hidden">
                <input type="hidden" id="hidCritterId" name="hidCritterId" value="<?php print $critterId; ?>">
        </fieldset>

        <fieldset>
            <p><input type="submit" value="Adopt" tabindex="999" name="btnSubmit"></p>
        </fieldset>
    </form>
</main>

<?php
include 'footer.php';
?>
