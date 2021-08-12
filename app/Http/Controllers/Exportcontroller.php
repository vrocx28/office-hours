<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use \App\Models\Timesheet;
use \App\Models\Breaktime;
use \App\Models\Lunch;
use App\Exports\TimeSheetExport;
use Input;
use DB;
use Session;
use Excel;

class Exportcontroller extends Controller
{
    # Bind the Model
    protected $timesheet;
    protected $breaktime;
    protected $lunch;

    public function __construct(Timesheet $timesheet, Breaktime $breaktime, Lunch $lunch)
    {
        $this->timesheet = $timesheet;
        $this->breaktime = $breaktime;
        $this->lunch = $lunch;
    }

    public function downloadExcel($type,$id)
    {
        
        $signin = $this->timesheet->where('emp_id', $id)->get();
        $data_to_import = [];
        foreach($signin as $login){
            $data = [];
            $data['date'] = $login->login_date??'';
            $data['login_time'] = $login->login_time??'';
            $data['login_am_pm'] = $login->login_hour??'';
            $data['logout_time'] = $login->logout_time??'';
            $data['am_pm'] = $login->logout_hour??'';
            array_push($data_to_import, $data);
        }

        return Excel::download(new TimeSheetExport($data_to_import), 'timeSheet.'.$type);
    }
}
