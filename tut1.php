<?php
// You embed PHP code by surrounding it with <?php and
// the closing tag
// Put PHP code you want to run before the HTML before it
// You can also embed PHP code within the HTML with
// the same tags

/*
Variables begin with a $, start with a letter and
can contain letters, numbers or underscores
A variables data type is defined by the value
assigned and the data type can change
*/

// Here are the different data types
$f_name = "Derek"; // String
$l_name = 'Banas'; // You can use single quotes
$age = 44; // Integer
$height = 1.87; // Float
$can_vote = true; // Boolean
// Array
$address = array('street'=> '123 Main St', 'city'=> 'Pittsburgh');
// I'll cover objects later

// NULL signifies that something doesn't have a value
$state = NULL;

// You can define constants
define('PI', 3.1415);

 ?>

<!-- Tells the browser to render using HTML5 spec -->
<!DOCTYPE HTML>
<!-- Define we are using English -->
<html lang="en">
  <!-- Contains data for defining the doc -->
  <head>
    <!-- Defines the character set -->
    <meta charset="UTF-8">
    <title>PHP Tutorial</title>
  </head>
  <body>
    <!-- Display inline using PHP tags and echo. Combine strings with . -->
    <p>Name : <?php echo $f_name . ' ' . $l_name; ?></p>

    <!-- You can pass data to a PHP script using forms
    Get passes the values through the URL in an array
    Get should be used when you are reading data from the
    server. Using Get allows the user to bookmark the page
    Use Post when you resend data to the server
    because if the user tries to send the same data to the
    server multiple times they will be warned
    -->
    <form action="tut1.php" method="get">
      <label>Your State : </label>
      <input type="text" name="state"/><br>
      <label>Number 1 : </label>
      <input type="text" name="num-1"/><br>
      <label>Number 2 : </label>
      <input type="text" name="num-2"/><br>
      <input type="submit" value="Submit"/>
    </form>
    <?php
    # Check if anything was passed to the web page and if the state key exists
    # I'll show a better way to validate user input later, but I want to cover
    # these functions as well
      if(isset($_GET) && array_key_exists('state', $_GET)){
        # Assign the value passed
        $state = $_GET['state'];
        # Verify that the value isn't NULL and isn't empty
        if (isset($state) && !empty($state)){
          echo 'You live in ' . $state . '<br>';
          # Use double quotes to insert a variable in a string
          echo "$f_name lives in $state<br>";
        }
        # Check how many values are in array with count
        # If executes statements between {} if the condition is true
        if(count($_GET) >= 3){
          # Math operators
          $num_1 = $_GET['num-1'];
          $num_2 = $_GET['num-2'];
          echo "$num_1 + $num_2 = " . ($num_1 + $num_2) . "<br>";
          echo "$num_1 - $num_2 = " . ($num_1 - $num_2) . "<br>";
          echo "$num_1 * $num_2 = " . ($num_1 * $num_2) . "<br>";
          echo "$num_1 / $num_2 = " . ($num_1 / $num_2) . "<br>";
          echo "$num_1 % $num_2 = " . ($num_1 % $num_2) . "<br>";

          # Integer Division
          echo "$num_1 / $num_2 = " . (intdiv($num_1, $num_2)) . "<br>";

          # Shortcut ways of incrementing and decrementing
          echo "Increment $num_1 = " . ($num_1++) . "<br>";
          echo "Decrement $num_1 = " . ($num_1--) . "<br>";

          # The following use the format of turning i = i + 1 into
          # i += 1
          $num_1 += 1;
          $num_1 -= 1;
          $num_1 *= 1;
          $num_1 /= 1;
          $num_1 %= 1;

          # Built in math functions
          echo "abs(-5) = " . abs(-5) . "<br>";
          echo "ceil(4.45) = " . ceil(4.45) . "<br>";
          echo "floor(4.45) = " . floor(4.45) . "<br>";
          echo "round(4.45) = " . round(4.45) . "<br>";
          echo "max(4,5) = " . max(4,5) . "<br>";
          echo "min(4,5) = " . min(4,5) . "<br>";
          echo "pow(4,2) = " . pow(4,2) . "<br>"; # 4 raised to the power of 2
          echo "sqrt(16) = " . sqrt(16) . "<br>"; # Square Root
          echo "exp(1) = " . exp(1) . "<br>"; # Exponent of e
          echo "log(e) = " . log(exp(1)) . "<br>"; # Logarithm
          echo "log10(10) = " . log10(exp(10)) . "<br>"; # Base 10 Logarithm
          echo "PI = " . pi() . "<br>"; # PI
          echo "hypot(10,10) = " . hypot(10,10) . "<br>"; # Hypotenuse
          echo "deg2rad(90) = " . deg2rad(90) . "<br>"; # Degrees to radians
          echo "rad2deg(1.57) = " . rad2deg(1.57) . "<br>";
          echo "mt_rand(1,50) = " . mt_rand(1,50) . "<br>"; # Fast random num
          echo "rand(1,50) = " . rand(1,50) . "<br>"; # Original random num
          echo "Max Random = " . mt_getrandmax() . "<br>"; # Max random num
          echo "is_finite(10) = " . is_finite(10) . "<br>";
          echo "is_infinite(log(0)) = " . is_infinite(log(0)) . "<br>";
          echo "is_numeric(\"10\") = " . is_numeric("10") . "<br>";

          # Trig functions
          # sin, cos, tan, asin, acos, atan, asinh, acosh, atanh, atan2
          echo "sin(0) = " . sin(0) . "<br>";

          # Format with decimals and defined decimal places
          echo number_format(12345.6789, 2) . "<br>";

          # If, elseif and else are used to execute different blocks
          # of code depending on multiple conditions. We do this with
          # Conditional Operators : == != < > <= >= and with
          # Logical Operators : && || !
          # Calculate discounts based on amount purchased
          $num_oranges = 4;
          $num_bananas = 36;
          if(($num_oranges > 25) && ($num_bananas > 30)){
            echo "25% Discount<br>";
          } elseif(($num_oranges > 30) || ($num_bananas > 35)){
            echo "15% Discount<br>";
          } elseif(!(($num_oranges < 5)) || (!($num_bananas < 5))){
            echo "5% Discount<br>";
          } else {
            echo "No Discount<br>";
          }

          # Switch provides output for a limited number of options
          $request = "Coke";
          switch($request){
            case "Coke":
              echo "Here is your Coke<br>";
              break;
            case "Pepsi":
              echo "Here is your Pepsi<br>";
              break;
            default:
              echo "Here is your Water<br>";
              break;
          }

          # You can also use conditons with Switch if you match the
          # value checked as true with a condition that also is true
          $age = 12;
          switch(true){
            case ($age < 5):
              echo "Stay Home<br>";
              break;
            case ($age == 5):
              echo "Go to Kindergarten<br>";
              break;
            # Range creates an array with values from 6 to 17
            # in_array returns true if the value of age is in the array
            case in_array($age, range(6, 17)):
              $grade = $age - 5;
              echo "Go to Grade $grade<br>";
              break;
            default:
              echo "Go to College<br>";
          }

          # The Ternary operator assigns one or another value based
          # on a condition
          $can_vote = ($age >= 18) ? "Can Vote" : "Can't Vote";
          echo "Vote? : $can_vote<br>";

          # The identical operator returns true only if the value
          # and the data type are the same
          if ("10" === 10){
            echo "They are Equal<br>";
          } else {
            echo "They aren't Equal<br>";
          }

          # ---------- PRINTF ----------
          # printf provides another way to format output
          # The variable value is placed where the type specifier
          # is located in the string
          # %c : Character
          # %d : Integer
          # %f : Float with decimal length requested
          # %s : String
          printf("%c %d %.2f %s<br>", 65, 65, 1.234, "string");

          # ---------- STRINGS ----------
          # Strings store a series of characters
          $rand_str = "     Random String      ";
          # Get number of characters in the string
          printf("Length : %d<br>", strlen($rand_str));
          # Trim left white space
          printf("Length : %d<br>", strlen(ltrim($rand_str)));
          # Trim right white space
          printf("Length : %d<br>", strlen(rtrim($rand_str)));
          # Trim all white space
          $rand_str = trim($rand_str);
          printf("Length : %d<br>", strlen($rand_str));
          # Display in all uppercase
          printf("Upper : %s<br>", strtoupper($rand_str));
          # Display in all lowercase
          printf("Lower : %s<br>", strtolower($rand_str));
          # 1st letter in uppercase
          printf("Upper : %s<br>", ucfirst($rand_str));
          # Get characters from 0 to 6
          printf("1st 6 : %s<br>", substr($rand_str, 0, 6));
          # Get location of a string
          printf("Index : %d<br>", strpos($rand_str, "String"));
          echo "rand_str : " . $rand_str . "<br>";
          # Replace a string with another
          $rand_str = str_replace("String", "Characters", $rand_str);
          printf("Replace : %s<br>", $rand_str);
          # Compare strings
          # 0 if equal
          # Positive if str1 > str2
          # Negative if str1 < str2
          # strcasecmp() isn't case sensitive
          printf("A == B : %d<br>", strcmp("A", "B"));

          # ---------- ARRAYS ----------
          # Arrays store multiple values
          $friends = array('Joy', 'Willow', 'Ivy');
          # Access by index
          echo 'Wife : ' . $friends[0] . '<br>';
          # Add an item
          $friends[3] = 'Steve';
          # Cycle through an array
          foreach($friends as $f){
            printf("Friend : %s<br>", $f);
          }
          # Create key value pairs
          $me_info = array('Name'=>'Derek', 'Street'=>'123 Main');
          # Output keys and values
          foreach($me_info as $k => $v){
            printf("%s : %s<br>", $k, $v);
          }
          # Combine arrays
          $friends2 = array('Doug');
          $friends = $friends + $friends2;
          # Sort is ascending order
          sort($friends);
          # Sort in descending order
          rsort($friends);
          # Sort a key value (associative array) by value
          asort($me_info);
          # Sort associative array by key
          ksort($me_info);
          # Use arsort and krsort for descending
          # Multidimensional arrays
          $customers = array(array('Derek', '123 Main'),
                            array('Sally', '122 Main'));
          for($row = 0; $row < 2; $row++){
            for($col = 0; $col < 2; $col++){
              echo $customers[$row][$col] . ', ';
            }
            echo '<br>';
          }
          # Turn a string into an array
          $let_str = "A B C D";
          $let_arr = explode(' ', $let_str);
          foreach($let_arr as $l){
            printf("Letter : %s<br>", $l);
          }
          # Turn an array into a string
          $let_str_2 = implode(' ', $let_arr);
          echo "String : $let_str_2<br>";
          # Check if key exists
          printf("Key Exists : %d<br>", array_key_exists('Name', $me_info));
          # Get key for matching value
          printf("Key : %s<br>", array_search('Derek', $me_info));
          # Is value in array
          printf("In Array : %d<br>", in_array('Joy', $friends));

          # ---------- LOOPS ----------
          # While loops execute as long as a condition is true
          $i = 0;
          while($i < 10){
            echo ++$i . ', ';
          }
          echo '<br>';

          # For loops compacts what is spread out with while
          for($i = 0; $i < 10; $i++){
            # continue jumps to top of loop to only print odds
            if(($i % 2) == 0){
              continue;
            }
            # Break jumps to the code that follows the loop
            if($i == 7) break;
            echo $i . ', ';
          }
          echo '<br>';

          # foreach can be used to easily cycle through arrays
          # as shown above

          # do while will execute at least once
          $i = 0;
          do {
            echo "Do While : $i<br>";
          } while ($i > 0);

          # ---------- FUNCTIONS ----------
          # Functions allow you to reuse code
          # They must begin with a letter, but can contain
          # numbers and underscores
          # You can pass values to a function and set default values
          # You can define parameter types like this
          # function addNumbers(int $num_1=0, int $num_2=0)
          function addNumbers($num_1=0, $num_2=0){
            # return returns data from where the function
            # was called
            return $num_1 + $num_2;
          }

          printf("5 + 4 = %d<br>", addNumbers(5,4));

          # Functions are pass by value by default so you can't
          # effect values out of the function
          function changeMe($change){
            $change = 10;
          }

          $change = 5;
          changeMe($change);
          echo "Change : $change<br>";

          # You can pass by reference though
          function changeMe2(&$change){
            $change = 10;
          }

          $change = 5;
          changeMe2($change);
          echo "Change : $change<br>";

          # Receive a variable number of parameters
          function getSum(...$nums){
            $sum = 0;
            foreach($nums as $num){
              $sum += $num;
            }
            return $sum;
          }
          printf("Sum = %d<br>", getSum(1,2,3,4));

          # Return multiple values
          function doMath($x, $y){
            return array(
              $x + $y,
              $x - $y
            );
          }
          list($sum, $difference) = doMath(5,4);
          echo "Sum = $sum<br>";
          echo "Difference = $difference<br>";

          # ---------- MAP ----------
          # Apply a function to values in a list
          function double($x){
            return $x * $x;
          }
          $list = [1,2,3,4];
          $dbl_list = array_map('double', $list);
          # Print human readable version of list
          print_r($dbl_list);
          echo '<br>';

          # ---------- REDUCE ----------
          # Reduce values in an array to a single value
          # Multiply each value times the others
          function mult($x, $y){
            $x *= $y;
            return $x;
          }
          $prod = array_reduce($list, 'mult', 1);
          print_r($prod);
          echo '<br>';

          # ---------- FILTER ----------
          # Filter an array with a function
          # Get only even values
          function isEven($x){
            return ($x % 2) == 0;
          }
          $even_list = array_filter($list, 'isEven');
          print_r($even_list);
          echo '<br>';

          # ---------- DATES ----------
          # Set the time zone php.net/manual/en/timezones.php
          date_default_timezone_set('America/New_York');

          # Format date info for now
          # php.net/manual/en/function.date.php
          echo "Date : " . date('l F m-d-Y g:i:s A') . "<br>";

          # Create a date hour, minute, second, month, day, year
          $import_date = mktime(0, 0, 0, 12, 21, 1974);
          echo "Important Date : " . date('l F m-d-Y g:i:s A', $import_date) . "<br>";

          # ---------- INCLUDING OTHER FILES ----------
          # You can insert code from another script with include
          include 'sayhello.php';

        }
      }

      # ---------- EXCEPTION HANDLING ----------
      # Use to avoid a crashed program
      function badDivide($num){
        if($num == 0){
          throw new Exception("You can't divide by zero");
        }
        return $calc = 100 / $num;
      }
      try{
        badDivide(0);
      } catch(Exception $e){
        echo "Exception : " . $e->getMessage();
      }

     ?>

  </body>
</html>