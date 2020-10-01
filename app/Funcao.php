<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Funcao extends Model
{
    public static function numeric($campo){

        return (preg_match("/^[0-9\-]+$/", $campo)) ? true : false;
    }

    public static function soNumeros($campo){

        return preg_replace("/[^0-9]/", "", $campo);
    }

    public static function formataData($campo){

        $data = explode("/", $campo);
        return $data[2] . '.' . $data[1] . '.' . $data[0];
    }

    public static function formataDataBD($campo){

        $data = explode("-", $campo);
        return $data[2] . '/' . $data[1] . '/' . $data[0];
    }

    public static function retornaDia($campo){

        $data = explode("/", $campo);
        return $data[0];
    }

    public static function formataMoeda($valor){

        $valor = str_replace('.', '', $valor);
        return str_replace(',', '.', $valor);
    }

    public static function formataMoedaBD($valor){

        return str_replace('.', ',', $valor);
    }

    public static function formataData2($campo){

        $data = explode("/", $campo);
        return $data[2] . '-' . $data[1] . '-' . $data[0];
    }

    public static function totalDays($date){

        $day_create = Carbon::parse($date);
        $day_current = Carbon::parse(date('Y-m-d'));
        return $day_current->diffInDays($day_create);
   }
}
