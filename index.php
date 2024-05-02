<?php

// 328/Week2/dinner/index.php
// This is my CONTROLLER!

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');

// Instantiate the F3 Base class
$f3 = Base::instance();

// Define a default route
// https://ayadgari.greenriverdev.com/328/Week2/dinner/index.php

$f3->route('GET /', function() {
//    echo '<h1>Hello pets</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});


$f3->route('GET|POST /survey', function ($f3)
{

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        // Capture userName from the POST request
        $userName = isset($_POST['userName']) ? $_POST['userName'] : 'Anonymous';

        // Set it into the session
        $f3->set('SESSION.userName', $userName);



        //var_dump($_POST);
        // Get the data from the post array
        if (isset($_POST['surv']))
            $surveys = implode(", ", $_POST['surv']);
        else
            $surveys = "None selected";

        // If the data valid
        if (true) {

            // Add the data to the session array
            $f3->set('SESSION.surveys', $surveys);

            // Send the user to the next form
            $f3->reroute('summary');
        } else {
            // Temporary
            echo "<p>Validation errors</p>";
        }
    }


    // Get the data from the model
    $surv = getSurvey();
    $f3->set('surv', $surv);

    $view = new Template();
    echo $view->render('views/survey.html');
});



// Order Summary
$f3->route('GET /summary', function () {


    // Render a view page
    $view = new Template();
    echo $view->render('views/summary.html');
});


// Run Fat-Free
$f3->run();