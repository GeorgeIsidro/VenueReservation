<?php
// Retrieve the temporary file name from the URL parameter
if (isset($_GET['file'])) {
  $tempFileName = $_GET['file'];
  $tempFilePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . urldecode($tempFileName);

  // Check if the file exists before reading and outputting its content
  if (file_exists($tempFilePath)) {
    // Set the appropriate headers for file download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="reservations.txt"');
    header('Content-Length: ' . filesize($tempFilePath));

    // Read and output the file content
    readfile($tempFilePath);

    // Delete the temporary file
    unlink($tempFilePath);
    exit;
  } else {
    // If the file doesn't exist, handle the error
    header("HTTP/1.0 404 Not Found");
    exit;
  }
}
?>
