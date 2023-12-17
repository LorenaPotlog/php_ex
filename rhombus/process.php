<?php

function generateRhombusImage($n): void
{
    $imgWidth = $n * 10;
    $imgHeight = $n * 10;

    $image = imagecreatetruecolor($imgWidth, $imgHeight);

    $backgroundColor = imagecolorallocate($image, 255, 192, 203);
    $lineColor = imagecolorallocate($image, 255, 255, 255);

    imagefill($image, 0, 0, $backgroundColor);

    $halfWidth = $imgWidth / 2;
    $halfHeight = $imgHeight / 2;

    $x1 = $halfWidth; // Top
    $y1 = $halfHeight - ($n * 10 / 2);

    $x2 = $halfWidth + ($n * 10 / 2); // Right
    $y2 = $halfHeight;

    $x3 = $halfWidth; // Bottom
    $y3 = $halfHeight + ($n * 10 / 2);

    $x4 = $halfWidth - ($n * 10 / 2); // Left
    $y4 = $halfHeight;

    imageline($image, $x1, $y1, $x2, $y2, $lineColor);
    imageline($image, $x2, $y2, $x3, $y3, $lineColor);
    imageline($image, $x3, $y3, $x4, $y4, $lineColor);
    imageline($image, $x4, $y4, $x1, $y1, $lineColor);

    header('Content-type: image/png');
    imagepng($image);

    imagedestroy($image);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['number'])) {
    $num = intval($_GET['number']);
    generateRhombusImage($num);
}