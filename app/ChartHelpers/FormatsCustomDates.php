<?php

namespace App\ChartHelpers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class FormatsCustomDates
{

    use SetsTables;

    private $startDate;

    private $endDate;

    private $rows1;

    private $rows2;

    private $rows3;

    private $rows4;

    private $totalDays;

    private $tables = [];

    private $labels = [];

    public $data = [];


    public function __construct($tables, Request $request)
    {

        $this->setTables($tables);

        $this->setDates($request);

        $this->setTotalDays();

        $this->getData();

        $labels = $this->setDayMonthLabels();

        list($values1, $values2, $values3, $values4) = $this->setAllValues();

        $data['data'] = compact('labels', 'values1', 'values2', 'values3', 'values4');

        $this->data = $data;


    }

    /**
     * @param $lastWeek
     * @param $today
     * @return mixed
     */
    public function getCustomData($table)
    {
        switch ($table){

            case 'your special table' :

                $rows = 'write your custom query here';
                break;

            default:

                $rows = DB::table($table)->select(DB::raw('day(created_at) as day'),
                    DB::raw('month(created_at) as month'),
                    DB::raw("count($table.id) as `count`"))
                    ->where(DB::raw('date(created_at)'), '>=', $this->startDate)
                    ->where(DB::raw('date(created_at)'), '<=', $this->endDate)
                    ->groupBy('month', 'day')
                    ->get();

                break;

        }

        return $rows;

    }

    public function setDayMonthLabels()
    {

        // dynamically create range of month/day pairs using carbon



        for ($i = 0; $i <= $this->totalDays; $i ++) {

            $this->labels[ intval(\Carbon\Carbon::parse("$this->startDate + $i day")
            ->format('m')) . '/' .
            intval(\Carbon\Carbon::parse("$this->startDate + $i day")
            ->format('d')) ] = 0;

        }

        $this->labels = array_keys($this->labels);


        return $this->labels;



    }

    public function setValues($rows)
    {

        if (! $rows){

            return false;
        }

        $values = [];

        for ($i = 0; $i <= $this->totalDays; $i ++) {
            $values[ intval(\Carbon\Carbon::parse("$this->startDate + $i day")
                ->format('m')) . '/' .
            intval(\Carbon\Carbon::parse("$this->startDate + $i day")
                ->format('d')) ] = 0;
        }



        //assign each day counts to values


        foreach ($rows as $row) {

            $values [ $row->month . '/' . $row->day ] = $row->count;
        }


        $values = array_values($values);


        return $values;




    }

    /**
     * @param $lastWeek
     * @param $today
     */

    private function getData()
    {
        $this->rows1 = $this->getCustomData($this->tables[0]);


        if ($this->tables[1]) {

            $this->rows2 = $this->getCustomData($this->tables[1]);


        }

        if ($this->tables[2]) {

            $this->rows3 = $this->getCustomData($this->tables[2]);


        }

        if ($this->tables[3]) {

            $this->rows4 = $this->getCustomData($this->tables[3]);


        }
    }

    /**
     * @param $lastWeek
     * @return array
     */

    private function setAllValues()
    {
        $values1 = $this->setValues($this->rows1);
        $values2 = $this->setValues($this->rows2);
        $values3 = $this->setValues($this->rows3);
        $values4 = $this->setValues($this->rows4);

        return [$values1, $values2, $values3, $values4];
    }

    /**
     * @param Request $request
     */
    private function setDates(Request $request)
    {
        $this->startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $this->endDate = Carbon::parse($request->end_date)->format('Y-m-d');
    }

    private function setTotalDays()
    {
        $startDate = Carbon::parse($this->startDate);
        $endDate = Carbon::parse($this->endDate);

        $this->totalDays = $endDate->diffInDays($startDate);
    }


}