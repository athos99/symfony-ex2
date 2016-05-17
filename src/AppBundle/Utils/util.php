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


    /**
     * convert a flat array to a tree
     *
     * exemple:
     *
     *
     * $tree = Util::buildTree($data, '',
     *     function ($element) {
     *  return $element['index'];
     *} ,
     *  function ($element) {
     *    return substr($element['index'], 0, strripos($element['index'], '.'));
     *   });
     *
     *
     *
     * @param array $elements flat array
     * @param $root                    root element index
     * @param  callable  $functionGetElement      function to get index of element
     * @param  callable  $functionGetParent       function to get index of parent
     * @return array          the tree
     */
    public static function buildTree(array &$elements, $root, callable $functionGetElement, callable  $functionGetParent)
    {
        $branch = [];

        foreach ($elements as $element) {
            $parent = $functionGetParent($element);
            if ($parent == $root) {
                $children = self::buildTree($elements, $functionGetElement($element), $functionGetElement, $functionGetParent);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }




}
