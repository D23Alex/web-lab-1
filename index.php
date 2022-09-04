<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/TODO-this-style.css" rel="stylesheet">
</head>

<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $history_exists = (isset($_SESSION['x_history'])) && (isset($_SESSION['y_history'])) && (isset($_SESSION['r_history']));
    if (!$history_exists) {
        $_SESSION['x_history'] = [];
        $_SESSION['y_history'] = [];
        $_SESSION['r_history'] = [];
    }
}

?>

<p>
    <?php

    class Point
    {

        private $x;
        private $y;


        public function __construct($x, $y)
        {
            $this->x = $x;
            $this->y = $y;
        }


        public function getX()
        {
            return $this->x;
        }

        public function setX($x)
        {
            $this->x = $x;
        }

        public function getY()
        {
            return $this->y;
        }

        public function setY($y)
        {
            $this->y = $y;
        }


    }

    class UserRequest
    {
        private $point;
        private $r;


        public function __construct($point, $r)
        {
            $this->point = $point;
            $this->r = $r;
        }


        public function getPoint()
        {
            return $this->point;
        }

        public function setPoint($point)
        {
            $this->point = $point;
        }

        public function getR()
        {
            return $this->r;
        }

        public function setR($r)
        {
            $this->r = $r;
        }

    }



    function point_belongs_area(Point $point, float $r): bool
    {
        if ($point->getX() == 0)
            return point_belongs_area_x_zero($point, $r);
        if ($point->getY() == 0)
            return point_belongs_area_y_zero($point, $r);
        if ($point->getX() < 0 && $point->getY() < 0)
            return point_belongs_to_area_bottom_left($point, $r);
        if ($point->getX() < 0 && $point->getY() > 0)
            return point_belongs_to_area_top_left($point, $r);
        if ($point->getX() > 0 && $point->getY() > 0)
            return point_belongs_to_area_top_right($point, $r);
        if ($point->getX() > 0 && $point->getY() < 0)
            return point_belongs_to_area_bottom_right($point, $r);
        return false;
    }

    //TODO: LOGIC MIGHT CONTAIN MISTAKES
    function point_belongs_to_area_top_right(Point $point, float $r): bool
    {
        return $point->getX() < ($r / 2) && $point->getY() < $r;
    }

    function point_belongs_to_area_bottom_right(Point $point, float $r): bool
    {
        return $point->getX() ** 2 + $point->getY() ** 2 < $r ** 2;
    }

    function point_belongs_to_area_top_left(Point $point, float $r): bool
    {
        return $point->getX() + $point->getY() < $r;
    }

    function point_belongs_to_area_bottom_left(Point $point, float $r): bool
    {
        return false;
    }

    function point_belongs_area_y_zero(Point $point, float $r): bool
    {
        return -1 * $r <= $point->getX() && point->getX() <= (r / 2);
    }

    function point_belongs_area_x_zero(Point $point, float $r): bool
    {
        return -1 * ($r / 2) <= $point->getY() && $point->getY() < $r;
    }

    $all_input_received = isset($_GET["x-input"]) && isset($_GET["y-input"]) && isset($_GET["r-input"]);
    if ($all_input_received)
        echo $_GET["x-input"] . "<br>" . $_GET["y-input"] . "<br>" . $_GET["r-input"] . "</br>";

echo "<br>" . "Request history:";


function construct_request_history(): array
{
    $request_history = array();
    foreach ($_SESSION['x_history'] as $request_id=>$x) {
        $point = new Point($_SESSION['x_history'][$request_id], $_SESSION['y_history'][$request_id]);
        $r = $_SESSION['r_history'][$request_id];
        $user_request = new UserRequest($point, $r);
        $request_history[] = $user_request;
    }
    return $request_history;
}

$request_history_exists = isset($_SESSION['x_history']) && isset($_SESSION['y_history']) &&
    isset($_SESSION['r_history']);
$request_history_valid = (count($_SESSION['x_history']) == count($_SESSION['y_history'])) &&
    (count($_SESSION['r_history']) == count($_SESSION['y_history']));
if ($request_history_exists && $request_history_valid) {
    $request_history = construct_request_history();
    foreach ($request_history as $user_request) {
        echo "<br>" . $user_request->getPoint()->getX();
        echo "<br>" . $user_request->getPoint()->getY();
        echo "<br>" . $user_request->getR();
    }
}

    function add_current_request_to_history()
    {

        $current_request_same_as_last = (end($_SESSION['x_history']) == $_GET["x-input"]) &&
            (end($_SESSION['y_history']) == $_GET["y-input"]) &&
            (end($_SESSION['r_history']) == $_GET["r-input"]);

        if (!$current_request_same_as_last) {
            $_SESSION['x_history'][] = $_GET["x-input"];
            $_SESSION['y_history'][] = $_GET["y-input"];
            $_SESSION['r_history'][] = $_GET["r-input"];
        }
    }

if ($all_input_received) {
    add_current_request_to_history();
}

?>
<p>Hello, world! [from index.php]</p>
<form method="get" action="/">
    <p>X</p>
    <input type="radio" id="x-equals-0.5-radio" name="x-input" value="0,5">
    <label for="x-equals-0.5-input">0,5</label><br>
    <input type="radio" id="x-equals-1-radio" name="x-input" value="1">
    <label for="x-equals-1-input">1</label>
    <p>Y</p>
    <input type="text" id="y-text-input" name="y-input">
    <label for="y-text-input">label-for-Y</label>
    <p>R</p>

    <!--
    <input type="button" id="r-equals-0.5-radio" name="r-input" value="0,5">
    <label for="r-equals-0.5-input">0,5</label><br>
    <input type="button" id="r-equals-1-radio" name="r-input" value="1">
    <label for="r-equals-1-input">1</label>
    -->

    <!-- fake R -->
    <input type="text" id="r-text-input" name="r-input">
    <label for="r-text-input">label-for-R</label>
    <button type="submit">SUBMIT BUTTON</button>

</form>

<script src="js/script.js"></script>
</body>

</html>
