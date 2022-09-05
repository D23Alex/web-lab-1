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

class PointBelongsAreaResponse {

    private $point_belongs_area;

    public function __construct($point_belongs_area)
    {
        $this->point_belongs_area = $point_belongs_area;
    }


    public function point_belongs_area(): bool
    {
        return $this->point_belongs_area;
    }
}