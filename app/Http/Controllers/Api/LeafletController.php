<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\Leaflets;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeafletController extends Controller
{
    /**
     * Store a new leaflet record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $department_id
     * @param  int  $teacher_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $department_id, $teacher_id)
    {
        // Validate the request data
        $request->validate([
            'leaflet_title' => 'required|string',
            'leaflet_text' => 'required|string',
            'leaflet_image' => 'nullable|string',
        ]);

        // Get the department and teacher records from the database
        $department = Departments::findOrFail($department_id);
        $teacher = Teachers::findOrFail($teacher_id);

        // Store the uploaded image and get its path
        $leafletImagePath = $request->has('leaflet_image') ? $this->storeImage($request->input('leaflet_image')) : null;

        // Create a new leaflet record
        $leaflet = new Leaflets([
            'leaflet_title' => $request->input('leaflet_title'),
            'leaflet_text' => $request->input('leaflet_text'),
            'leaflet_image' => $leafletImagePath,
        ]);

        // Associate the leaflet with the department and teacher records
        $department->leaflets()->save($leaflet);
        $teacher->leaflets()->save($leaflet);

        // Return a success response
        return response()->json(['message' => 'Leaflet created successfully.']);
    }

    /**
     * Retrieve a leaflet record.
     *
     * @param  int  $department_id
     * @param  int  $teacher_id
     * @param  int  $leaflet_id
     * @return \Illuminate\Http\Response
     */
    public function show($department_id, $teacher_id, $leaflet_id)
    {
        // Get the leaflet record from the database
        $leaflet = Leaflets::where('department_id', $department_id)
                          ->where('teacher_id', $teacher_id)
                          ->findOrFail($leaflet_id);

        // Convert the leaflet image to an image file
        $leafletImage = $this->getImage($leaflet->leaflet_image);

        // Return the leaflet data as a JSON response
        return response()->json([
            'leaflet_title' => $leaflet->leaflet_title,
            'leaflet_text' => $leaflet->leaflet_text,
            'leaflet_image' => $leafletImage,
        ]);
    }

    /**
     * Update a leaflet record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $department_id
     * @param  int  $teacher_id
     * @param  int  $leaflet_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $department_id, $teacher_id, $leaflet_id)
    {
        // Validate the request data
        $request->validate([
            'leaflet_title' => 'required|string',
            'leaflet_text' => 'required|string',
            'leaflet_image' => 'nullable|string',
        ]);

        // Get the leaflet record from the database
        $leaflet = Leaflets::where('department_id', $department_id)
                          ->where('teacher_id', $teacher_id)
                          ->findOrFail($leaflet_id);

        // Update the leaflet record
        $leaflet->leaflet_title = $request->input('leaflet_title');
        $leaflet->leaflet_text = $request->input('leaflet_text');
        if ($request->has('leaflet_image')) {
            // Store the new uploaded image and get its path
            $leafletImagePath = $this->storeImage($request->input('leaflet_image'));
            // Delete the old image file
            Storage::delete($leaflet->leaflet_image);
            // Update the leaflet record with the new image file path
            $leaflet->leaflet_image = $leafletImagePath;
        }
        $leaflet->save();

        // Return a success response
        return response()->json(['message' => 'Leaflet updated successfully.']);
    }

    /**
     * Delete a leaflet record and associated image file.
     *
     * @param  int  $department_id
     * @param  int  $teacher_id
     * @param  int  $leaflet_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($department_id, $teacher_id, $leaflet_id)
    {
        // Get the leaflet record from the database
        $leaflet =Leaflets::where('department_id', $department_id)
                          ->where('teacher_id', $teacher_id)
                          ->findOrFail($leaflet_id);

        // Delete the leaflet image file
        Storage::delete($leaflet->leaflet_image);

        // Delete the leaflet record
        $leaflet->delete();

        // Return a success response
        return response()->json(['message' => 'Leaflet deleted successfully.']);
    }

    /**
     * Store an uploaded image and return its path.
     *
     * @param  string  $imageData
     * @return string
     */
    private function storeImage($imageData)
    {
        // Decode the base64 image data and generate a unique filename
        $imageData = base64_decode($imageData);
        $filename = uniqid('', true) . '.png';

        // Store the image file in the storage/app/public directory
        Storage::disk('public')->put($filename, $imageData);

        // Return the image file path
        return 'storage/' . $filename;
    }

    /**
     * Get the image file contents for a given path.
     *
     * @param  string|null  $imagePath
     * @return string|null
     */
    private function getImage($imagePath)
    {
        if ($imagePath) {
            // Get the image file contents from storage
            $imageData = Storage::disk('public')->get($imagePath);

            // Convert the image data to a base64-encoded data URI
            $imageDataUri = 'data:image/png;base64,' . base64_encode($imageData);

            // Return the data URI
            return $imageDataUri;
        } else {
            return null;
        }
    }
}
