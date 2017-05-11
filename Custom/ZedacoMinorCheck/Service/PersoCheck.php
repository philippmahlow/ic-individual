<?php

namespace ZedacoMinorCheck\Service;

/**
 * Class PersoCheck
 * @package ZedacoMinorCheck\Service
 *
 * Ported from old xtcommerce system
 *
 * author Sebastian Gieselmann
 */
class PersoCheck
{



    static public function checkNum($number = 0)
    {
        $return = 0;
        $p      = 7;
        for ($i = 0; $i < strlen(strval($number)); $i++)
        {
            $return += intval(substr(PersoCheck::convert($number[$i]) * $p, -1));
            if ($p == 1)
            {
                $p = 7;
            }
            else if ($p == 3)
            {
                $p = 1;
            }
            else if ($p == 7)
            {
                $p = 3;
            }
        }
        return $return;
    }



    static public function convert($val)
    {
        $array = array(
            '0'   => 0,
            '1'   => 1,
            '2'   => 2,
            '3'   => 3,
            '4'   => 4,
            '5'   => 5,
            '6'   => 6,
            '7'   => 7,
            '8'   => 8,
            '9'   => 9,
            'C' => 12,
            'F' => 15,
            'G' => 16,
            'H' => 17,
            'J' => 19,
            'K' => 20,
            'L' => 21,
            'M' => 22,
            'N' => 23,
            'P' => 25,
            'R' => 27,
            'T' => 29,
            'V' => 31,
            'W' => 32,
            'X' => 33,
            'Y' => 34,
            'Z' => 35);
        return $array[strtoupper($val)];
    }



    static public function validate(array $array)
    {

        if (!(substr(PersoCheck::checkNum(substr($array[0], 0, 9)), -1) == substr($array[0], 9, 1)))
        {
            return FALSE;
        }

        //Zweite Checknummer=> Geburtstag
        if (!(substr(PersoCheck::checkNum(substr($array[1], 0, 6)), -1) == substr($array[1], 6, 1)))
        {
            return FALSE;
        }

        //Dritte Checknummer=> Gueltig bis
        if (!(substr(PersoCheck::checkNum(substr($array[2], 0, 6)), -1) == substr($array[2], 6, 1)))
        {
            return FALSE;
        }

        //Ausweis abgelaufen? Wenn gewuenscht deaktivieren?
        if (!(time() < mktime(0, 0, 0, substr($array[2], 2, 2), substr($array[2], 4, 2), substr($array[2], 0, 2))))
        {
            return FALSE;
        }

        //Vierte Checknummer=> Die gesamte Perso-ID
        if (!(substr(PersoCheck::checkNum(substr($array[0], 0, 10) . substr($array[1], 0, 7) . substr($array[2], 0, 7)),
                -1) == $array[3])
        )
        {
            return FALSE;
        }

        $day   = $array[1]{4} . $array[1]{5}; //Geburtstag
        $month = $array[1]{2} . $array[1]{3}; //Geburtsmonat
        $year  = $array[1]{0} . $array[1]{1}; //Geburtsmonat
        $age   = \DateTime::createFromFormat('d.m.y', $day . '.' . $month . '.' . $year)
            ->diff(new \DateTime('now'))
            ->y;
        if ($age < 18)
        {
            return FALSE;
        }
        return TRUE;
    }
}