<?php
session_start();
// var_dump($_POST);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $captcha = $_POST['g-recaptcha-response'];
    if(!empty($_POST['g-recaptcha-response'])){
        $segretKey = "your segret keys";
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$segretKey.'&response='.$captcha;
        $response = file_get_contents($url);
        $response = json_decode($response);
        if($response->success){
            $_SESSION['pass'] = "Form Submited";
            header('Location:http://localhost/any_form_captcha/');
            exit();
        }else{
            $_SESSION['fail'] = "Catpcha Error Please try again !";
        }
    }else{
        $_SESSION['fail'] = "Catpcha Error Please try again !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn To Intigrate Google Captcha v2</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<style>
    .form-v2{
        padding: 10px;
        border: 1px solid;
    }
</style>

<body>
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="text-center">
                        <h3 style="">Google reCaptcha v2</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <?php if(isset($_SESSION['pass'])){ ?> <p class="alert alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $_SESSION['pass']; ?>
                    </p> <?php  unset($_SESSION['pass']); } ?>
                </div>
                <div class="col-lg-4 offset-lg-4">
                    <form action="" method="post" class="form-v2">
                        <div class="form-group">
                            <label for="">username</label>
                            <input type="text" name="username" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">user email</label>
                            <input type="text" name="useremail" class="form-control" id="">
                        </div>
                        <div class="g-recaptcha" data-sitekey="your site keys"  data-theme="light"></div>
                        <p style="color:red;">
                            <?php if(isset($_SESSION['fail'])){ echo $_SESSION['fail'];  } unset($_SESSION['fail']); ?>
                        </p>
                        <input type="submit" class="btn btn-info" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
<script>
$(document).ready(function() {

});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>