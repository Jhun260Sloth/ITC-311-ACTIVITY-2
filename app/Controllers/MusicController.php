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
            // Validate the uploaded file
            if ($this->validate([
                'filepath' => [
                    
                     'uploaded[filepath]',
                        'mime_in[filepath,audio/mpeg,audio/mp3]',
                        'max_size[filepath,20480]', // 20 MB (20 * 1024 KB)
                ]
            ])) {
                // Upload and save the file
                $audio = $this->request->getFile('filepath');
                $newName = $audio->getRandomName();
                $audio->move(ROOTPATH . 'public/uploads', $newName);

                $data = [
                    'playlist' => $this->request->getVar('cplaylist'),
                    'file' => $newName,
                    'file_path' => 'uploads/' . $newName
                ];

                $this->player->insert($data); // Assuming 'player' is your model.

                return redirect()->to('/player')->with('success', 'File uploaded and data saved successfully!');
            } else {
                // Validation failed, capture the errors and pass them to the view
                $validationErrors = $this->validation->getErrors();

                // Load the view and pass validation errors
                return view('upload_audio', ['validationErrors' => $validationErrors]);
            }
        }




    public function home()
    {
        $data['player'] = $this->player->findAll();
        return view('welcome_message', $data);
    }
}
