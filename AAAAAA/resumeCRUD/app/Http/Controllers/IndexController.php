<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateForm;
use App\Http\Requests\ValidateUpdateForm;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\Person;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $resumes = Person::all();
        $header = 'Резюме и вакансии';

        return view('page', compact('header', 'resumes'));
    }

    public function create()
    {
        $staff = Staff::all();
        $resume = new Person();
        return view('add-content')->with(['staff' => $staff->toArray()]);
    }

    public function store(ValidateForm $request)
    {
        $request->validate($request->rules());
        $data=$request->validated();
        $file = $request->Image;
        $fileName = $file->getClientOriginalName();
        $data['Image'] = $fileName;
        $person = new Person();
        $person->fill($data);
        $person->save();
        $target_path = public_path() . '/images/';
        $file->move($target_path, $fileName);
        return redirect()
            ->route('index');
    }

    public function destroy(Person $resume)
    {
        $resume->delete();
        return redirect()
            ->route('index')->with('success', 'Вы удалили человека. Круто, правда?');
    }

    public function show(Person $resume)
    {
        $person = DB::table('people')
            ->join('staff', 'people.staff_id', '=', 'staff.id')
            ->where('people.id', '=', $resume->id)
            ->get();

        $array = json_decode(json_encode($person), true);
        $array[0]['id'] = $resume->id;
        return view('resume')->with(['person' => $array[0]]);
    }

    public function edit($resume)
    {
        $person = DB::table('people')
            ->join('staff', 'people.staff_id', '=', 'staff.id')
            ->where('people.id', '=', $resume)
            ->get();
        $staff = Staff::all();

        $array = json_decode(json_encode($person), true);
        $array[0]['id'] = $resume;
        return view('edit')->with(['person' => $array[0], 'staff' => $staff]);
    }

    public function update(ValidateUpdateForm $request, $id)
    {

        $request->validate($request->rules());
        $data=$request->validated();
        $resume = Person::findOrFail($id);




        if ($request->hasFile('Image')) {
            $request->validate([
                'Image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $file = $request->Image;
            $fileName = $file->getClientOriginalName();
            $data['Image'] = $fileName;
            $target_path = public_path() . '/images/';
            $file->move($target_path, $fileName);
//            $imagePath = $request->file('Image')->store('public/images', 'public'); // Store image in 'public/images'
//
//            $data['Image'] = $imagePath;
        } else {

            $data['Image'] = $resume->Image;
        }

        $resume->update($data);

        return redirect()
            ->route('index')->with('success', 'Люди не меняются, пока не ты управляшь бд');
    }


    public function getSurnamesWithStage()
    {
        $persons = DB::table('people')
            ->select('FIO')
            ->whereBetween('Stage', [5, 15])
            ->get();
        $title = "Стаж между 5 и 15 годами";
        return view('stat')->with(['persons' => $persons, 'title' => $title]);
    }

    public function getProgers()
    {
        $persons = Person::select('FIO')
            ->where('staff_id', '1')
            ->get();
        $title = "Программисты (кОдИрОвЩиКи)";
        return view('stat')->with(['persons' => $persons->toArray(), 'title' => $title]);
    }

    public function countResumes()
    {
        $count = Person::count();
        return view('stat')->with(['count' => $count]);
    }

    public function getPresentedStaff()
    {
        $resumes = DB::table('people')
            ->join('staff', 'people.staff_id', '=', 'staff.id')
            ->select('staff.staff')
            ->distinct()
            ->get();
        $title = "Должности с резюме";
        return view('stat')->with(['persons' => $resumes, 'title' => $title]);
    }

}
