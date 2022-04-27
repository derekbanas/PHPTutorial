<?php
# Get data to input
$first_name = filter_input(INPUT_POST, "first_name");
$last_name = filter_input(INPUT_POST, "last_name");
$email = filter_input(INPUT_POST, "email");
$street = filter_input(INPUT_POST, "street");
$city = filter_input(INPUT_POST, "city");
$state = filter_input(INPUT_POST, "state");
$zip = filter_input(INPUT_POST, "zip");
$phone = filter_input(INPUT_POST, "phone");
$birth_date = filter_input(INPUT_POST, "birthdate");
$sex = filter_input(INPUT_POST, "sex");
$lunch_cost = filter_input(INPUT_POST, "lunch", FILTER_VALIDATE_FLOAT);
# Create a timestamp for now
$date_entered = date('Y-m-d H:i:s');

# Verify that eveything has been entered
if($first_name == null || $last_name == null || $email == null ||
$street == null || $city == null || $state == null ||
$zip == null || $phone == null || $birth_date == null ||
$sex == null || $lunch_cost == false){
  # Print an error if values aren't entered
  $err_msg = "All Values Not Entered<br>";
  include('db_error.php');

  # Validate Data with Regular Expressions
  # Regular Expressions are codes used to match patterns
  # Check if first name contains only characters with a max of 30
} elseif(!preg_match("/[a-zA-Z]{3,30}$/", $first_name)){
  $err_msg = "First Name Not Valid<br>";
  include('db_error.php');
} elseif(!preg_match("/[a-zA-Z]{3,30}$/", $last_name)){
  $err_msg = "Last Name Not Valid<br>";
  include('db_error.php');
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  $err_msg = "Email Not Valid<br>";
  include('db_error.php');
} elseif(!preg_match("/^[A-Za-z0-9 ,#'\/.]{3,50}$/", $street)){
  $err_msg = "Street Not Valid<br>";
  include('db_error.php');
} elseif(!preg_match("/[a-zA-Z\- ]{2,58}$/", $city)){
  $err_msg = "City Not Valid<br>";
  include('db_error.php');
} elseif(!preg_match("/^(?:A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])*$/", $state)){
  $err_msg = "State Not Valid<br>";
  include('db_error.php');
} elseif(!preg_match("/[0-9]{5}$/", $zip)){
  $err_msg = "Zip Not Valid<br>";
  include('db_error.php');
} elseif(!preg_match("/(([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+$/", $phone)){
  $err_msg = "Phone Not Valid<br>";
  include('db_error.php');
} elseif(!preg_match("/[0-9- ]{8,12}$/", $birth_date)){
  $err_msg = "Birth Date Not Valid<br>";
  include('db_error.php');
} elseif(!preg_match("/[MF]{1}$/", $sex)){
  $err_msg = "Sex Not Valid<br>";
  include('db_error.php');
} else {
  require_once('db_connect.php');
  # Create your query using : to add parameters to the statement
  $query = 'INSERT INTO students (first_name, last_name, email,
    street, city, state, zip, phone, birth_date, sex, date_entered,
    lunch_cost, student_id) VALUES
    (:first_name, :last_name, :email, :street, :city, :state, :zip, :phone, :birth_date, :sex, :date_entered, :lunch_cost, :student_id)';

  # Create a PDOStatement object
  $stm = $db->prepare($query);
  # Bind values to parameters in the prepared statement
  $stm->bindValue(':first_name', $first_name);
  $stm->bindValue(':last_name', $last_name);
  $stm->bindValue(':email', $email);
  $stm->bindValue(':street', $street);
  $stm->bindValue(':city', $city);
  $stm->bindValue(':state', $state);
  $stm->bindValue(':zip', $zip);
  $stm->bindValue(':phone', $phone);
  $stm->bindValue(':birth_date', $birth_date);
  $stm->bindValue(':sex', $sex);
  $stm->bindValue(':date_entered', $date_entered);
  $stm->bindValue(':lunch_cost', $lunch_cost);
  $stm->bindValue(':student_id', null, PDO::PARAM_INT);
  # Execute the query and store true or false based on success
  $execute_success = $stm->execute();
  $stm->closeCursor();

  # If an error occurred print the error
  if(!$execute_success){
    print_r($stm->errorInfo()[2]);
  }
}

require_once('db_connect.php');
$query_students = 'SELECT * FROM students ORDER BY student_id';
$student_statement = $db->prepare($query_students);
$student_statement->execute();
$students = $student_statement->fetchAll();
$student_statement->closeCursor();
 ?>
 <!DOCTYPE HTML>
 <html lang="en">
   <head>
     <meta charset="UTF-8">
     <title>PHP Tutorial</title>
     <link rel="stylesheet" type="text/css" href="main.css" />
   </head>
   <body>
     <h3>Student List</h3>
     <table>
       <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Email</th>
         <th>Street</th>
         <th>City</th>
         <th>State</th>
         <th>Zip</th>
         <th>Phone</th>
         <th>BD</th>
         <th>Sex</th>
         <th>Entered</th>
         <th>Lunch</th>
       </tr>
       <!-- Get an array from the DB query and cycle
       through each row of data -->
       <?php foreach($students as $student) : ?>
         <tr>
           <!-- Print out individual column data -->
           <td><?php echo $student['student_id']; ?></td>
           <td><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></td>
           <td><?php echo $student['email']; ?></td>
           <td><?php echo $student['street']; ?></td>
           <td><?php echo $student['city']; ?></td>
           <td><?php echo $student['state']; ?></td>
           <td><?php echo $student['zip']; ?></td>
           <td><?php echo $student['phone']; ?></td>
           <td><?php echo $student['birth_date']; ?></td>
           <td><?php echo $student['sex']; ?></td>
           <td><?php echo $student['date_entered']; ?></td>
           <td><?php echo $student['lunch_cost']; ?></td>
         </tr>
       <!-- Mark the end of the foreach loop -->
       <?php endforeach; ?>
     </table>
     <h3>Update Student</h3>
     <form action="update_student.php" method="post"
       id="update_student_form">
       <label>Student ID : </label>
       <input type="text" name="student_id"><br>
       <label>First Name : </label>
       <input type="text" name="first_name"><br>
       <label>Last Name : </label>
       <input type="text" name="last_name"><br>
       <label>Email : </label>
       <input type="text" name="email"><br>
       <label>Street : </label>
       <input type="text" name="street"><br>
       <label>City : </label>
       <input type="text" name="city"><br>
       <label>State : </label>
       <input type="text" name="state"><br>
       <label>Zip Code : </label>
       <input type="text" name="zip"><br>
       <label>Phone : </label>
       <input type="text" name="phone"><br>
       <label>Birth Date : </label>
       <input type="text" name="birthdate"><br>
       <label>Sex : </label>
       <input type="text" name="sex"><br>
       <label>Lunch Cost : </label>
       <input type="text" name="lunch"><br>
       <input type="submit" value="Update Student"><br>
     </form>
   </body>
 </html>