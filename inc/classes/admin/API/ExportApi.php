<?php

namespace Inc\classes\admin\API;

final class ExportApi
{

    static function array2csv($list, $filename = "export.csv", $delimiter = ";")
    {
        //get greatest count of list
        $key_count = 0;
        for ($i = 1; $i < count($list); $i++) {
            if (count($list[$i - 1]) > count($list[$i]))
                $key_count = $i;
        }
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        ob_end_clean();
        $out = fopen('php://output', 'w');
        $fields = array_keys((array)$list[$key_count]);
        fputcsv($out, $fields);
        $data = array();
        // $attr = array();
        for ($i = 0; $i < count($list); $i++) {
            for ($j = 0; $j < count($fields); $j++) {
                $items = $list[$i][$fields[$j]];
                if (is_array($items)) {
                    foreach ($items as $item) {
                        $test = $item . " ";
                    }
                    $items = $test;
                }
                // array_push($items, $attr);
                array_push($data, $items);
            }
            fputcsv($out, $data);
            $data = array();
        }
        fclose($out);
        // flush buffer
        ob_flush();
        // use exit to get rid of unexpected output afterward
        exit();
    }
}
