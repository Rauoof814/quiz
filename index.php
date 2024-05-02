<?php

// 328/Week2/dinner/index.php
// This is my CONTROLLER!

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once ('vendor/autoload.php');

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

    // Check if the for has been posted
//    if ($_SERVER['REQUEST METHOD'] == 'POST')
//        {
//            echo "'POST' method was used ;)";
//        }
//    else
//    {
//        echo "'GET' method was used :)";
//    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        // Get the data
        $pet = $_POST['pet'];
        $color = $_POST['color'];

        // Validate the data
        if (empty($pet))
        {
            // Data is invalid
            echo "Please supply a pet type :)";
        }
        else
        {
            // Data is valid
            $f3->set('SESSION.pet', $pet);
            $f3->set('SESSION.color', $color);

            //**** Add the color of the session
            //Redirect to the summary route
            $f3->reroute("summary");
        }
    }

    $view = new Template();
    echo $view->render('views/survey.html');
});



// Order Summary
$f3->route('GET /summary', function () {


    // Render a view page
    $view = new Template();
    echo $view->render('views/order-summary.html');
});


// Run Fat-Free
$f3->run();