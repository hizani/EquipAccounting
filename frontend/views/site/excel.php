<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$connect = mysqli_connect("localhost", "root", "", "equip_accounting");
$sql = "SELECT * FROM equipment_view ORDER BY ID DESC";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result) > 0){


    $file = new Spreadsheet();

    $active_sheet = $file->getActiveSheet();

    $active_sheet->setCellValue('A1', 'ID');
    $active_sheet->setCellValue('B1', 'Наименование');
    $active_sheet->setCellValue('C1', 'Тип');
    $active_sheet->setCellValue('D1', 'Компоненты');
    $active_sheet->setCellValue('E1', 'Кабинет');

    $count = 2;

    foreach($result as $row)
    {
        $active_sheet->setCellValue('A'.$count, $row["ID"]);
        $active_sheet->setCellValue('B'.$count, $row["Наименование"]);
        $active_sheet->setCellValue('C'.$count, $row["Тип"]);
        $active_sheet->setCellValue('D'.$count, $row["Компоненты"]);
        $active_sheet->setCellValue('E'.$count, $row["Кабинет"]);

        $count=$count+1;
    }

    $writer = IOFactory::createWriter($file, 'xls');
    $file_name = time().'.'.strtolower('xls');
    $writer->save($file_name);
    header('Content-Type: application/xls');
    header('Content-Transfer-Encoding: Binary');

    header("Content-disposition: attachment; filename=\"".$file_name."\"");
    readfile($file_name);
    unlink($file_name);
}
