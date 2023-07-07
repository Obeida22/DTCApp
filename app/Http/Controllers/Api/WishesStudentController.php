<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishes_Students;


class WishesStudentController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'specialty_id' => 'required|integer',
            'desire_order' => 'required|integer',
        ]);

        // Check the student's degree to determine the maximum number of wishes
        $degree = Wishes_Students::table('students')->where('Student_ID', $validatedData['student_id'])->value('Degree');
        $maxWishes = 0;

        switch ($degree) {
            case 'Scientific':
                $maxWishes = 6;
                break;
            case 'Literary':
                $maxWishes = 5;
                break;
            case 'Industrial':
                $maxWishes = 1;
                break;
            case 'Feminist Arts':
                $maxWishes = 2;
                break;
            case 'Preparatory':
                $maxWishes = 6;
                break;
            default:
                // Unknown degree
                return response()->json(['message' => 'Unknown degree'], 400);
        }

        // Check if the student already has the maximum number of wishes
        $existingWishesCount = Wishes_Students::table('wishes_students')
            ->where('Student_ID', $validatedData['student_id'])
            ->count();

        if ($existingWishesCount >= $maxWishes) {
            return response()->json(['message' => 'Student already has the maximum number of wishes'], 400);
        }

        // Check if the wish already exists
        $existingWish = Wishes_Students::table('wishes_students')
            ->where('Student_ID', $validatedData['student_id'])
            ->where('Specialty_ID', $validatedData['specialty_id'])
            ->where('Desire_Order', $validatedData['desire_order'])
            ->first();

        if ($existingWish !== null) {
            return response()->json(['message' => 'Wish already exists'], 400);
        }

        // Insert the wish
        Wishes_Students::table('wishes_students')->insert([
            'Student_ID' => $validatedData['student_id'],
            'Specialty_ID' => $validatedData['specialty_id'],
            'Desire_Order' => $validatedData['desire_order'],
        ]);

        return response()->json(['message' => 'Wish created'], 201);
    }

    public function read(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'specialty_id' => 'required|integer',
            'desire_order' => 'required|integer',
        ]);

        $wish = Wishes_Students::table('wishes_students')
            ->where('Student_ID', $validatedData['student_id'])
            ->where('Specialty_ID', $validatedData['specialty_id'])
            ->where('Desire_Order', $validatedData['desire_order'])
            ->first();

        if ($wish === null) {
            return response()->json(['message' => 'Wish not found'], 404);
        }

        return response()->json(['message' => 'Wish found', 'data' => $wish], 200);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'specialty_id' => 'required|integer',
            'desire_order' => 'required|integer',
            'new_student_id' => 'required|integer',
            'new_specialty_id' => 'required|integer',
            'new_desire_order' => 'required|integer',
        ]);

        // Check the student's degree to determine the maximum number of wishes
        $degree = Wishes_Students::table('students')->where('Student_ID', $validatedData['new_student_id'])->value('Degree');
        $maxWishes = 0;

        switch ($degree) {
            case 'Scientific':
                $maxWishes = 6;
                break;
            case 'Literary':
                $maxWishes = 5;
                break;
            case 'Industrial':
                $maxWishes = 1;
                break;
            case 'Feminist Arts':
                $maxWishes = 2;
                break;
            case 'Preparatory':
                $maxWishes = 6;
                break;
            default:
                // Unknown degree
                return response()->json(['message'=> 'Unknown degree'], 400);
        }

        // Check if the student already has the maximum number of wishes
        $existingWishesCount = Wishes_Students::table('wishes_students')
            ->where('Student_ID', $validatedData['new_student_id'])
            ->count();

        if ($existingWishesCount >= $maxWishes) {
            return response()->json(['message' => 'Student already has the maximum number of wishes'], 400);
        }

        // Check if the new wish already exists
        $existingWish = Wishes_Students::table('wishes_students')
            ->where('Student_ID', $validatedData['new_student_id'])
            ->where('Specialty_ID', $validatedData['new_specialty_id'])
            ->where('Desire_Order', $validatedData['new_desire_order'])
            ->first();

        if ($existingWish !== null) {
            return response()->json(['message' => 'New wish already exists'], 400);
        }

        // Update the wish
        $updatedRows = Wishes_Students::table('wishes_students')
            ->where('Student_ID', $validatedData['student_id'])
            ->where('Specialty_ID', $validatedData['specialty_id'])
            ->where('Desire_Order', $validatedData['desire_order'])
            ->update([
                'Student_ID' => $validatedData['new_student_id'],
                'Specialty_ID' => $validatedData['new_specialty_id'],
                'Desire_Order' => $validatedData['new_desire_order'],
            ]);

        if ($updatedRows === 0) {
            return response()->json(['message' => 'Wish not found'], 404);
        }

        return response()->json(['message' =>'Wish updated'], 200);
    }

    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|integer',
            'specialty_id' => 'required|integer',
            'desire_order' => 'required|integer',
        ]);

        $deletedRows = Wishes_Students::table('wishes_students')
            ->where('Student_ID', $validatedData['student_id'])
            ->where('Specialty_ID', $validatedData['specialty_id'])
            ->where('Desire_Order', $validatedData['desire_order'])
            ->delete();

        if ($deletedRows === 0) {
            return response()->json(['message' => 'Wish not found'], 404);
        }

        return response()->json(['message' => 'Wish deleted'], 200);
    }
}
