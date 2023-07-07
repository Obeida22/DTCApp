<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Short_Courses;
use App\Models\Short_Courses_Docs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShortCoursDocsController extends Controller
{
    /**
     * Store a new short course document record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $short_course_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $short_course_id)
    {
        // Validate the request data
        $request->validate([
            'certificate' => 'required|string',
            'national_identity' => 'required|string',
            'agency_card' => 'required|string',
        ]);

        // Get the short course record from the database
        $shortCourse = Short_Courses::findOrFail($short_course_id);

        // Store the uploaded images and get their paths
        $certificatePath = $this->storeImage($request->input('certificate'));
        $nationalIdentityPath = $this->storeImage($request->input('national_identity'));
        $agencyCardPath = $this->storeImage($request->input('agency_card'));

        // Create a new short course document record
        $shortCourseDoc = new Short_Courses_Docs([
            'certificate' => $certificatePath,
            'national_identity' => $nationalIdentityPath,
            'agency_card' => $agencyCardPath,
        ]);

        // Associate the short course document with the short course record
        $shortCourse->shortCourseDocs()->save($shortCourseDoc);

        // Return a success response
        return response()->json(['message' => 'Short course documents uploaded successfully.']);
    }

    /**
     * Retrieve a short course document record.
     *
     * @param  int  $short_course_id
     * @return \Illuminate\Http\Response
     */
    public function show($short_course_id)
    {
        // Get the short course document record from the database
        $shortCourseDoc = Short_Courses_Docs::where('short_course_id', $short_course_id)->firstOrFail();

        // Convert the text fields to images
        $certificateImage = $this->getImage($shortCourseDoc->certificate);
        $nationalIdentityImage = $this->getImage($shortCourseDoc->national_identity);
        $agencyCardImage = $this->getImage($shortCourseDoc->agency_card);

        // Return the short course document data as a JSON response
        return response()->json([
            'certificate' => $certificateImage,
            'national_identity' => $nationalIdentityImage,
            'agency_card' => $agencyCardImage,
        ]);
    }

    /**
     * Delete a short course document record and associated image files.
     *
     * @param  int  $short_course_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($short_course_id)
    {
        // Get the short course document record from the database
        $shortCourseDoc = Short_Courses_Docs::where('short_course_id', $short_course_id)->firstOrFail();

        // Delete the associated image files
        Storage::delete([$shortCourseDoc->certificate, $shortCourseDoc->national_identity, $shortCourseDoc->agency_card]);

        // Delete the short course document record from the database
        $shortCourseDoc->delete();

        // Return a success response
        return response()->json(['message' => 'Short course documents deleted successfully.']);
    }

    /**
     * Store an image and return its file path.
     *
     * @param  string  $imageData
     * @return string
     */
    private function storeImage($imageData)
    {
        // Decode the base64-encoded image data
        $imageData = base64_decode($imageData);

        // Generate a unique filename for the image
        $filename = uniqid('img_') . '.png';

        // Store the image in the storage directory
        Storage::put($filename, $imageData);

        // Return the file path of the stored image
        return $filename;
    }

    /**
     * Retrieve an image and return it as a response object.
     *
     * @param  string  $imagePath
     * @return \Illuminate\Http\Response
     */
    private function getImage($imagePath)
    {
        // Check if the image file exists in the storage directory
        if (!Storage::exists($imagePath)) {
            abort(404);
        }

        // Read the image data from the storage directory
        $imageData = Storage::get($imagePath);

        // Determine the file format by checking the file extension
        $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $contentType = $extension === 'png' ? 'image/png' : 'image/jpeg';

        // Return the image data as a response object
        return response($imageData)->header('Content-Type', $contentType);
    }
}
