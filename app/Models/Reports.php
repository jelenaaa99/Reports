<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Reports 
{
    function getReports($type){
        if($type === 'excel'){
            return DB::table('isin as i')
            ->select('i.isin AS ISIN', 't.TitleName', 't.Currency', 't.EmittentName')
            ->join('titleinfodata as t', 'i.TitleInfoDataID', 't.TitleInfoDataID')
            ->where('i.ValidUntil', '=', NULL)
            ->get();
        }
        if($type === 'xml'){
            return DB::table('isin as i')
            ->select('i.TitleInfoDataID  AS ID', 'i.isin AS ISIN', 't.TitleName AS TITLENAME', 't.Currency AS CURRENCY', 't.EmittentName AS EMITTENTNAME')
            ->join('titleinfodata as t', 'i.TitleInfoDataID', 't.TitleInfoDataID')
            ->where('i.ValidUntil', '=', NULL)
            ->get();
        }
    }

    function getISIN(){
        $condition = 'ValidUntil NOT NULL';
        return DB::table('isin')
        ->select('isin as VALUE', DB::raw('IF(ValidUntil IS NOT NULL, ValidUntil, "") as VALIDUNTIL'))
        ->get();
    }
}
