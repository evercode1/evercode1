<?php

namespace App\ChartHelpers;

use DB;

class FormatsYesterday
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

        $yesterday = $this->setYesterday();

        $this->getData($yesterday);

        $labels = $this->setDayMonthLabels($yesterday);

        list($values1, $values2, $values3, $values4) = $this->setValues();

        $data['data'] = compact('labels', 'values1', 'values2', 'values3', 'values4');

        $this->data = $data;


    }

    public function setYesterday()
    {

        $today = \Carbon\Carbon::now()->toDateString();

        $yesterday = \Carbon\Carbon::parse("$today - 1 day")->format('Y-m-d');


        return $yesterday;

    }

    /**
     * @param $lastWeek
     * @param $today
     * @return mixed
     */
    public function getTodayData($yesterday, $table)
    {
        switch ($table){

            case 'your special table' :

                $rows = 'write your custom query here';
                break;

            default:

                $rows = DB::table($table)->select(DB::raw('day(created_at) as day'),
                    DB::raw('month(created_at) as month'),
                    DB::raw("count($table.id) as `count`"))
                    ->where(DB::raw('date(created_at)'), $yesterday)
                    ->groupBy('month', 'day')
                    ->get();

                break;

        }


        return $rows;

    }

    public function setDayMonthLabels($yesterday)
    {

        // dynamically create range of month/day pairs using carbon

        $labels = [];



        $labels[ intval(\Carbon\Carbon::parse($yesterday)->format('m')) .
        '/' . intval(\Carbon\Carbon::parse($yesterday)->format('d')) ] = 0;



        $labels = array_keys($labels);

        return $labels;



    }

    public function setTodayValues($rows)
    {

        if (! $rows){

            return false;
        }



        if ($rows->isEmpty()) {

            $values = ['0'];

            return $values;

        }

        //assign today counts to values

        $value = $rows->pluck('count');

        $value = $value->toArray();

        $values = array_values($value);

        return $values;


    }

    /**
     * @param $lastWeek
     * @param $today
     */

    private function getData($yesterday)
    {
        $this->rows1 = $this->getTodayData($yesterday, $this->tables[0]);


        if ($this->tables[1]) {

            $this->rows2 = $this->getTodayData($yesterday, $this->tables[1]);


        }

        if ($this->tables[2]) {

            $this->rows3 = $this->getTodayData($yesterday, $this->tables[2]);


        }

        if ($this->tables[3]) {

            $this->rows4 = $this->getTodayData($yesterday, $this->tables[3]);


        }
    }

    /**
     * @param $lastWeek
     * @return array
     */

    private function setValues()
    {
        $values1 = $this->setTodayValues($this->rows1);
        $values2 = $this->setTodayValues($this->rows2);
        $values3 = $this->setTodayValues($this->rows3);
        $values4 = $this->setTodayValues($this->rows4);

        return [$values1, $values2, $values3, $values4];
    }




}