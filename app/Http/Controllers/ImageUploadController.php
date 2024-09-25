<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function index()
    {
        // Fetch all files in the uploads directory
        $files = Storage::disk('public')->files('uploads');

        return view('images.index', compact('files'));
    }
    public function showForm()
    {
        return view('image-upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $uploadDir = Storage::disk('public')->path('uploads');

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $resizedImages = $this->uploadAndResizeImage('image', $uploadDir);

        if ($resizedImages) {
            return redirect()->back()->with('success', 'Image uploaded and resized successfully')->with('images', $resizedImages);
        } else {
            return redirect()->back()->with('error', 'Failed to upload or resize image');
        }
    }

    private function uploadAndResizeImage($inputName, $uploadDir)
    {
        if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $file = $_FILES[$inputName];
        $fileName = basename($file['name']);
        $targetPath = $uploadDir . '/' . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            return false;
        }

        $sizes = [
            'small' => [200, 200],
            'medium' => [600, 600],
            'large' => [1200, 1200]
        ];

        $resizedImages = [];

        foreach ($sizes as $size => $dimensions) {
            $resizedPath = $uploadDir . '/' . $size . '_' . $fileName;
            if ($this->resizeImage($targetPath, $resizedPath, $dimensions[0], $dimensions[1])) {
                $resizedImages[$size] = $resizedPath;
            }
        }

        return $resizedImages;
    }

    private function resizeImage($sourcePath, $targetPath, $maxWidth, $maxHeight, $quality = 80)
    {
        list($origWidth, $origHeight, $type) = getimagesize($sourcePath);

        if ($maxWidth == 0) {
            $maxWidth  = $origWidth;
        }

        if ($maxHeight == 0) {
            $maxHeight = $origHeight;
        }

        $widthRatio = $maxWidth / $origWidth;
        $heightRatio = $maxHeight / $origHeight;

        $ratio = min($widthRatio, $heightRatio);

        $newWidth  = (int)$origWidth  * $ratio;
        $newHeight = (int)$origHeight * $ratio;

        $newImage = \imagecreatetruecolor($newWidth, $newHeight);

        switch ($type) {
            case IMAGETYPE_JPEG:
                $source = \imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $source = \imagecreatefrompng($sourcePath);
                \imagealphablending($newImage, false);
                \imagesavealpha($newImage, true);
                break;
            case IMAGETYPE_GIF:
                $source = \imagecreatefromgif($sourcePath);
                break;
            default:
                return false;
        }

        \imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

        switch ($type) {
            case IMAGETYPE_JPEG:
                \imagejpeg($newImage, $targetPath, $quality);
                break;
            case IMAGETYPE_PNG:
                \imagepng($newImage, $targetPath, 9);
                break;
            case IMAGETYPE_GIF:
                \imagegif($newImage, $targetPath);
                break;
        }

        \imagedestroy($newImage);
        \imagedestroy($source);

        return true;
    }
}
