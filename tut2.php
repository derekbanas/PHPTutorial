<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>PHP Tutorial</title>
  </head>
  <body>
    <form action="tut2.php" method="post">
      <label>Email : </label>
      <input type="text" name="email"/><br>
      <label>Number 1 : </label>
      <!-- Protect by setting the correct types
      w3schools.com/html/html_form_input_types.asp -->
      <input type="text" name="num1"/><br>
      <label>Number 2 : </label>
      <input type="text" name="num2"/><br>
      <label>Website : </label>
      <input type="text" name="website"/><br>
      <input type="submit" value="Submit"/>
    </form>
    <?php
    # Check for valid email
    if(isset($_POST["email"])){
      # filter_input gets the value from either INPUT_GET, INPUT_POST,
      # INPUT_COOKIE, INPUT_SERVER, or INPUT_ENV
      # Specify the variable name and any filter to run
      if(!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)){
        echo "Email isn't Valid<br>";
      } else {
        echo "Email is Valid<br>";
      }
    }
    # Verify that the values are numbers with is_numeric
    if(!empty($_POST["num1"]) && !empty($_POST["num2"])){
      # Will delete anything that isn't a float
      $num1 = filter_input(INPUT_POST, 'num1', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $num2 = filter_input(INPUT_POST, 'num2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      # sprintf returns a formatted string
      $output = sprintf("%.1f + %.1f = %.1f", $num1, $num2, ($num1 + $num2));
      # htmlspecialchars escapes output to avoid XSS attacks
      echo htmlspecialchars($output) . '<br>';
    }
    # Validate URL
    if(isset($_POST["website"])){
      $website = filter_input(INPUT_POST, 'website', FILTER_VALIDATE_URL);
      echo 'Website : ' . htmlspecialchars($website) . '<br>';
    }
    # Other Validations : php.net/manual/en/filter.filters.validate.php
    # Sanitization Filters : php.net/manual/en/filter.filters.sanitize.php

    # Converting HTML special characters
    # Convert special characters into HTML entities
    $con_html = '<a href="#">Sample</a>';
    echo $con_html . "<br>";
    # Convert special characters to HTML so it can be displayed
    echo htmlspecialchars($con_html) . "<br>";
    # Strip tags except for a
    echo strip_tags($con_html, '<a>') . "<br>";
    # Eliminate all tags
    $con_html = strip_tags($con_html) . "<br>";
    echo $con_html . "<br>";
     ?>
  </body>
</html>