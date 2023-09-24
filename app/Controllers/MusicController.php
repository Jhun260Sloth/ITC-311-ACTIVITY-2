<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Validation\Rules;


class MusicController extends BaseController
{
    private $player;

    public function __construct()
    {
        $this->player = new \App\Models\MusicModel();
    }

    public function player($player)
    {
        echo $player;
    }

   public function insert()
        {
            $mp3File = $this->request->getFile('mp3_file');
            $validation = \Config\Services::validation();
           
            $validation->setRule('mp3_file', 'MP3 File', 'uploaded[mp3_file]|max_size[mp3_file,10240]|ext_in[mp3_file,mp3]');

            if ($validation->withRequest($this->request)->run()) {
            
                $mp3FilePath = $mp3File->getTemporaryPath();
                
                $data = [
                    'playslist' => $this->request->getVar('cplaylist'),
                    'file' => $mp3File->getName(),
                    'file_path' => $mp3FilePath
                ];

                $this->player->save($data);
                return redirect()->to('/player');

            } else {
                return redirect()->to('/player')->withInput()->with('error', $validation->getErrors());
            }
        }



    public function home()
    {
        $data['player'] = $this->player->findAll();
        return view('welcome_message', $data);
    }
}
