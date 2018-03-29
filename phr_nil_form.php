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
        <h1>NLM Data Importer</h1>
        <p>Adding support for <a href="https://phr-demo.nlm.nih.gov/">National Library Medicine PHR</a></p>
    <form action="upload_NLM.php" method="post" enctype="multipart/form-data">
    <p>Select NLM export data to upload:</p>
    <input type="file" name="filepath" id="filepath">
    <input  class="button button-block" type="submit" value="Parse file" name="SubmitButton">
    </form>
    </div>
        
</body>