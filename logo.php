<?php
// Set the font size and name
$fontSize = 60;
$fontFile = 'arial.ttf';

// Set the text to display
$text = 'LoveMaters';

// Set the image width and height
$imageWidth = 500;
$imageHeight = 100;

// Create a new image with the specified dimensions
$image = imagecreate($imageWidth, $imageHeight);

// Set the background color to white
$backgroundColor = imagecolorallocate($image, 255, 255, 255);

// Set the text color to black
$textColor = imagecolorallocate($image, 0, 0, 0);

// Set the text shadow color to gray
$textShadowColor = imagecolorallocate($image, 128, 128, 128);

// Add the text shadow
imagettftext($image, $fontSize, 0, 60, 80, $textShadowColor, $fontFile, $text);

// Add the text
imagettftext($image, $fontSize, 0, 50, 70, $textColor, $fontFile, $text);

// Output the image as a PNG
header('Content-Type: images/png');
imagepng($image);

// Destroy the image to free up memory
imagedestroy($image);
?>
