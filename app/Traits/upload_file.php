<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Correctly import File facade
use Illuminate\Support\Facades\Log;

trait upload_file
{
    /**
     * Upload an image and return the path.
     *
     * @param Request $request
     * @param string $inputName
     * @param string|null $oldPath
     * @param string $path
     * @return string|null
     */
    public function uploadFile(Request $request, $inputName, $oldPath = null, $path = '/uploads')
    {
        if ($request->hasFile($inputName)) {
            // Handle old image deletion
            if ($oldPath && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            $image = $request->file($inputName);
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;

            // Ensure the directory exists
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0755, true, true);
            }

            try {
                $image->move(public_path($path), $imageName);
            } catch (\Exception $e) {
                Log::error("File upload error: " . $e->getMessage());
                return null; // Return null if upload fails
            }

            return $path . '/' . $imageName;
        }

        return null;
    }

    /**
     * Remove an image from the given path.
     *
     * @param string $path
     * @return void
     */
    public function removeFile(string $fileName)
{
    $filePath = public_path($fileName);
    if (File::exists($filePath)) {
        File::delete($filePath);
    } else {
        // Log if file does not exist
        Log::warning('File not found for deletion: ' . $filePath);
    }
}

}
