<?php

    // load database
    $database = connectToDB();

    // load all the questions
    $sql = "SELECT * FROM questions";
    $query = $database->prepare($sql);
    $query->execute();
    $questions = $query->fetchAll();

    /* 
        do error checking
        - make sure the name & email fields are not empty
        - make sure all the questions are answered
    */
    // if ( empty($name) || empty($email) ){
    //     $error = 'All Fields are Required';
    // }
        
     // loop through all the questions to make sure all the answers are set
    foreach ( $questions as $question ) {
        // use isset() to check if there is an answer for the question. If this is no answer, assign the error message to $error
        if ( !isset( $_POST["q" . $question['id']] ) ) {
            $error = "All the questions need to be answered";
        }
    }

    // if $error is set, redirect to home page
    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header( 'Location: /' );
        exit;
    }

    // if no error, loop through all the questions to insert the answer to the results table
    foreach ( $questions as $question ) {
        // sql recipe
        $sql = "INSERT INTO results ( question_id, answer, user_id ) VALUES ( :question_id, :answer, :user_id )";
        // prepare
        $query =$database->prepare( $sql );
        // execute
        $query->execute([
            'question_id' => $question['id'],
            'answer' => $_POST["q" . $question['id']],
            'user_id' => $_SESSION['user']['id']
        ]);
    }
    

    // set success message
    $_SESSION['success'] = "Feedback Submitted Successfully";

    // redirect to home page
    header( 'Location: /' );
    exit;


