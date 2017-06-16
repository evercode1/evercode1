<?php

namespace App\ChartHelpers;

trait SetsTables
{

    private function setTables($tables)
    {

        $this->tables[0] = $tables[0];

        isset($tables[1]) ? $this->tables[1] = $tables[1] : $this->tables[1] = null;
        isset($tables[2]) ? $this->tables[2] = $tables[2] : $this->tables[2] = null;
        isset($tables[3]) ? $this->tables[3] = $tables[3] : $this->tables[3] = null;




    }


}