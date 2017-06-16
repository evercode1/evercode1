<?php
namespace App\ChartHelpers;
use DB;


class FormatsOneYear
{
    use SetsTables;

    private $rows1;

    private $rows2;

    private $rows3;

    private $rows4;

    private $values1 = [];

    private $values2 = [];

    private $values3 = [];

    private $values4 = [];

    private $tables = [];

    public $data = [];



    public function __construct($tables)
    {

        $this->setTables($tables);

        list($currentYear, $lastYear) = $this->setOneYearDateRange();

        $this->setOneYearData($lastYear, $currentYear);

        $this->setValues($lastYear);

        $months = $this->makeOneYearMonthLabels();

        $labels = $this->setOneYearMonthLabels($this->values1, $months);

        list($values1, $values2, $values3, $values4) = $this->finalFormatOfValues();

        $data['data'] = compact('labels', 'values1', 'values2', 'values3', 'values4');

        $this->data = $data;


    }

    public function setOneYearDateRange()
    {
        // set first and last date

        $currentYear = \Carbon\Carbon::now()->toDateString();
        $lastYear = \Carbon\Carbon::parse('first day of -11 month')->toDateString();

        return [$currentYear, $lastYear];


    }


    public function getOneYearData($lastYear, $currentYear, $table)
    {

           switch($table){

                case null :

                $rows = null;

                break;

                case 'YourSpecialCase' :

                $rows = 'call your query class here';
                break;

                default  :

                $rows = DB::table($table)->select(DB::raw('Year(created_at) as year'),
                        DB::raw('month(created_at) as month'),
                        DB::raw("count($table.id) as `count`"))
                        ->where(DB::raw('date(created_at)'), '>=', $lastYear)
                        ->where(DB::raw('date(created_at)'), '<=', $currentYear)
                        ->groupBy('year', 'month')
                        ->get();

                }

        return $rows;


    }

    public function setOneYearValues($lastYear)
    {

        $values = [];

        // dynamically create range of month/value pairs using carbon

        $values[ intval(\Carbon\Carbon::parse($lastYear)->format('m')) ] = 0;

        for ($i = 0; $i <= 11; $i ++) {
            $values[ intval(\Carbon\Carbon::parse("$lastYear + $i month")->format('m')) ] = 0;
        }

        return $values;

    }

    public function formatOneYearValues($values, $rows)
    {
        if( ! $rows){

            return false;
        }

        foreach ($rows as $row) {

            //  overwrite values into values array

           $values [ $row->month ] = $row->count;
       }

        $values = array_values($values);

        return $values;

    }

    /**
     * @return array
     */

    public function makeOneYearMonthLabels()
    {

        $months = [1  => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May',
                   6  => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct',
                   11 => 'Nov', 12 => 'Dec'];

        return $months;

    }



    public function setOneYearMonthLabels($values, $months)
    {
        //replace keys in values where key in months matches key
        // in values with value in months of matching key

        $newValues = [];

        foreach ($values as $monthNumber => $count) {

            $key = $months[ $monthNumber ];

            $newValues[ $key ] = $count;

        }

        $labels = array_keys($newValues);

        return $labels;

    }

    /**
     * @param $lastYear
     * @param $currentYear
     */

    private function setOneYearData($lastYear, $currentYear)
    {
        $this->rows1 = $this->getOneYearData($lastYear, $currentYear, $this->tables[0]);

        if ($this->tables[1]) {

            $this->rows2 = $this->getOneYearData($lastYear, $currentYear, $this->tables[1]);

        }

        if ($this->tables[2]) {

            $this->rows3 = $this->getOneYearData($lastYear, $currentYear, $this->tables[2]);

        }

        if ($this->tables[3]) {

            $this->rows4 = $this->getOneYearData($lastYear, $currentYear, $this->tables[3]);

        }
    }

    /**
     * @param $lastYear
     */

    private function setValues($lastYear)
    {
        $this->values1 = $this->setOneYearValues($lastYear);

        $this->values2 = $this->setOneYearValues($lastYear);

        $this->values3 = $this->setOneYearValues($lastYear);

        $this->values4 = $this->setOneYearValues($lastYear);
    }

    /**
     * @return array
     */

    private function finalFormatOfValues()
    {
        $values1 = $this->formatOneYearValues($this->values1, $this->rows1);
        $values2 = $this->formatOneYearValues($this->values2, $this->rows2);
        $values3 = $this->formatOneYearValues($this->values3, $this->rows3);
        $values4 = $this->formatOneYearValues($this->values4, $this->rows4);

        return [$values1, $values2, $values3, $values4];
    }




}