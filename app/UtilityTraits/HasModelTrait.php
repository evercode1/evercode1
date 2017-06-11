<?php

namespace App\UtilityTraits;

use Carbon\Carbon;

trait HasModelTrait
{

    public function showStatusOf($record)
    {

        switch ($record) {

            case $record->status_id == 10:

                return 'Active';
                break;

            case $record->status_id == 7:

                return 'Inactive';
                break;

            case $record->status_id == 1:

                return 'open';

            case $record->status_id == 0:

                return 'closed';

            default:

                return 'Inactive';

        }

    }


}