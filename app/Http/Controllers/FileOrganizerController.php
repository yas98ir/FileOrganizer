<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileOrganizerController extends Controller
{
    public function organizeFiles(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json(['error' => 'Invalid JSON format'], 400);
            }

            $filesData = $data['files'] ?? [];

            // Organize files based on employee
            $employeeFiles = [];
            foreach ($filesData as $fileData) {
                foreach ($fileData as $file => $employee) {
                    $employeeFiles[$employee][] = $file;
                }
            }

            return response()->json($employeeFiles);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
