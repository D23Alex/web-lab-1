<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION['x_history'] = [];
    $_SESSION['y_history'] = [];
    $_SESSION['r_history'] = [];
}

?>
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

        public function get_x(): float
        {
            return $this->x;
        }

        public function get_y(): float
        {
            return $this->y;
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
        if ($point->get_x() == 0)
            return point_belongs_area_x_zero($point, $r);
        if ($point->get_y() == 0)
            return point_belongs_area_y_zero($point, $r);
        if ($point->get_x() < 0 && $point->get_y() < 0)
            return point_belongs_to_area_bottom_left($point, $r);
        if ($point->get_x() < 0 && $point->get_y() > 0)
            return point_belongs_to_area_top_left($point, $r);
        if ($point->get_x() > 0 && $point->get_y() > 0)
            return point_belongs_to_area_top_right($point, $r);
        if ($point->get_x() > 0 && $point->get_y() < 0)
            return point_belongs_to_area_bottom_right($point, $r);
        return false;
    }

    function point_belongs_to_area_top_right(Point $point, float $r): bool
    {
        return $point->get_x() < ($r / 2) && $point->get_y() < $r;
    }

    function point_belongs_to_area_bottom_right(Point $point, float $r): bool
    {
        return $point->get_x() ** 2 + $point->get_y() ** 2 < $r ** 2;
    }

    function point_belongs_to_area_top_left(Point $point, float $r): bool
    {
        return $point->get_x() + $point->get_y() < $r;
    }

    function point_belongs_to_area_bottom_left(Point $point, float $r): bool
    {
        return false;
    }

    function point_belongs_area_y_zero(Point $point, float $r): bool
    {
        return -1 * $r <= $point->get_x() && point->get_x() <= (r / 2);
    }

    function point_belongs_area_x_zero(Point $point, float $r): bool
    {
        return -1 * ($r / 2) <= $point->get_y() && $point->get_y() < $r;
    }

    //TODO: use this when r button is fixed
    // $all_input_received = isset($_GET["x-input"]) and isset($_GET["y-input"]) and isset($_GET["r-input"]);
    $all_input_received = isset($_GET["x-input"]) && isset($_GET["y-input"]);
    if ($all_input_received)
        echo $_GET["x-input"] . "<br>" . $_GET["y-input"] . "<br>" . $_GET["r-input"] . "</br>";

echo "<br>" . "Request history:";


function construct_request_history(): array
{
    $request_history = array();
    echo "debug4.1";
    echo " _SESSION['x_history'] has this amount of elements in it: " . count($_SESSION['x_history']);
    foreach ($_SESSION['x_history'] as $request_id=>$x) {
        echo "debug4.2";
        $point = new Point($_SESSION['x_history'][$request_id], $_SESSION['y_history'][$request_id]);
        echo "debug4.3";
        $r = $_SESSION['r_history'][$request_id];
        echo "debug4.4";
        $user_request = new UserRequest($point, $r);
        echo "debug4.5";
        $request_history[] = $user_request;
        echo "debug4.6";
    }
    echo "debug4.7";
    return $request_history;
}

echo "debug1";
$request_history_exists = isset($_SESSION['x_history']) && isset($_SESSION['y_history']) &&
    isset($_SESSION['r_history']);
echo "debug2";
$request_history_valid = (count($_SESSION['x_history']) == count($_SESSION['y_history'])) &&
    (count($_SESSION['r_history']) == count($_SESSION['y_history']));
echo "debug3";
if ($request_history_exists && $request_history_valid) {
    echo "debug4";
    //TODO: fix that this is somehow empty
    $request_history = construct_request_history();
    //TODO: output history
    echo "debug5";
    foreach ($request_history as $user_request) {
        echo "debug6";
        echo "<br>" . $user_request->getPoint()->getX();
        echo "debug7";
        echo "<br>" . $user_request->getPoint()->getY();
        echo "<br>" . $user_request->getR();
    }
    echo "debug7.5";
}



echo "aaa";

    function add_current_request_to_history()
    {
        echo "debug9";
        echo " _SESSION['x_history'] has this amount of elements in it: " . count($_SESSION['x_history']);
        $_SESSION['x_history'][] = $_GET["x-input"];
        echo " _SESSION['x_history'] has this amount of elements in it: " . count($_SESSION['x_history']);
        echo "debug10";
        $_SESSION['y_history'][] = $_GET["y-input"];
        $_SESSION['r_history'][] = $_GET["r-input"];
        echo "debug11";
    }

if ($all_input_received) {
    echo "debug8";
    add_current_request_to_history();
}

?>
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
