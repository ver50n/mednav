<?php
namespace App\Utils;

use App\Helpers\DateUtils;
use Lang;

class ExportUtil
{
    protected $exportType;

    public function __construct($exportType)
    {
        $this->exportType = (isset($exportType)) ? $exportType : 'csv';
        \Debugbar::disable();
    }

    public function export($data, $options = [])
    {
        switch($this->exportType) {
            case "csv":
                $this->exportCsv($data, $options);
                break;
        }
    }

    public function convertAndExportCsv($data, $options)
    {
        $return = [];
        $i = 0;
        foreach ($data as $row) {
            $tempRow = [];
            if(isset($options['fields']) || $i > 0) {
                foreach($options['fields'] as $field) {
                    $tempRow[] = $row[$field['name']];
                }
            } else {
                $tempRow = $row;
            }

            $return[] = $tempRow;
            $i++;
        }
        $this->exportCsv($return, $options);
    }

    public function exportCsv($data, $options)
    {
        $fileName = isset($options['file_name']) ? $options['file_name'] : uniqid().".csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$fileName.'";');
        $fp = fopen('php://output', 'w');

        $i = 0;
        foreach ($data as $row) {
            fputcsv($fp, $row);
            $i++;
        }
        fclose($fp);
    }
}
