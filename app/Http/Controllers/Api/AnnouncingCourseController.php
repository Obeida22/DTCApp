<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcing_Courses;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncingCourseController extends Controller
{
    /**
     * Store a new announcing course record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $employee_id)
    {
        // Validate the request data
        $request->validate([
            'courses_name' => 'required|string',
            'announcing_text' => 'required|string',
            'announcing_image' => 'nullable|string',
        ]);

        // Get the employee record from the database
        $employee = Employees::findOrFail($employee_id);

        // Store the uploaded image and get its path
        $announcingImagePath = $request->has('announcing_image') ? $this->storeImage($request->input('announcing_image')) : null;

        // Create a new announcing course record
        $announcingCourse = new Announcing_Courses([
            'courses_name' => $request->input('courses_name'),
            'announcing_text' => $request->input('announcing_text'),
            'announcing_image' => $announcingImagePath,
        ]);

        // Associate the announcing course with the employee record
        $employee->announcingCourses()->save($announcingCourse);

        // Return a success response
        return response()->json(['message' => 'Announcing course created successfully.']);
    }

    /**
     * Retrieve an announcing course record.
     *
     * @param  int  $employee_id
     * @param  int  $course_id
     * @return \Illuminate\Http\Response
     */
    public function show($employee_id, $course_id)
    {
        // Get the announcing course record from the database
        $announcingCourse = Announcing_Courses::where('employee_id', $employee_id)->findOrFail($course_id);

        // Convert the announcing image to an image file
        $announcingImage = $this->getImage($announcingCourse->announcing_image);

        // Return the announcing course data as a JSON response
        return response()->json([
            'courses_name' => $announcingCourse->courses_name,
            'announcing_text' => $announcingCourse->announcing_text,
            'announcing_image' => $announcingImage,
        ]);
    }

    /**
     * Update an announcing course record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $employee_id
     * @param  int  $course_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employee_id, $course_id)
    {
        // Validate the request data
        $request->validate([
            'courses_name' => 'required|string',
            'announcing_text' => 'required|string',
            'announcing_image' => 'nullable|string',
        ]);

        // Get the announcing course record from the database
        $announcingCourse = Announcing_Courses::where('employee_id', $employee_id)->findOrFail($course_id);

        // Update the announcing course record
        $announcingCourse->courses_name = $request->input('courses_name');
        $announcingCourse->announcing_text = $request->input('announcing_text');
        if ($request->has('announcing_image')) {
            // Store the new uploaded image and get its path
            $announcingImagePath = $this->storeImage($request->input('announcing_image'));
            // Delete the old image file
            Storage::delete($announcingCourse->announcing_image);
            // Update the announcing course record with the new image file path
            $announcingCourse->announcing_image = $announcingImagePath;
        }
        $announcingCourse->save();

        // Return a success response
        return response()->json(['message' => 'Announcing course updated successfully.']);
    }

    /**
     * Delete an announcing course record and associated image file.
     *
     * @param  int  $employee_id
     * @param  int  $course_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id, $course_id)
    {
        // Get the announcing course record from the database
        $announcingCourse = Announcing_Courses::where('employee_id', $employee_id)->findOrFail($course_id);

        // Delete the associated image file
        if ($announcingCourse->announcing_image) {
            Storage::delete($announcingCourse->announcing_image);
        }

        // Delete the announcingcourse record
        $announcingCourse->delete();

        // Return a success response
        return response()->json(['message' => 'Announcing course deleted successfully.']);
    }

    /**
     * Store an uploaded image and return its path.
     *
     * @param  string  $imageData
     * @return string
     */
    private function storeImage($imageData)
    {
        // Decode the base64-encoded image data
        $decodedImage = base64_decode($imageData);

        // Generate a unique filename for the image
        $filename = md5(uniqid()) . '.png';

        // Store the image file in the public storage directory
        Storage::disk('public')->put($filename, $decodedImage);

        // Return the image file path
        return 'storage/' . $filename;
    }

    /**
     * Retrieve an image file and return its base64-encoded data.
     *
     * @param  string  $imagePath
     * @return string|null
     */
    private function getImage($imagePath)
    {
        if (!$imagePath) {
            return null;
        }

        // Get the contents of the image file
        $imageData = Storage::get($imagePath);

        // Encode the image data as base64
        $base64Data = base64_encode($imageData);

        // Return the base64-encoded image data
        return $base64Data;
    }
}
