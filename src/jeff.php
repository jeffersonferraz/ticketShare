<?php

class Car
{
    protected $manufacturer;
    protected $model;

    public function __construct($manufacturer, $model)
    {
        $this->manufacturer = $manufacturer;
        $this->model = $model;
    }

    public function identify()
    {
        echo "i am a car. manufactured by " . $this->manufacturer . ". my model is " . $this->model . ".";
    }
}

$bmwM3 = new Car("BMW", "m3");
$opelCorsa = new Car("Opel", "Corsa");

$bmwM3->identify();
echo PHP_EOL;
$opelCorsa->identify();
