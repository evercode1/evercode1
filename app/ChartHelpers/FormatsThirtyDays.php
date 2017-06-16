<?php
namespace App\ChartHelpers;
use DB;

Class FormatsThirtyDays
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

        list($today, $lastMonth) = $this->setThirtyDayDateRange();

        $this->getData($lastMonth, $today);

        $labels = $this->makeThirtyDayLabels($lastMonth);

        list($values1, $values2, $values3, $values4) = $this->setValues($lastMonth);

        $data['data'] = compact('labels', 'values1', 'values2', 'values3', 'values4');

        $this->data = $data;


    }


    public function setThirtyDayDateRange()
    {

        $today = \Carbon\Carbon::now()->toDateString();
        $lastMonth = \Carbon\Carbon::parse('-29 days')->toDateString();

        return [$today, $lastMonth];

    }

    public function getThirtyDayData($lastMonth, $today, $table)
    {
        switch ($table){

            case null :

                $rows = null;
                break;

            case 'your special table' :

                $rows = 'write your query here';
                break;

            default :

                $rows = DB::table($table)->select(DB::raw('day(created_at) as day'),
                    DB::raw('month(created_at) as month'),
                    DB::raw("count($table.id) as `count`"))
                    ->where(DB::raw('date(created_at)'), '>=', $lastMonth)
                    ->where(DB::raw('date(created_at)'), '<=', $today)
                    ->groupBy('month', 'day')
                    ->get();



        }



        return $rows;

    }


    public function makeThirtyDayLabels($lastMonth)
    {

        // dynamically create range of month/day pairs using carbon

        $labels = [];

        for ($i = 0; $i <= 29; $i ++) {

            $labels[ intval(\Carbon\Carbon::parse("$lastMonth + $i day")->format('m')) . '/' . intval(\Carbon\Carbon::parse("$lastMonth + $i day")->format('d')) ] = 0;
        }

        $labels = array_keys($labels);

        return $labels;


    }


    public function setThirtyDayValues($lastMonth, $rows)
    {

        if ( ! $rows) {

            return false;

        }

        // build values array

        $values = [];

        for ($i = 0; $i <= 29; $i ++) {

            $values[ intval(\Carbon\Carbon::parse("$lastMonth + $i day")->format('d')) ] = 0;
        }

        //assign each day counts to values

        foreach ($rows as $row) {

            $values [ $row->day ] = $row->count;
        }

        $values = array_values($values);

        return $values;

    }

    /**
     * @param $lastMonth
     * @param $today
     */
    private function getData($lastMonth, $today)
    {
        $this->rows1 = $this->getThirtyDayData($lastMonth, $today, $this->tables[0]);

        if ($this->tables[1]) {

            $this->rows2 = $this->getThirtyDayData($lastMonth, $today, $this->tables[1]);

        }

        if ($this->tables[2]) {

            $this->rows3 = $this->getThirtyDayData($lastMonth, $today, $this->tables[2]);

        }

        if ($this->tables[3]) {

            $this->rows4 = $this->getThirtyDayData($lastMonth, $today, $this->tables[3]);

        }
    }

    /**
     * @param $lastMonth
     * @return array
     */
    private function setValues($lastMonth)
    {
        $values1 = $this->setThirtyDayValues($lastMonth, $this->rows1);

        $values2 = $this->setThirtyDayValues($lastMonth, $this->rows2);

        $values3 = $this->setThirtyDayValues($lastMonth, $this->rows3);

        $values4 = $this->setThirtyDayValues($lastMonth, $this->rows4);

        return [$values1, $values2, $values3, $values4];
    }


}