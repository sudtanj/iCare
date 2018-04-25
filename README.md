# iCare

## Getting Started

### Quick Start
  1. Register using the register tab
  2. Enter the personal information including email and password
  3. Click submit
  4. Open email and click the confirmation link
  5. Sign in with the newly created account
  6. Select one of the menu to do import
### Main Scenario of Use
The main scenario in the use of this application is the scenario where the patient as the user wants to transfer data for the PHR application he has with the hospital owned EHR. This application will act as a compability layer between the two applications.
### System Requirement
  1. Minimum System Requirement
    1. Windows or Linux-based Operating System
    2. 512 MB ram
    3. PHP 5.5.9
    4. MYSQL 5.5.57
    5. Apache 2
    6. Composer
### Dependency
  1. phpmailer/phpmailer 6.0
  2. noetix/simple-orm dev-master
  3. bocharsky-bw/arrayzy 0.6.1
## Login System
PHP files are colored with yellow color. Mailed PHP files are in blue color. All green color indicates display messages, grey color are the most important action in PHP. Meanwhile, form action file which is being called other than the file itself is in red.

There are three actions where a user can take on index.php page, there are:
- login.php page : this action will lead user to do login to access their profile or account
- register.php page : this action will lead user to do registration by fill their first name and last name in required field, signing up their email address and set a password.
- forgot.php page : 

In error.php file, the only thing that prints out the message from the $_SESSION[‘message’] variable, which will be set on the previous page. So, we need to start the session by calling “session_start()” function so we have access to $_SESSION global variable. We need to make sure that the variable is set with “isset()” and not empty “!empty()” functions before attempting to print it out. If the variable is not set, we redirect the user back to the “index.php” page with header() function. Below are the code for error.php

Inside the index.php file, we check if the form is being submitted with method=”post” by making sure the request_method of $_SERVER variable is equal to POST. we then check if the $_POST[‘login’] is set which is a variable of the login form, in that case we proceed to login.php by including the code with “require” keyword. Else if $_POST[‘register’] variable is set, which is a variable of the register form

```php

<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
 <title>Sign-Up/Login Form</title>
 <?php include 'css/css.html'; ?>
</head>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
   if (isset($_POST['login'])) { //user logging in
      require 'login.php';
   }
   elseif (isset($_POST['register'])) { //user registering
         require 'register.php';
   }
}
?>

```

## Convert OpenMRS

### Input

1. OpenMRS Converter required the OpenMRS user id to begin importing the health data log

### Process

1. OpenMRS Converter call the api from the link [http://demo.openmrs.org/openmrs/ws/rest/v1/visit](http://demo.openmrs.org/openmrs/ws/rest/v1/visit) to access the data available via json format.
2. OpenMRS Converter will fetch all the health data and get all the log information with the specified id
3. OpenMRS Converter will insert all the data found in the api result to the iCare database and linked it with the user id that logged in at iCare.

#### MySQL Query

        INSERT INTO healthdata (emailkey,log) VALUES ($email,$visitlog[$i]);

### Output

1. OpenMRS Converter will output a success message whether it got any data or not.
2. OpenMRS Converter will redirect user out from the module to the main page
3. iCare will display the new result it got from the updated database.

## Convert NLM PHR
Interface of NLM Data Importer

**Diagram**

**Input**

1. Export the health data from NLM PHR export button
2. Save the file result to the client local hard drive
3. Upload the data to the NLM Data Import by clicking the choose file
4. Click parse to continue

**Process**

1. iCare app will unpack the uploaded data
2. It will parse the data and search for the health log
3. It will import all the health log info to the iCare central database

**Output**

1. iCare will output a success importing message
2. iCare will redirect back user to the main page which show the user profile and health log collection
