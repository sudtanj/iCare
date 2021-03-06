<?php
/* Displays user information and some useful messages */
require './db.php';
session_start();

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
    //echo $_SESSION['first_name'];
}
?>
<?php
include 'head.php'
?>
<body>
  <div class="form">

          <h1>Welcome</h1>
          
          <p>
          <?php 
     
          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }
          
          ?>
          </p>
          <h2><?php echo $first_name.' '.$last_name; ?></h2>
          <p><?= $email ?></p>
          <p><strong>Your current health log :</strong></p>
          <?php
          $sql="SELECT log FROM healthdata WHERE emailkey='".$email."'";
          //echo $sql;
          $result=$mysqli->query($sql) or die(mysql_error());
          //echo $result->num_rows;
          if ($result->num_rows>0){
            while ($row = $result->fetch_assoc())
            {
              echo "<p>";
              echo $row['log'];
              echo "</p>";
            }
          }
          ?>
          <p><strong>Please select what you want to do below: </strong></p>
          <?php
          
          // Keep reminding the user this account is not active, until they activate
          if ( !$active ){
              echo
              '<div class="info">
              Account is unverified, please confirm your email by clicking
              on the email link!
              </div>';
          } else {
            echo '<a href="./hospital_form.php"><button type="submit" class="button button-block" name="hospital_convert" />Convert OpenMRS Data</button></a>';
            echo '<a href="./phr_nil_form.php"><button type="submit" class="button button-block" name="hospital_convert" />Convert NLM PHR</button></a>';
          }

          ?>
          <br />
          <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>

    </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
