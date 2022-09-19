<?php

class Point
{

    private $x;
    private $y;


    public function __construct($x, $y)
    {
        if ($y == "0") {
            $this->y = 0;
        }
        else {
            $this->y = $y;
        }
        $this->x = $x;
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

class PointBelongsAreaResponse {

    private $point_belongs_area;

    private $user_request;

    public function __construct($point_belongs_area, $user_request)
    {
        $this->point_belongs_area = $point_belongs_area;
        $this->user_request = $user_request;
    }


    public function getUserRequest()
    {
        return $this->user_request;
    }

    public function point_belongs_area(): bool
    {
        return $this->point_belongs_area;
    }
}