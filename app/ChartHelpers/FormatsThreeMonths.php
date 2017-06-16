<?php
namespace App\ChartHelpers;
use DB;


class FormatsThreeMonths
{

    use SetsTables;

    private $rows1;

    private $rows2;

    private $rows3;

    private $rows4;

    private $tables = [];

    public $data = [];


    public function __construct($tables)
    {

        $this->setTables($tables);

        list($lastYear, $currentYear) = $this->setDateRangeForThreeMonths();

        $this->getData($lastYear, $currentYear);

        $values = $this->makeThreeMonthsForValues($lastYear);

        $months = $this->formatThreeMonthLabels();

        $labels = $this->setThreeMonthLabels($values, $months);

        list($values1, $values2, $values3, $values4) = $this->setValueGroups($values);

        $data['data'] = compact('labels', 'values1', 'values2', 'values3', 'values4');


        $this->data = $data;

    }



    /**
     * @return array
     */

    public function setDateRangeForThreeMonths()
    {
        $currentYear = \Carbon\Carbon::now()->toDateString();
        $lastYear = \Carbon\Carbon::parse('first day of -2 month')->toDateString();


        return [$lastYear, $currentYear];

    }

    public function getThreeMonthsData($table, $lastYear, $currentYear)
    {



        switch ($table){

            case null :

                $rows = null;
                break;

            case 'your special table' :

                $rows = 'write your query here';
                break;


            default :

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

    /**
     * @param $lastYear
     * @return array
     */

    public function makeThreeMonthsForValues($lastYear)
    {
        // dynamically create range of month/value pairs using carbon

        $values = [];

        for ($i = 0; $i <= 2; $i ++) {

            $values[ intval(\Carbon\Carbon::parse("$lastYear + $i month")->format('m')) ] = 0;

        }

        return $values;

    }

    /**
     * @param $rows
     * @param $values
     * @return array
     */

    public function setThreeMonthValues($rows, $values)
    {
        if ( ! $rows) {

            return false;

        }


        foreach ($rows as $row) {

            //overwrite values into values array

            $values [ $row->month ] = $row->count;
        }

        $values = array_values($values);

        return $values;

    }

    /**
     * @return array
     */

    public function formatThreeMonthLabels()
    {

        $months = [1  => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May',
                   6  => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct',
                   11 => 'Nov', 12 => 'Dec'];

        return $months;

    }
    
    public function setThreeMonthLabels($values, $months)
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
    private function getData($lastYear, $currentYear)
    {
        $this->rows1 = $this->getThreeMonthsData($this->tables[0], $lastYear, $currentYear);

        if ($this->tables[1]) {

            $this->rows2 = $this->getThreeMonthsData($this->tables[1], $lastYear, $currentYear);

        }


        if ($this->tables[2]) {

            $this->rows3 = $this->getThreeMonthsData($this->tables[2], $lastYear, $currentYear);

        }


        if ($this->tables[3]) {

            $this->rows4 = $this->getThreeMonthsData($this->tables[3], $lastYear, $currentYear);

        }
    }

    /**
     * @param $values
     * @return array
     */
    private function setValueGroups($values)
    {
        $values1 = $this->setThreeMonthValues($this->rows1, $values);
        $values2 = $this->setThreeMonthValues($this->rows2, $values);
        $values3 = $this->setThreeMonthValues($this->rows3, $values);
        $values4 = $this->setThreeMonthValues($this->rows4, $values);

        return [$values1, $values2, $values3, $values4];
    }


}