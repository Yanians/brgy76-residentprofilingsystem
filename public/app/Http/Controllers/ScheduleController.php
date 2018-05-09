<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use DB;
use HTML;
use Session;

class ScheduleController extends Controller
{
    
	public function getData()
    {
        $model = Schedule::SearchPaginateAndOrder();  
        $columns = Schedule::$columns;  
        $tblcolumns = Schedule::$tblcolumns;  

        return response()
        ->json([
                 'model'=>$model,
                 'columns'=>$columns,
                 'tblcolumns'=>$tblcolumns
          ]);
    }
}
