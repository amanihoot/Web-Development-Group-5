<!DOCTYPE html>
<html>
<head>
  <title>ordering Entry Results</title>
</head>
<body>
  <h1>ordering Entry Results</h1>
  <?php

     if (!isset($_POST['Name']) || !isset($_POST['Food']) 
         || !isset($_POST['Price']) || !isset($_POST['Address'])
         || !isset($_POST['City'])) {
       echo "<p>You have not entered all the required details.<br />
             Please go back and try again.</p>";
       exit;
    }

    // create short variable names
    $Name=$_POST['Name'];
    $Food=$_POST['Food'];
    $price=$_POST['Price'];
    $Address=$_POST['Address'];
    $City=$_POST['City'];
    $price = doubleval($price);

    @$db = new mysqli('localhost', 'root', '', 'bakery');

    if (mysqli_connect_errno()) {
       echo "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
       exit;
    }

    $query = "INSERT INTO customers ( Name, Address, City) VALUES ( ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $Name, $Address, $City);
    $stmt->execute();

    $query = "INSERT INTO foods VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sd', $Food, $price);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo  "<p>Order summited into the database.</p>";
    } else {
        echo "<p>An error has occurred.<br/>
              The item was not added.</p>";
    }
  
    $db->close();
  ?>
</body>
</html>
