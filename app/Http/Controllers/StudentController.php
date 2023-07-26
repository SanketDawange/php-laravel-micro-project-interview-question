<?php

namespace App\Http\Controllers;

use Exception;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class StudentController extends Controller
{
    public function home()
    {
        try {
            $states = DB::table('states')->get();
            $cities = DB::table('cities')->get();
            $students = DB::table('students')->get();
            return view('home', compact('states', 'cities', 'students'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing your request');
        }
    }

    public function addStudent(Request $request)
    {
        try {
            $id = $request->input('id');

            $student = new Student();

            if ($id) {
                $student = Student::find($id);
            }

            $student->full_name = $request->input('full_name');
            $student->email = $request->input('email');
            $student->gender = $request->input('gender');
            $student->password = bcrypt($request->input('password'));
            $student->state = $request->input('state');
            $student->city = $request->input('city');
            $student->branch = $request->input('branch');

            $student->save();

            $students = DB::table('students')->get();

            return response()->json([
                'success' => 'Student added successfully',
                'students' => $students,
            ]);

        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'Error']);
        }
    }

    public function deleteStudents(Request $request)
    {
        try {
            $selectedIds = $request->input('selectedIds');
            if (is_array($selectedIds) && count($selectedIds) > 0) {
                try {
                    foreach ($selectedIds as $id) {
                        $row = Student::find($id);

                        if ($row) {
                            $row->delete();
                        }
                    }

                    return response()->json(['message' => 'Rows deleted successfully.']);
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Error deleting rows.'], 500);
                }
            } else {
                return response()->json(['error' => 'No rows selected for deletion.'], 400);
            }

        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'Error']);
        }
    }
}
