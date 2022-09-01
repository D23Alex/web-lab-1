<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<p><?php
    if (isset($_GET["x-input"]))
        echo $_GET["x-input"] . "<br>";
    if (isset($_GET["y-input"]))
        echo $_GET["y-input"] . "<br>";
    if (isset($_GET["r-input"]))
        echo $_GET["r-input"] . "<br>";
    ?></p>
<p>Hello, world! [from index.php]</p>
<form method="get">
    <p>X</p>
    <input type="radio" id="x-equals-0.5-radio" name="x-input" value="0,5">
    <label for="x-equals-0.5-input">0,5</label><br>
    <input type="radio" id="x-equals-1-radio" name="x-input" value="1">
    <label for="x-equals-1-input">1</label>
    <p>Y</p>
    <input type="text" id="y-text-input" name="y-input">
    <label for="y-text-input">label-for-Y</label>
    <p>R</p>
    <input type="button" id="r-equals-0.5-radio" name="r-input" value="0,5">
    <label for="r-equals-0.5-input">0,5</label><br>
    <input type="button" id="r-equals-1-radio" name="r-input" value="1">
    <label for="r-equals-1-input">1</label>
</form>

<script src="js/script.js"></script>
</body>

</html>
