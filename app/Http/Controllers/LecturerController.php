<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


//Display all lecturers
class LecturerController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $lecturers = Lecturer::with('user')->withCount('courses')
        ->when($search, function($query, $search){
            $query->where(function($subQuery) use ($search) {
                $subQuery->where('staff_number', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('department', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('lecturers.index', compact('lecturers'));
    }

    //Show the lecturer creation form
    public function create(){
        $users = User::where('role', 'lecturer')->orderBy('name')->get();
        return view('lecturers.create', compact('users'));
    }

    //Save a lecturer
    public function store(Request $request){
        $validated = $request->validate([
            'user_id' =>[
                'nullable',
                'exists:users,id',
                'unique:lecturers,user_id',
            ],
            'staff_number' => [
                'required',
                'string',
                'max:50',
                'unique:lecturers,staff_number',
            ],
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' =>  [
                'required',
                'email',
                'max:255',
                'unique:lecturers,email',
            ],
            'department' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);

        if (! empty($validated['user_id'])){
            $user = User::findOrFail($validated['user_id']);
            if (strtolower($user->role) !== 'lecturer'){
                return back()->withErrors(['user_id' => 'Select an account with the lecturer role.'])
                ->withInput();
            }
        }

        Lecturer::create($validated);
        return redirect()->route('lecturers.index')
        ->with('success', 'Lecturer added successfully.');
    }

    //Display lecturer details
    public function show(Lecturer $lecturer){
        $lecturer->load('courses');
        return view('lecturers.show', compact('lecturer'));
    }

// Show lecturer edit form
public function edit(Lecturer $lecturer)
{
    $users = User::where('role', 'lecturer')
        ->orderBy('name')
        ->get();

    return view('lecturers.edit', compact('lecturer', 'users'));
}

    //Update lecturer details
    public function update(Request $request, Lecturer $lecturer){
        $validated = $request->validate([
           'staff_number' => [
           'required',
          'string',
           'max:50',
       Rule::unique('lecturers', 'staff_number')->ignore($lecturer->id),
       ],
            'user_id' => [
                'nullable',
                'exists:users,id',
                Rule::unique('lecturers', 'user_id')->ignore($lecturer->id),
            ],
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('lecturers', 'email')->ignore($lecturer->id),
            ],
            'department' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
        ]);

        if (! empty($validated['user_id'])) {
            $user = User::findOrFail($validated['user_id']);
            if (strtolower($user->role) !== 'lecturer') {
                return back()->withErrors(['user_id' => 'Select an account with the lecturer role.'])
                ->withInput();
            }
        }
        $lecturer->update($validated);
        return redirect()->route('lecturers.index')->with('success', 'Lecturer details updated successfully.');
    }

    //Delete a lecturer
    public function destroy(Lecturer $lecturer){
        if ($lecturer->courses()->exists()) {
            return redirect()->route('lecturers.index')
            ->with('error', 'This lecturer is assigned to courses. Reassign those courses before deleting the lecturer.');
        }
        $lecturer->delete();
        return redirect()->route('lecturers.index')->with('success', 'Lecturer deleted successfully.');
    }
}
