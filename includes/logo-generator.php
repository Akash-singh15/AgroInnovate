<?php
header('Content-Type: image/png');

// Create a 400x200 image
$image = imagecreatetruecolor(400, 200);

// Enable alpha blending
imagealphablending($image, true);
imagesavealpha($image, true);

// Create a white background
$white = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $white);

// Colors
$darkGreen = imagecolorallocate($image, 27, 94, 32);  // #1B5E20
$midGreen = imagecolorallocate($image, 46, 125, 50);  // #2E7D32
$lightGreen = imagecolorallocate($image, 76, 175, 80); // #4CAF50
$darkOrange = imagecolorallocate($image, 255, 111, 0); // #FF6F00
$midOrange = imagecolorallocate($image, 255, 160, 0);  // #FFA000
$lightOrange = imagecolorallocate($image, 255, 213, 79); // #FFD54F
$black = imagecolorallocate($image, 51, 51, 51);       // #333333

// Draw the gear
$centerX = 130;
$centerY = 100;
$outerRadius = 50;
$innerRadius = 35;
$spikes = 8;

for ($i = 0; $i < $spikes * 2; $i++) {
    $radius = $i % 2 === 0 ? $outerRadius : $innerRadius;
    $angle1 = (M_PI / $spikes) * $i;
    $angle2 = (M_PI / $spikes) * (($i + 1) % ($spikes * 2));
    
    $x1 = $centerX + $radius * cos($angle1);
    $y1 = $centerY + $radius * sin($angle1);
    $x2 = $centerX + $radius * cos($angle2);
    $y2 = $centerY + $radius * sin($angle2);
    
    // Fill with gradient (simplified)
    if ($i % 2 === 0) {
        imagefilledpolygon($image, [$centerX, $centerY, $x1, $y1, $x2, $y2], 3, $midOrange);
    } else {
        imagefilledpolygon($image, [$centerX, $centerY, $x1, $y1, $x2, $y2], 3, $darkOrange);
    }
}

// Add inner circle to gear
imagefilledellipse($image, $centerX, $centerY, $innerRadius * 1.2, $innerRadius * 1.2, $lightOrange);

// Draw the leaf (simplified)
$leafSize = 70;
$points = [];

// Create leaf shape with bezier approximation using multiple lines
for ($t = 0; $t <= 1; $t += 0.05) {
    // Right side curve
    $px = $centerX + $leafSize/2 * (1-$t) * (1-$t) * $t * 3;
    $py = $centerY - $leafSize/2 + $leafSize * $t;
    $points[] = $px;
    $points[] = $py;
}

for ($t = 0; $t <= 1; $t += 0.05) {
    // Left side curve
    $px = $centerX - $leafSize/2 * (1-$t) * (1-$t) * $t * 3;
    $py = $centerY + $leafSize/2 - $leafSize * $t;
    $points[] = $px;
    $points[] = $py;
}

// Fill the leaf
imagefilledpolygon($image, $points, count($points)/2, $lightGreen);

// Add leaf vein
imageline($image, $centerX, $centerY - $leafSize/2, $centerX, $centerY + $leafSize/2, $darkGreen);

// Add text
$font = 5; // Built-in font
imagestring($image, $font, 190, 75, 'Agro', $black);
imagestring($image, $font, 190, 105, 'Innovate', $lightGreen);

// Output the image
imagepng($image);
imagedestroy($image);
?> 