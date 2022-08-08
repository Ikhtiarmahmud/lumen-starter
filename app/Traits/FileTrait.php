<?php


namespace App\Traits;

use Illuminate\Support\Facades\Storage;

/**
 * Description
 *
 * @author Ikhtiar
 *
 * Trait FileTrait
 * @package App\Traits
 */
trait FileTrait
{
    protected $disk = 'public';

    /**
     * Uplaod a file
     * @param file - The file instance
     * @param directoryPath - Directory path relative to base upload path
     * @return file path
     */
    protected function upload($file, $directoryPath, $fileName = "")
    {
        if ($fileName != "") {
            $path = $file->storeAs(
                $directoryPath,
                $fileName,
                $this->disk
            );
        } else {
            $path = $file->store(
                $directoryPath,
                $this->disk
            );
        }

        return $path;
    }
    /**
     * Download the attachments
     * @param filePath full file path including folder name and file name with extension relative to base path
     * @param displayName name of the downloaded file
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    protected function download($filePath, $displayName)
    {
        return Storage::disk($this->disk)->download($filePath, $displayName);
    }

    /**
     * View the file in browser like image or pdf
     * @param filePath full file path including folder name and file name with extension relative to base path
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    protected function view($filePath)
    {
        $headers = array(
            'Content-Disposition' => 'inline',
        );
        return Storage::disk($this->disk)->download($filePath, 'file-name', $headers);
    }

    /**
     * @param filePath full file path including folder name and file name with extension relative to base path
     * @return bool
     */
    protected function deleteFile($filePath)
    {
        return Storage::disk($this->disk)->delete($filePath);
    }
}
