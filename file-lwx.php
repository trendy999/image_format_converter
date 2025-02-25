<?php
// upload.php
if (isset($_FILES['files'])) {
    $outputFormat = $_POST['outputFormat'];
    $quality = $_POST['quality'];
    $resolution = $_POST['resolution'];

    $uploadDir = 'uploads/';
    $convertedDir = 'converted/';

    foreach ($_FILES['files']['tmp_name'] as $key => $tmpFile) {
        $originalName = $_FILES['files']['name'][$key];
        $fileExtension = pathinfo($originalName, PATHINFO_EXTENSION);
        $newFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $newFileName;
        $convertedPath = $convertedDir . $newFileName;

        move_uploaded_file($tmpFile, $uploadPath);

        // Convert the image using the appropriate command based on the selected output format
        // For example, using ImageMagick
        switch ($outputFormat) {
            case 'jpg':
                $command = "convert -quality $quality% -density $resolution $uploadPath $convertedPath";
                break;
            case 'png':
                $command = "convert -quality $quality% -density $resolution $uploadPath $convertedPath";
                break;
            case 'gif':
                $command = "convert -quality $quality% -density $resolution $uploadPath $convertedPath";
                break;
            case 'bmp':
                $command = "convert -quality $quality% -density $resolution $uploadPath $convertedPath";
                break;
        }

        exec($command);

        // Delete the original file after conversion
        unlink($uploadPath);
    }
}