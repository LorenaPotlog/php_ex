<!--Generates a rhombus/diamond with a given (n) sides length .-->
<!DOCTYPE html>
<html>
<head>
    <title>Romb</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        pre {
            display: inline-block;
            text-align: left;
        }
    </style>
</head>
<body>

<form method="post" action="">
    <label for="number">Enter a number:</label>
    <input type="text" id="number" name="number">
    <input type="submit" value="Generate">
</form>

<?php
function generateRhomb($n) {
    $pattern = '';

    for ($i = 1; $i <= $n; $i++) {
        $pattern .= str_repeat("X ", 2 * $i - 1) . "<br>";
    }

    for ($i = $n - 1; $i >= 1; $i--) {
        $pattern .= str_repeat("X ", 2 * $i - 1) . "<br>";
    }

    return $pattern;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['number'])) {
    $number = $_POST['number'];
    $rhombus = generateRhomb($number);
    echo $rhombus;
}
?>

</body>
</html>