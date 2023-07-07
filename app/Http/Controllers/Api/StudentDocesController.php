<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Students_Doce;
use Illuminate\Support\Facades\Storage;

class StudentDocesController extends Controller
{
        /**
         * Store a new student document record.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $student_id
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request, $student_id)
        {
            // Validate the request data
            $request->validate([
                'certificate' => 'required|string',
                'national_identity' => 'required|string',
                'agency_card' => 'required|string',
                'souls_restriction' => 'nullable|string',
            ]);

            // Get the student record from the database
            $student = Students::findOrFail($student_id);

            // Store the uploaded images and get their paths
            $certificatePath = $this->storeImage($request->input('certificate'));
            $nationalIdentityPath = $this->storeImage($request->input('national_identity'));
            $agencyCardPath = $this->storeImage($request->input('agency_card'));
            $soulsRestrictionPath = $request->input('souls_restriction') ? $this->storeImage($request->input('souls_restriction')) : null;

            // Create a new student document record
            $studentDoc = new Students_Doce([
                'certificate' => $certificatePath,
                'national_identity' => $nationalIdentityPath,
                'agency_card' => $agencyCardPath,
                'souls_restriction' => $soulsRestrictionPath,
            ]);

            // Save the student document record to the database
            $student->studentDocs()->save($studentDoc);

            // Return a success response
            return response()->json(['message' => 'Student documents uploaded successfully.']);
        }

        /**
         * Retrieve a student's document record.
         *
         * @param  int  $student_id
         * @return \Illuminate\Http\Response
         */
        public function show($student_id)
        {
            // Get the student document record from the database
            $studentDoc = Students_Doce::where('student_id', $student_id)->firstOrFail();

            // Convert the text fields to images
            $certificateImage = $this->getImage($studentDoc->certificate);
            $nationalIdentityImage = $this->getImage($studentDoc->national_identity);
            $agencyCardImage = $this->getImage($studentDoc->agency_card);
            $soulsRestrictionImage = $studentDoc->souls_restriction ? $this->getImage($studentDoc->souls_restriction) : null;

            // Return the student document data as a JSON response
            return response()->json([
                'certificate' => $certificateImage,
                'national_identity' => $nationalIdentityImage,
                'agency_card' => $agencyCardImage,
                'souls_restriction' => $soulsRestrictionImage,
            ]);
        }

        /**
         * Delete a student's document record and associated image files.
         *
         * @param  int  $student_id
         * @return \Illuminate\Http\Response
         */
        public function destroy($student_id)
        {
            // Get the student document record from the database
            $studentDoc = Students_Doce::where('student_id', $student_id)->firstOrFail();

            // Delete the associated image files
            Storage::delete([$studentDoc->certificate, $studentDoc->national_identity, $studentDoc->agency_card, $studentDoc->souls_restriction]);

            // Delete the student document record from the database
            $studentDoc->delete();

            // Return a success response
            return response()->json(['message' => 'Student documents deleted successfully.']);
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
            // Check ifthe image file exists in the storage directory
            if (!Storage::exists($imagePath)) {
                abort(404);
            }

            // Read the image data from the storage directory
            $imageData = Storage::get($imagePath);

            // Generate a response object for the image data
            $response = response($imageData);

            // Set the content type of the response to image/png
            $response->header('Content-Type', 'image/png');

            // Return the response object
            return $response;
        }
}
