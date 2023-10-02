<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MusicController extends BaseController
{
    private $player;
    private $playL;

    public function __construct()
    {
        $this->player = new \App\Models\MusicModel();
        $this->playL = new \App\Models\MusicL();
        $this->validation = \Config\Services::validation();
    }

    public function player($player)
    {
        echo $player;
    }

      public function insert()
        {
           $mp3File = $this->request->getFile('filepath'); 

            if ($mp3File->isValid() && !$mp3File->hasMoved()) {
                $mp3File->move(ROOTPATH . 'public/uploads'); 
                $mp3FileName = '/uploads/' . $mp3File->getName(); 
                $mp3Name = $mp3File->getName();

                $data = [
                    'file' => $mp3Name,
                    'file_path' => $mp3FileName,
                    'listtype' => $this->request->getVar('play'),
                ];

                    $this->player->save($data);
                    return redirect()->to('/');
                }
                
             else {
                return redirect()->back()->with('error', 'MP3 file upload failed.');
            }

        }



    public function insert2()
        {
        
                $data = [
                    'playlist' => $this->request->getVar('cplaylist'),
                ];

                    $this->playL->save($data);
                    return redirect()->to('/');

        }



    public function home()
    {
        $data['player'] = $this->player->findAll();
        $data['playL'] = $this->playL->findAll();
        return view('welcome_message', $data);
    }

    public function delete($id)
    {
        $this->player->delete($id);
        return redirect()->to('/');
    }

     public function search()
    {
        $searchQuery = $this->request->getVar('file');
        $data['searchQuery'] = $searchQuery;
        return view('welcome_message', $data);
    }

}
