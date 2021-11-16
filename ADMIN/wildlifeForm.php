<?php
include '../top.php';

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

$type = '';
$commonName = '';
$description = '';
$habitat = '';
$reproduction = '';
$diet = '';
$management = '';
$status = '';
$critterImage = '';
$saveData = true;

function verifyAlphaNum($testString){
    return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}

if(isset($_POST['btnSubmit'])){
    if(DEBUG){
        print '<p>POST array:</p><pre>';
        print_r($_POST);
        print '</pre>';
    }
    
    //sanitize data 
    $commonName = filter_var($_POST['fldCommonName'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['fldDescription'], FILTER_SANITIZE_STRING);
    $habitat = filter_var($_POST['fldHabitat'], FILTER_SANITIZE_STRING);
    $reproduction = filter_var($_POST['fldReproduction'], FILTER_SANITIZE_STRING);
    $diet = filter_var($_POST['fldDiet'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['fldStatus'], FILTER_SANITIZE_STRING);
    $critterImage = filter_var($_POST['fldCritterImage'], FILTER_SANITIZE_STRING);

    // validate data
    if ($commonName != ""){
        if($commonName == ""){
            print '<p class="mistake">Please enter a valid First Name.</p>';
            $saveData = false;
        }elseif (!verifyAlphaNum($commonName)){
            print '<p class="mistake">Make sure to input only numeric characters for your name.</p>';
        $saveData = false;
        }elseif (is_numeric($commonName)== true){
            print '<p class="mistake">Please do not input numeric characters for your name.</p>';
        $saveData = false;
        }
    }
    if ($description != ""){
        if($description == ""){
            print '<p class="mistake">Please enter a valid First Name.</p>';
            $saveData = false;
        }elseif (!verifyAlphaNum($description)){
            print '<p class="mistake">Make sure to input only numeric characters for your name.</p>';
        $saveData = false;
        }elseif (is_numeric($description)== true){
            print '<p class="mistake">Please do not input numeric characters for your name.</p>';
        $saveData = false;
        }
    }
    if ($habitat != ""){
        if($habitat == ""){
            print '<p class="mistake">Please enter a valid First Name.</p>';
            $saveData = false;
        }elseif (!verifyAlphaNum($habitat)){
            print '<p class="mistake">Make sure to input only numeric characters for your name.</p>';
        $saveData = false;
        }elseif (is_numeric($habitat)== true){
            print '<p class="mistake">Please do not input numeric characters for your name.</p>';
        $saveData = false;
        }
    }
    if ($reproduction != ""){
        if($reproduction == ""){
            print '<p class="mistake">Please enter a valid First Name.</p>';
            $saveData = false;
        }elseif (!verifyAlphaNum($reproduction)){
            print '<p class="mistake">Make sure to input only numeric characters for your name.</p>';
        $saveData = false;
        }elseif (is_numeric($reproduction)== true){
            print '<p class="mistake">Please do not input numeric characters for your name.</p>';
        $saveData = false;
        }
    }
    if ($diet != ""){
        if($diet == ""){
            print '<p class="mistake">Please enter a valid First Name.</p>';
            $saveData = false;
        }elseif (!verifyAlphaNum($diet)){
            print '<p class="mistake">Make sure to input only numeric characters for your name.</p>';
        $saveData = false;
        }elseif (is_numeric($diet)== true){
            print '<p class="mistake">Please do not input numeric characters for your name.</p>';
        $saveData = false;
        }
    }
    if ($management != ""){
        if($management == ""){
            print '<p class="mistake">Please enter a valid First Name.</p>';
            $saveData = false;
        }elseif (!verifyAlphaNum($management)){
            print '<p class="mistake">Make sure to input only numeric characters for your name.</p>';
        $saveData = false;
        }elseif (is_numeric($management)== true){
            print '<p class="mistake">Please do not input numeric characters for your name.</p>';
        $saveData = false;
        }
    }
    if ($status != ""){
        if($status == ""){
            print '<p class="mistake">Please enter a valid First Name.</p>';
            $saveData = false;
        }elseif (!verifyAlphaNum($status)){
            print '<p class="mistake">Make sure to input only numeric characters for your name.</p>';
        $saveData = false;
        }elseif (is_numeric($status)== true){
            print '<p class="mistake">Please do not input numeric characters for your name.</p>';
        $saveData = false;
        }
    }
    if ($critterImage != ""){
        if($critterImage == ""){
            print '<p class="mistake">Please enter a valid First Name.</p>';
            $saveData = false;
        }elseif (!verifyAlphaNum($critterImage)){
            print '<p class="mistake">Make sure to input only numeric characters for your name.</p>';
        $saveData = false;
        }elseif (is_numeric($critterImage)== true){
            print '<p class="mistake">Please do not input numeric characters for your name.</p>';
        $saveData = false;
        }
    }
    if($saveData){

        $sql4 = 'INSERT INTO tblWildlife SET ';
        $sql4 .= 'fldType = ?, ';
        $sql4 .= 'fldCommonName = ?';
        $sql4 .= 'fldDescription = ?';
        $sql4 .= 'fldHabitatnName = ?';
        $sql4 .= 'fldReproduction = ?';
        $sql4 .= 'fldDiet = ?';
        $sql4 .= 'fldManagement = ?';
        $sql4 .= 'fldStatus = ?';
        $sql4 .= 'fldMainImage = ?';


        $data = array();
        $data4[] = $type;
        $data4[] = $commonName;
        $data4[] = $description;
        $data4[] = $habitat;
        $data4[] = $reproduction;
        $data4[] = $diet;
        $data4[] = $management;
        $data4[] = $status;
        $data4[] = $critterImage;

        if(DEBUG){
            print $thisDataBaseReader->displayQuery($sql4, $data4);
        }
        $thisDataBaseWriter->insert($sql4, $data4);
    }

}
?>

<form action="<?php print PHP_SELF; ?>" id="frmUpdate" method="post">
    <fieldset class="textbox">
        <p>
            <label for="fldType">Type</label>
            <input type="text" id="fldType" name="fldType" value="<?php print $type; ?>" tabindex="700">
        </p>
    </fieldset>
    <fieldset class="textbox">
        <p>
            <label for="fldCommonName">Animal Common Name</label>
            <input type="text" id="fldCommonName" name="fldCommonName" value="<?php print $commonName; ?>" tabindex="700">
        </p>
    </fieldset>

    <fieldset class="textbox">
        <p>
            <label for="fldDescription">Description</label>
            <input type="text" id="fldDescription" name="fldDescription" value="<?php print $description; ?>" tabindex="700">
        </p>
    </fieldset>

    <fieldset class="textbox">
        <p>
            <label for="fldHabitat">Habitat</label>
            <input type="text" id="fldHabitat" name="fldHabitat" value="<?php print $habitat; ?>" tabindex="700">
        </p>
    </fieldset>

    <fieldset class="checkbox">
        <p>
            <label for="fldReproduction">Animal Reproduction</label>
            <input type="text" id="fldReproduction" name="fldReproduction" value="<?php print $reproduction; ?>" tabindex="700">
        </p>
    </fieldset>

    <fieldset class="checkbox">
        <p>
            <label for="fldDiet">Diet</label>
            <input type="text" id="fldDiet" name="fldDiet" value="<?php print $diet; ?>" tabindex="700">
        </p>
    </fieldset>
    <fieldset class="checkbox">
        <p>
            <label for="fldManagement">Management</label>
            <input type="text" id="fldManagement" name="fldManagement" value="<?php print $management; ?>" tabindex="700">
        </p>
    </fieldset>
    <fieldset class="textbox">
        <p>
            <label for="fldStatus">Status</label>
            <input type="text" id="fldStatus" name="fldStatus" value="<?php print $status; ?>" tabindex="700">
        </p>
    </fieldset>
    <fieldset class="textbox">
        <p>
            <label for="fldCritterImage">Animal Image</label>
            <input type="text" id="fldCritterImage" name="fldCritterImage" value="<?php print $critterImage; ?>" tabindex="700">
        </p>
    </fieldset>

    <fieldset>
        <p><input type="submit" value="Add" tabindex="999" name="btnSubmit"></p>
    </fieldset>
</form>



