<!DOCTYPE html>
<html>
   <head>
    <meta charset="utf-8" />
    <title>Video 2</title>
  </head>
  <body>
   <?php
     echo "<form action = 'video2.php'>";
     echo "<p>Name <br /> <input type='text' name='name'><br /></p>";
     echo "<p>Category <br /> <input type='text' name='category'><br /></p>";
     echo "<p>Length <br /> <input type='text' name='length'><br /></p>";
     echo "<p><input type='submit' value='Add Video'></p>";
     echo "</form>";
      
    ini_set("display_errors", "On");
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "sunstror-db", "WxWvu6Z5j4Dq2neK", "sunstror-db");
    if(!$mysqli || $mysqli->connect_errno)
    {
      echo "Connection Error ". $mysqli->connect_errno . " " . $mysqli->connect_error;
    }else
        

    if($_SERVER['REQUEST_METHOD'] == 'GET')
    { 
        if ($_GET['name'])
          $val1 = true;
        else 
          $val1 = false;
        if(is_numeric($_GET['length']))
        {
          if(intval($_GET['length']) > 0)
            $val2 = true;
        }else
          $val2 = false;
          
        if ($val1 && $val2)
        {
            $nme = $_GET['name'];
            $cat = $_GET['category'];
            $len = $_GET['length'];
         
            /* Prepared statement, stage 1: prepare */
            if (!($stmt = $mysqli->prepare("INSERT INTO videos(name, category, length) VALUES (?, ?, ?)")))
            {
              echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

            /* Prepared statement, stage 2: bind and execute */
            $name = $nme;
            $category = $cat;
            $length = $len;

            if (!$stmt->bind_param("ssi", $name, $category, $length)) 
            {
              echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) 
            {
              echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }
          
          if (!($stmt = $mysqli->prepare("SELECT * FROM videos")))
            {
              echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }
            if (!$stmt->execute()) 
            {
              echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }
            if(!($stmt->bind_result($vidId, $vidName, $vidCat, $vidLen, $vidRent)))
            {
              echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }
         
            echo "<table border = '1'>";
            while($stmt->fetch())
              {
                echo "<tr>";
                echo "<td> $vidId </td>";
                echo "<td> $vidName </td>";
                echo "<td> $vidCat </td>";
                echo "<td> $vidLen </td>";
                if ($vidRent == '1')
                  echo "<td> available </td>";
                else
                  echo "<td> Checked Out </td>";
                echo "</tr>";
                }
            echo "</table>";
          }else
          if ($val1 == false)
            echo "You need a name to add a video <br>";
          if ($val2== false)
            echo "Length needs to be a positive integer<br>";
      }
        
          
      
    ?>
        <button onclick="window.location.href='video1.php'">Delete All Videos</button>
  </body>
</html>