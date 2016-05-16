<?php
namespace AppBundle\Utils;


class Util {
    /**
     * Load a Excel file
     *
     * 1st row is the header, contain the name of array index
     * 2nd row and ..  contain the value
     *
     *
     * @param $filename
     * @return array
     * @throws \PHPExcel_Exception
     */
    public static function loadExcel($filename) {
        $headers = [];
        $data = [];
        $col0 = 'A';
        $row0 = 1;
        $row1 = false;
        $objPHPExcel = \PHPExcel_IOFactory::load($filename);
        $worksheet = $objPHPExcel->setActiveSheetIndex(0);
        $row2 = $worksheet->getHighestDataRow($col0);
        for ($i = $row0; $i <= $row2; $i++) {
            if ($worksheet->cellExists($col0.$i)) {
                $cell = $worksheet->getCell($col0.$i);
                if (trim($cell->getValue()) != '') {
                    $row1 = $i;
                    break;
                }
            }
        }
        if ($row1 === false) {
            return $data;
        }
        $j = 0;
        while (true) {
            $cell = $worksheet->getCellByColumnAndRow($j, $row1);
            $title = trim($cell->getValue());
            if ($title == '') {
                break;
            }
            $col = $cell->getColumn();
            $headers[$col] = $title;
            $j++;
        }
        $i = $row1 + 1;
        while (true) {
            if (trim($worksheet->getCell($col0.$i)) == '') {
                break;
            }
            $cols = [];
            foreach ($headers as $col => $name) {
                $value = $worksheet->getCell($col.$i)->getValue();
                $cols[$name] = ($value == '') ? null : $value;
            }
            $data[] = $cols;
            $i++;
        }
        return $data;
    }
}
