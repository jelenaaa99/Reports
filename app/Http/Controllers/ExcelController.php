<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController
{
    function downloadExcel(){
        $data = (new Reports())->getReports('excel');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        
        $headers = ['ISIN', 'TitleName', 'Currency', 'EmittentName'];

        $sheet->fromArray([$headers], null, 'A1');

        $boldFont = [
            'font' => [
                'bold' => true,
            ],
        ];
        $sheet->getStyle('A1:D1')->applyFromArray($boldFont);

        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(50);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(35);

        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A'.$row, $item->ISIN);
            $sheet->setCellValue('B'.$row, $item->TitleName);
            $sheet->setCellValue('C'.$row, $item->Currency);
            $sheet->setCellValue('D'.$row, $item->EmittentName);
            $row++;
        }

        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestDataRow();
        $tableRange = 'A1:'.$lastColumn.$lastRow;
        $sheet->setAutoFilter($tableRange);
        
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=excel-report.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
