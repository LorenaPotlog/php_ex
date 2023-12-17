<?php
if ($_FILES["image"]["error"] > 0) {
    echo "Error: No image was uploaded";
} else {

    // Load the ntc.js file
    $ntc = file_get_contents('ntc.js');

    $image = $_FILES["image"]["tmp_name"];

    // Create an image resource from the uploaded image
    $img = imagecreatefromstring(file_get_contents($image));

    $colors = [];

    // Loop through each pixel to count color occurrences
    for ($x = 0; $x < imagesx($img); $x++) {
        for ($y = 0; $y < imagesy($img); $y++) {
            $rgb = imagecolorat($img, $x, $y);
            $color = imagecolorsforindex($img, $rgb);

            // Convert RGB to hexadecimal color code
            $hexColor = sprintf("#%02x%02x%02x", $color['red'], $color['green'], $color['blue']);

            // Increment color count or set to 1 if not present
            if (array_key_exists($hexColor, $colors)) {
                $colors[$hexColor]++;
            } else {
                $colors[$hexColor] = 1;
            }
        }
    }

    // Sort colors by frequency
    arsort($colors);

    // Extract the top 3 predominant colors
    $top3Colors = array_slice(array_keys($colors), 0, 3);

    // Create a merged image with white background to display the color squares and names
    $mergedImage = imagecreatetruecolor(250, 150);
    $white = imagecolorallocate($mergedImage, 255, 255, 255); // White color
    imagefill($mergedImage, 0, 0, $white); // Fill with white

    $xPos = 10;
    $yPos = 70;

    // Generate color squares and label them with CSS color codes and names
    foreach ($top3Colors as $hexColor) {
        // Create a new image for each color
        $colorImg = imagecreatetruecolor(50, 50);

        // Allocate color using the hex code
        sscanf($hexColor, "#%02x%02x%02x", $red, $green, $blue);
        $color = imagecolorallocate($colorImg, $red, $green, $blue);
        imagefill($colorImg, 0, 0, $color);

        // Merge the color square into the merged image
        imagecopy($mergedImage, $colorImg, $xPos, 10, 0, 0, 50, 50);

        // Add CSS color code label to the color square on the merged image
        imagestring($mergedImage, 3, $xPos + 10, $yPos, $hexColor, 0x000000);

        // Use ntc.js to get the color name
        preg_match("/\[(.*?)\]/", $ntc, $matches);
        $colorName = $matches[1] ;

        // Add color name label to the color square on the merged image
        imagestring($mergedImage, 3, $xPos + 10, $yPos + 20, $colorName, 0x000000);

        $xPos += 70;

        imagedestroy($colorImg);
    }

    // Output the merged image with CSS color code labels and names
    header('Content-type: image/png');
    imagepng($mergedImage); // Output to browser

    // Clean up resources
    imagedestroy($mergedImage);
    imagedestroy($img);
}
?>