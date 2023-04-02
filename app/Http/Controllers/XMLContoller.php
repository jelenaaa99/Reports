<?php

namespace App\Http\Controllers;

use DOMDocument;
use App\Models\Reports;
use Exception;
use Spatie\ArrayToXml\ArrayToXml;

class XMLContoller 
{
    function getXML(){
        $reports = (new Reports())->getReports('xml');
        $isins = (new Reports())->getISIN();

        $arrayReport = [];
        foreach($reports as $report){
            array_push($arrayReport, (array)$report);
        }

        $arrayISIN = [];
        foreach($isins as $i){
            array_push($arrayISIN, (array)$i);
        }

        $data = [
            'ISINS' => [
                'ISIN' => $arrayISIN
            ],
            'TITLEINFODATA' => [
                'TITLEINFO' => $arrayReport
            ]
        ];

        $xml = ArrayToXml::convert($data, 'REPORT');

        try{
            $xmlObj = new DOMDocument();
            $xmlObj->loadXML($xml);

            $schema = new DOMDocument();
            $schema->load(base_path('resources/xsd/validation_schema.xsd'));

            if ($xmlObj->schemaValidateSource($schema->saveXML())) {
                return response($xml, 200)
                ->header('Content-Type', 'text/xml')
                ->header('Content-Disposition', 'attachment; filename="xml-report.xml"');
            } else {
                return redirect()->route('home')->with('error', 'XML is not valid.');
            }
        }
        catch(Exception){
            return redirect()->route('home')->with('error', 'XML is not valid.');
        }
    }
}
