<?php
$live = false;
define('BASE_URI', dirname(__DIR__));
define('MYSQL', './includes/mysqli.inc.php');
define('BASE_URL', 'http://localhost:4000/'); //PLEASE CHANGE THIS TO OUR BASE URI

session_start();

// function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars)
// {
//     global $live, $contact_email;
//     $message  = "An error occured in script '$e_file' on line $e_line'";
//     $message .= "<pre>" . print_r(debug_backtrace(), 1) . "</pre>";
//     if ($live) {
//         echo '<div class ="error">' . nl2br($message) . '</div>';
//     } else {
//         error_log($message, 1, $contact_email, 'From:admin@gmail.com');
//         if ($e_number != E_NOTICE) {
//             echo '<div class="error> A system error occured. We apologize for the incovenience. </div>';
//         }
//     }
// }


function server_url()
{
    $proto = "http" . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "") . "://";
    $server = isset($_SERVER['HTTP_HOST']) ?
        $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    return $proto . $server;
}

function redirect_rel($relative_url)
{
    $url = server_url() . dirname($_SERVER['PHP_SELF']) . "/" . $relative_url;
    if (!headers_sent()) {
        header("Location: $url");
    } else {
        echo "<meta http-equiv=\"refresh\" content=\"0;url=$url\">\r\n";
    }
}
function redirect_invalid_user($check = 'user_id', $destination = 'index.php')
{
    if (!isset($_SESSION[$check])) {

        redirect_rel($destination);
        // header("Location: $url");
        exit();
    }
    if (!headers_sent()) {
        // Redirect code.
    } else {
        trigger_error('You do not have permission to access this page. Please login and try again.');
    }
}


//set_error_handler('my_error_handler');
