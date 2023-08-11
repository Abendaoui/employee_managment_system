<?php
// 404.php
http_response_code(404); // Set the response code to 404
include('./views/html/error-404.html'); // Include the custom HTML content
exit();
