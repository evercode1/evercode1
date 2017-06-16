<?php
namespace App\ChartHelpers;
use DB;

class PostPieChartBuilder
{

    use SetsTables;


    private $unFormattedData = [];

    public $data;


    public function __construct()
    {

        $this->data['data'] = ['labels' => [], 'values' => []];


        $this->getUnFormattedData();

        $this->setLabelsAndValues();


    }


    private function setLabelsAndValues()
    {

        foreach ($this->unFormattedData as $label => $value){


            $this->data['data']['labels'][] = $label;
            $this->data['data']['values'][] = $value;


        }


    }

    public function getData()
    {


        return $this->data;


    }



    /**
     * @param $lastWeek
     * @param $today
     */

    private function getUnFormattedData()
    {



        $rows = DB::table('posts')
            ->select(
                'categories.name as category',

                DB::raw('COUNT(posts.id) as count'))
            ->leftJoin('categories', 'category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->orderBy('categories.name', 'asc')
            ->get();

        foreach($rows as $row){

            $this->unFormattedData[$row->category] = $row->count;

        }




    }




}