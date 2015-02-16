<!DOCTYPE html>
<html>
   <head>
  	<meta charset="utf-8" />
  	<title>Video 1</title>
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
        

      /* Non-prepared statement */
      if (!$mysqli->query("DROP TABLE IF EXISTS videos") || !$mysqli->query("CREATE TABLE videos(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            name VARCHAR(255) UNIQUE NOT NULL, category VARCHAR(255), length INT UNSIGNED, rented BOOLEAN NOT NULL DEFAULT 1)")) 
            {
              echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
            }

        
    ?>
    <button onclick="window.location.href='video1.php'">Delete All Videos</button>
  </body>
</html>