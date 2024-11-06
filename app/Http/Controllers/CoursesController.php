<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Exception;

class CoursesController extends Controller
{
    public function index()
    {   
        $mentors = User::role('mentor') 
        ->whereNotIn('id', Courses::pluck('mentor_id')) 
        ->get();

        $courses = Courses::with('mentor:id,nama_user')
        ->latest()
        ->paginate(5);

    return view('admins.manage-courses', compact('mentors', 'courses'));
    }

    public function addCourse(Request $request)
    {
        $request->validate([
            'nama_courses' => ['required', 'string','max:255','unique:'.Courses::class],
            'deskripsi_courses' => 'required',
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'mentor_id'=> ['required']
        ]);

        $filePath = public_path('uploads');
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension(); // Get the extension of the uploaded image
            $request->file('image')->move($filePath, $imageName);
        }

        $courses = Courses::create([
            'nama_courses'=> $request->nama_courses,
            'deskripsi_courses' => $request->deskripsi_courses,
            'gambar' => $imageName,
            'mentor_id' => $request->mentor_id,
        ]);

        session()->flash('success','new Courses Has been add');
        return redirect('/manage-courses');
    }

    public function singleCourse($id)
        {
            // Get the course with the assigned mentor
            $course = Courses::with('mentor')->find($id);

            if (!$course) {
                return redirect()->route('manage_courses.index')->with('error', 'Course not found');
            }

            // Fetch mentors who are not assigned to any course, or include the current course's mentor
            $mentors = User::role('mentor')
                        ->whereDoesntHave('course')
                        ->orWhere('id', $course->mentor_id) // Include the current mentor if assigned
                        ->get();

            return view('admins.edit-courses', compact('course', 'mentors'));
        }
    
        public function update(Request $request, $id)
        {
            try  {

                $request->validate([
                    'nama_courses' => 'required|string|max:255',
                    'deskripsi_courses' => 'required|string|max:255',
                    'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                ]);
            
                $course = Courses::findOrFail($id);
                $course->nama_courses = $request->nama_courses;
                $course->deskripsi_courses = $request->deskripsi_courses;
                $course->mentor_id = $request->mentor_id;
                // dd($request->all());
                // Check for a new image upload
                if ($request->hasFile('image')) {
                    // Delete the old image if it exists
                    if ($course->gambar) {
                        File::delete(public_path('uploads/' . $course->gambar));
                    }
            
                    // Store new image
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('uploads'), $imageName);
                    $course->gambar = $imageName;
                }
            
                // dd($course);
                $course->save();
                session()->flash('success', 'Course updated successfully!');
                return redirect('/manage-courses');
            }catch (Exception $e) {
                return $e->getMessage();
        }
        
    }
}
