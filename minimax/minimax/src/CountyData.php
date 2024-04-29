<?php

class CountyData
{
    private $counties;

    public function __construct()
    {
        $this->counties = [
            "Carlow",
            "Cavan",
            "Clare",
            "Cork",
            "Donegal",
            "Dublin",
            "Galway",
            "Kerry",
            "Kildare",
            "Kilkenny",
            "Laois",
            "Leitrim",
            "Limerick",
            "Longford",
            "Louth",
            "Mayo",
            "Meath",
            "Monaghan",
            "Offaly",
            "Roscommon",
            "Sligo",
            "Tipperary",
            "Waterford",
            "Westmeath",
            "Wexford",
            "Wicklow"
        ];
    }

    public function getCounties()
    {
        return $this->counties;
    }
}