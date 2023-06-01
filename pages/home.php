<?php
    $database = connectToDB();

    $sql = 'SELECT * FROM users';
    $query = $database->prepare($sql);
    $query->execute();
    $user = $query->fetchAll();

    require 'parts/header.php';

?>
<div class="container my-5 mx-auto" style="max-width: 700px;">
    <h1 class="h1 mb-4 text-center">Customer Service Feedback Form</h1>
    <div class="gap-3">
        <div class="text-center justify-content-center">
            
                <?php if ( isset( $_SESSION["user"] ) ) { ?>
                    
                <?php } else { ?>
                
                    <h4>Please Login with your existing account or sign up a new account to continue</h4>
                    <a href="/login" class="btn btn-primary">Login</a>
                    <a href="/signup" class="btn btn-primary">Sign Up</a>
                
                <?php } ?>
                </div>
            </div>

<?php if ( isset( $_SESSION["user"] ) ) { ?>
    <div class="card p-4">
        <?php require dirname(__DIR__) .  '/parts/message_error.php'; ?>
        <?php require dirname(__DIR__) .  '/parts/message_success.php'; ?>
        <?php require dirname(__DIR__) .  '/parts/questions.php'; ?>
    </div>

    <div class="text-center mt-4">
        <a href="/results" class="btn btn-inverse">View Results</a>    
        <a href="/logout" class="btn btn-inverse">LogOut</a>
</div>
<?php } ?>

<?php

    require 'parts/footer.php';