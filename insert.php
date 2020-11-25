<?php

    if(isset($_POST['subject'])){

        include "db.php";
        $subject = mysqli_real_escape_string($db, $_POST["subject"]);
        $comment = mysqli_real_escape_string($db, $_POST["comment"]);
        $query = "INSERT INTO comments(comment_subject, comment_text)VALUES ('$subject', '$comment')";
        $result = mysqli_query($db, $query);

        if (!$result){
            
            die("This went bad" . mysqli_error($db));
        }

    }
  

