<?php
namespace app\admin\controller;

use think\Controller;
use think\Exception;
use X2\File\UploadedFile;

class Upload extends Controller
{
    public function save(){
        $type = input('?get.type')?input('get.type'):'file';
        $upload = new UploadedFile($_FILES['files']['tmp_name'][0],$_FILES['files']['name'][0]);
        $path = 'upload/'.$type.'/'.date('Y/m/d').'/';

        try{
            $filename = time().'.'.$upload->guessExtension();
        }catch(Exception $e){
            echo $e->getMessage();exit();
        }

        $result = $upload->move(ROOT_PATH.'public'.DS.$path,$filename);
        die(json_encode([
            'Success' => true,
            'Model' => [DOMAIN.$path.$filename],
        ]));
    }
}
