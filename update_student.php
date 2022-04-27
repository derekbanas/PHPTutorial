<?php
# Get data to input
# NEW add student_id input
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
$student_id = filter_input(INPUT_POST, "student_id", FILTER_VALIDATE_INT);

# Verify that eveything has been entered
if($first_name == null || $last_name == null || $email == null ||
$street == null || $city == null || $state == null ||
$zip == null || $phone == null || $birth_date == null ||
$sex == null || $lunch_cost == false || $student_id == null){
  # Print an error if values aren't entered
  $err_msg = "All Values Not Entered";
  include('db_error.php');
} else {
  require_once('db_connect.php');
  # Create your query using : to add parameters to the statement
  $query = 'UPDATE students
            SET first_name = :first_name,
            last_name = :last_name,
            email = :email,
            street = :street,
            city = :city,
            state = :state,
            zip = :zip,
            phone = :phone,
            birth_date = :birth_date,
            sex = :sex,
            lunch_cost = :lunch_cost
            WHERE student_id = :student_id';

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
  $stm->bindValue(':lunch_cost', $lunch_cost);
  $stm->bindValue(':student_id', $student_id);
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
     <h3>Delete Student</h3>
     <form action="delete_student.php" method="post"
       id="delete_student_form">
       <label>Student ID : </label>
       <input type="text" name="student_id"><br>
       <input type="submit" value="Delete Student"><br>
     </form>
   </body>
 </html>