<?php
namespace App\Classes\Theme;

#TODO Доделать класс
class Chart
{

    private array
        $series,
        $chart,
        $plotOptions,
        $legend,
        $dataLabels,
        $fill,
        $stroke,
        $xaxis,
        $yaxis,
        $states,
        $tooltip,
        $colors,
        $markers;

    public function __construct(
        public string $id
    )
    {

    }

    public function options()
    {
        return array(
            'series' => $this->series,
            'chart' => $this->chart(),
            'plotOptions' => $this->plotOptions(),
            'legend' => $this->legend(),
            'dataLabels' => $this->dataLabels(),
            'fill' => $this->fill(),
            'stroke' => $this->stroke(),
            'xaxis' => $this->xaxis(),
            'yaxis' => $this->yaxis(),
            'states' => $this->states(),
            'tooltip' => $this->tooltip(),
            'colors' => $this->colors(),
            'markers' => $this->markers()
        );
    }

    private function setSeries($name, $data)
    {
        $this->series = array(
            'name' => $name,
            'data' => $data
        );
    }

    private function setChart()
    {
        $this->chart = array(

        );
    }

    private function plotOptions()
    {
    }


}
