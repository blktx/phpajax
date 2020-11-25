<?php
    include "db.php";

    if(isset($_POST['option'])){

        if($_POST['option'] != ''){

            $update = "UPDATE comments SET comment_status = 1 WHERE comment_status = 0";
            mysqli_query($db, $update);
        }

        $query = "SELECT * from comments ORDER BY comment_id DESC LIMIT 10";
        $result = mysqli_query($db, $query);
        $output = '';

        if(mysqli_num_rows($result) > 0){
            
            while($row=mysqli_fetch_array($result)){

                $output.="
                    <li>
                    <a href='#'>
                    <strong>".$row["comment_subject"]."</strong><br/>
                    <small><em>".$row["comment_text"]."</em></small>
                    </a>
                    </li>

                ";
            } 
            
        } else {

            $output .= "
                <li>
                <a href='#' class='text-bold text-italic'>
                    No New Order Found
                </a>
            
                </li>
            
            ";

        }

        $status_query = "SELECT * FROM comments WHERE comment_status=0";
        $result_query = mysqli_query($db, $status_query);
        $count = mysqli_num_rows($result_query);
        $data = array(
         'notification' => $output,
         'unseen_notification'  => $count
         );
         echo json_encode($data);
    }
