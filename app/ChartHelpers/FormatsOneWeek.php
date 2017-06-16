<?php
namespace App\ChartHelpers;
use DB;

class FormatsOneWeek
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

        list($today, $lastWeek) = $this->setOneWeekData();

        $this->getData($lastWeek, $today);

        $labels = $this->setDayMonthLabels($lastWeek);

        list($values1, $values2, $values3, $values4) = $this->setValues($lastWeek);

        $data['data'] = compact('labels', 'values1', 'values2', 'values3', 'values4');

        $this->data = $data;


    }

    public function setOneWeekData()
    {

        $today = \Carbon\Carbon::now()->toDateString();

        $lastWeek = \Carbon\Carbon::parse('-6 days')->toDateString();


        return [$today, $lastWeek];

    }

    /**
     * @param $lastWeek
     * @param $today
     * @return mixed
     */
    public function getOneWeekData($lastWeek, $today, $table)
    {
        switch ($table){

            case 'your special table' :

                $rows = 'write your custom query here';
                break;

            default:

                $rows = DB::table($table)->select(DB::raw('day(created_at) as day'),
                    DB::raw('month(created_at) as month'),
                    DB::raw("count($table.id) as `count`"))
                    ->where(DB::raw('date(created_at)'), '>=', $lastWeek)
                    ->where(DB::raw('date(created_at)'), '<=', $today)
                    ->groupBy('month', 'day')
                    ->get();

                break;

        }

        return $rows;

    }

    public function setDayMonthLabels($lastWeek)
    {

        // dynamically create range of month/day pairs using carbon

        $labels = [];

        for ($i = 0; $i <= 6; $i ++) {

            $labels[ intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('m')) . '/' . intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('d')) ] = 0;

        }

        $labels = array_keys($labels);

        return $labels;



    }

    public function setOneWeekValues($lastWeek, $rows)
    {

        if (! $rows){

            return false;
        }

        $values = [];

        for ($i = 0; $i <= 6; $i ++) {
            $values[ intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('d')) ] = 0;
        }

        //assign each day counts to values


        foreach ($rows as $row) {

            $values [ $row->day ] = $row->count;
        }


        $values = array_values($values);

        return $values;


    }

    /**
     * @param $lastWeek
     * @param $today
     */

    private function getData($lastWeek, $today)
    {
        $this->rows1 = $this->getOneWeekData($lastWeek, $today, $this->tables[0]);


        if ($this->tables[1]) {

            $this->rows2 = $this->getOneWeekData($lastWeek, $today, $this->tables[1]);


        }

        if ($this->tables[2]) {

            $this->rows3 = $this->getOneWeekData($lastWeek, $today, $this->tables[2]);


        }

        if ($this->tables[3]) {

            $this->rows4 = $this->getOneWeekData($lastWeek, $today, $this->tables[3]);


        }
    }

    /**
     * @param $lastWeek
     * @return array
     */

    private function setValues($lastWeek)
    {
        $values1 = $this->setOneWeekValues($lastWeek, $this->rows1);
        $values2 = $this->setOneWeekValues($lastWeek, $this->rows2);
        $values3 = $this->setOneWeekValues($lastWeek, $this->rows3);
        $values4 = $this->setOneWeekValues($lastWeek, $this->rows4);

        return [$values1, $values2, $values3, $values4];
    }


}