<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MusicController extends BaseController
{
    private $player;

    public function __construct()
    {
        $this->player = new \App\Models\MusicModel();
        $this->validation = \Config\Services::validation();
    }

    public function player($player)
    {
        echo $player;
    }

      public function insert()
        {
            $uploadDirectory = WRITEPATH . 'uploads/';

            echo "Insert method called.<br>";

            if ($this->request->getFile('filepath')->isValid()) {
                $audio = $this->request->getFile('filepath');
                $uploadedFileExtension = $audio->getExtension(); 
                echo "Uploaded file extension: $uploadedFileExtension<br>";

                $allowedExtensions = ['mp3'];

                $uploadedFileExtension = strtolower($uploadedFileExtension);

                $maxFileSizeKB = 20480; 
                $maxFileSizeInBytes = $maxFileSizeKB * 1024;
                $uploadedFileSize = $audio->getSize();

                if ($uploadedFileSize > $maxFileSizeInBytes) {
                    echo "File size exceeds the maximum allowed size (20 MB).<br>";

                    return redirect()->to('/error')->with('error', 'File size exceeds the maximum allowed size (20 MB).');
                }

                $newName = $audio->getRandomName();
                $newNameWithExtension = pathinfo($newName, PATHINFO_FILENAME) . '.mp3';

                $audio->move($uploadDirectory, $newNameWithExtension);

                $data = [
                    'playlist' => $this->request->getVar('cplaylist'),
                    'file' => $newNameWithExtension, 
                    'file_path' => 'public/uploads/' . $newNameWithExtension 
                ];

                echo "Data ready for insertion: " . print_r($data, true) . "<br>";

                     $this->player->insert($data);

                echo "Data insertion attempted.<br>";

                return redirect()->to('/player')->with('success', 'File uploaded and data saved successfully!');
            } else {
                echo "File upload failed. Please try again.<br>";

                return redirect()->to('/error')->with('error', 'File upload failed. Please try again.');
            }
        }






    public function home()
    {
        $data['player'] = $this->player->findAll();
        return view('welcome_message', $data);
    }
}
