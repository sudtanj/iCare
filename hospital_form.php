<?php
/* Displays user information and some useful messages */
session_start();
require(dirname(__FILE__) . '/object/Form.php');

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
<?php
include 'head.php'
?>
<body>
    <div class="form">
        <?php
            $hospitalForm=new Form("OpenMRS Converter","This form is use for bridge between our compability layer with OpenMRS application","index.php");
            $hospitalForm->addForm("Patient Name");
            echo '<center>';
            $hospitalForm->renderTitle();
            $hospitalForm->renderDescription();
            echo '<br /></center>';
            $hospitalForm->renderCompleteForm();
        ?>
    </div>
        
</body>