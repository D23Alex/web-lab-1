<?php

function init()
{
    require "datatypes.php";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        $history_exists = (isset($_SESSION['x_history'])) && (isset($_SESSION['y_history'])) && (isset($_SESSION['r_history']));
        if (!$history_exists) {
            $_SESSION['x_history'] = [];
            $_SESSION['y_history'] = [];
            $_SESSION['r_history'] = [];
        }
    }
}

function main_script()
{
    require "__header.inc.php";
    render_main_content();
    require "__footer.inc.php";
}

function render_main_content()
{
    render_until_control_content();

    render_system_of_axis();

    render_main_form();

    render_point_response();

    render_after_control_content_till_history_content();

    render_history_content();

    render_after_history_content_till_footer();

}

// if there was no request from user to check if the point is within the given area, the behavior of this function is to render nothing
function render_point_response()
{
    $all_input_received = (isset($_GET["x-input"]) && isset($_GET["y-input"]) && isset($_GET["r-input"]));
    echo 'all input received: ' . $all_input_received;
    if ($all_input_received) {
        $user_request = new UserRequest(new Point($_GET["x-input"], $_GET["y-input"]), $_GET["r-input"]);
        if (user_request_valid()) {
            echo 'case user request valid';
            $point_belongs_area_response = generate_point_belongs_area_response($user_request);
            echo 'start rendering response';
            render_point_belongs_area_response($user_request, $point_belongs_area_response);
        }
        else {
            // This takes no arguments and produces no validation info, as we try to give the user validation info on the frontend.
            // if bad input got through, we have to tell the user about the invalid input, though without giving any reasons
            render_invalid_input_warning();
        }
    }
}

function render_invalid_input_warning()
{
    echo '<div class="response">
    <div class="invalid-input-varning">
        INVALID INPUT BLOCK
    </div>
</div>';

}

function render_point_belongs_area_response(UserRequest $user_request, PointBelongsAreaResponse $point_belongs_area_response)
{
    $x = $user_request->getPoint()->getX();
    $y = $user_request->getPoint()->getY();
    $r = $user_request->getR();
    if ($point_belongs_area_response->point_belongs_area()) {
        $result_classname = "yes-image";
    } else {
        $result_classname = "no-image";
    }
    echo 'start echoing point-belongs-area-response div';
    echo '<div class="point-belongs-area-response">
    <div class="valid-input-response">
        <div class="result-table-cell">x: ' . $x . '</div>
        <div class="result-table-cell">y: ' . $y . '</div>
        <div class="result-table-cell">R: ' . $r . '</div>
        <div class="result-table-cell"><div class="' . $result_classname . '></div>
    </div>
</div>';
}

function generate_point_belongs_area_response(UserRequest $userRequest): PointBelongsAreaResponse
{
    if (point_belongs_area($userRequest->getPoint(), $userRequest->getR())) {
        return new PointBelongsAreaResponse(true);
    }
    return new PointBelongsAreaResponse(false);
}

function user_request_valid(): bool
{
    //TODO:
    return true;
}

function render_history_content()
{
    $history_exists = (isset($_SESSION['x_history'])) && (isset($_SESSION['y_history'])) && (isset($_SESSION['r_history']));
    if ($history_exists) {
        echo 'TODO: output history';
    } else {
        echo 'History is empty';
    }
}

function render_main_form()
{
    require "__main-form.inc.php";
}

function render_system_of_axis()
{
    echo '<div class="system-of-axis">//TODO: this</div>';
}

function render_after_history_content_till_footer()
{
    echo '</div>
    </div>';
}

function render_after_control_content_till_history_content()
{
    echo '</div>
        <div class="history">';
}

function render_until_control_content()
{
    echo '<main>
    <div class="main-content">
        <div class="control">';
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


// PROGRAM:
init();
main_script();
