<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
        if ($point->get_x() < 0 and $point->get_y() < 0)
            return point_belongs_to_area_bottom_left($point, $r);
        if ($point->get_x() < 0 and $point->get_y() > 0)
            return point_belongs_to_area_top_left($point, $r);
        if ($point->get_x() > 0 and $point->get_y() > 0)
            return point_belongs_to_area_top_right($point, $r);
        if ($point->get_x() > 0 and $point->get_y() < 0)
            return point_belongs_to_area_bottom_right($point, $r);
        return false;
    }

    function point_belongs_to_area_top_right(Point $point, float $r): bool
    {
        return $point->get_x() < ($r / 2) and $point->get_y() < $r;
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
        return -1 * $r <= $point->get_x() and point->get_x() <= (r / 2);
    }

    function point_belongs_area_x_zero(Point $point, float $r): bool
    {
        return -1 * ($r / 2) <= $point->get_y() and $point->get_y() < $r;
    }

    //TODO: use this when r button is fixed
    // $all_input_received = isset($_GET["x-input"]) and isset($_GET["y-input"]) and isset($_GET["r-input"]);
    $all_input_received = isset($_GET["x-input"]) and isset($_GET["y-input"]);
    if ($all_input_received)
        echo $_GET["x-input"] . "<br>" . $_GET["y-input"] . "<br>" . $_GET["r-input"] . "</p>";

echo "<p>Предыдущие запросы:</p>";

foreach ($_SESSION['request_history'] as $user_request) {
    echo "<p>" . "Request" . $user_request->getPoint()->getX() . $user_request->getPoint()->getY() . $user_request->getR() . "</p>";
}

    function add_previous_request_to_session()
    {
        $point = new Point($_GET["x-input"], $_GET["y-input"]);
        $request = new UserRequest($point, $_GET["r-input"]);

        // if request history is empty then initialize it as an empty array before adding a new request
        if (!isset($_SESSION['request_history']))
            $_SESSION['request_history'] = [];

        $_SESSION['request_history'][] = $request;
    }

if ($all_input_received)
    add_previous_request_to_session();
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
    <input type="button" id="r-equals-0.5-radio" name="r-input" value="0,5">
    <label for="r-equals-0.5-input">0,5</label><br>
    <input type="button" id="r-equals-1-radio" name="r-input" value="1">
    <label for="r-equals-1-input">1</label>
</form>

<script src="js/script.js"></script>
</body>

</html>
