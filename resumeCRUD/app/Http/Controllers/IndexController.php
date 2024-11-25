<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $header = 'Резюме и вакансии';
        return view('page', compact('header'));
    }

    public function show($id = 1)
    {
        $data = [
            'surname' => 'Иванов',
            'staff' => 'Программист',
            'phone' => '55-55-55',
            'stage' => '4 года',
            'photo' => 'ava1.jpg',
        ];
        return view('resume', compact('data'));
    }
    public function getSurnamesWithStage()
    {
        $persons = DB::table('people')
            ->select('FIO')
            ->whereBetween('Stage', [5,15])
            ->get();
        $title = "Стаж между 5 и 15 годами";
        return view('resume')-> with(['persons' => $persons,'title'=>$title]);
    }
    public function getProgers()
    {
        $persons = Person::select('FIO')
            ->where('staff_id','=','1')
            ->get();
        $title = "Программисты (кОдИрОвЩиКи)";
        return view('resume')-> with(['persons' => $persons->toArray(),'title'=>$title]);
    }
    public function countResumes(){
        $count = Person::count();
        return view('resume')-> with(['count' => $count]);
    }
    public function getPresentedStaff()
    {
        $resumes = DB::table('people')
            ->join('staff', 'people.staff_id', '=', 'staff.id')
            ->select('staff.staff')
            ->distinct()
            ->get();
        $title = "Должности с резюме";
       return view('resume')-> with(['persons' => $resumes, 'title'=>$title] );
    }

}
