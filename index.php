 <!-- include "db.php" under php codes is to check if database is connected -->


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Notifications</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js" ></script>
    </head>
<body>
    
            <br /><br />
            <div class="container">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid">
                        <div class="navbar-header">
                        <a class="navbar-brand" href="#">PHP Notifications</a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
                                <ul class="dropdown-menu"></ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            <br />

            
                <form method="post" id="comment_form">
                <div class="form-group">
                    <label>Enter Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control">
                </div>
                <div class="form-group">
                    <label>Enter Comment</label>
                    <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
                </div>
                </form>

            </div>
        


</body>


<script>

    //this fuction (console.log('succeed')) to check if jquery works
    $(document).ready(function () {

        function showUnreadNotifications(option =''){
            
            $.ajax({
                url:'fetch.php',
                method:'POST',
                data: {option: option},
                dataType: 'JSON',
                success: function(data){

                    //console.log(data);
                    $('.dropdown-menu').html(data.notification);

                        if (data.unseen_notification >0){

                            $('.count').html(data.unseen_notification);

                        }

                }

            });
        }

        showUnreadNotifications();
        
        $('#comment_form').on('submit',function(event){
            event.preventDefault();
            //console.log('summited');

            if ($('#subject').val() != '' && $('#comment').val()!= ''){
                //console.log('they are not empty.');

                var formData = $(this).serialize();

                $.ajax({
                    url:'insert.php',
                    method:'POST',
                    data: formData,
                    success: function(data){
                        $('#comment_form')[0].reset();
                        showUnreadNotifications();
                    }

                });
            } else {

                alert('Hey you need to fill both fields now.')
            }
        

        
        
    });

    $(document).on('click', '.dropdown-toggle', function(){

        $('.count').html('');

    })

    setInterval(function(){
        showUnreadNotifications();
                
    }, 5000);
                
    

});


</script>



</html>
