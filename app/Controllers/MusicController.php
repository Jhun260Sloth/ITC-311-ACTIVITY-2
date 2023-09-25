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

        if ($this->validate([
            'filepath' => [
                'uploaded[filepath]',
                'mime_in[filepath,audio/mpeg,audio/mp3]',
                'max_size[filepath,20480]',
            ]
        ])) {
            $audio = $this->request->getFile('filepath');
            $newName = $audio->getRandomName();
            $audio->move($uploadDirectory, $newName);

            $data = [
                'playlist' => $this->request->getVar('cplaylist'),
                'file' => $newName,
                'file_path' => 'uploads/' . $newName
            ];

            $this->player->insert($data);

            return redirect()->to('/player')->with('success', 'File uploaded and data saved successfully!');
        } else {
            $validationErrors = $this->validation->getErrors();
            return view('upload_audio', ['validationErrors' => $validationErrors]);
        }
    }





    public function home()
    {
        $data['player'] = $this->player->findAll();
        return view('welcome_message', $data);
    }
}
