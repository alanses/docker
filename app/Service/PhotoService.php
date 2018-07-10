<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

Class PhotoService {

    private $smallDir = "small";

    private function getNameOfDirectory($model){
        $dir = "images" . DIRECTORY_SEPARATOR . (new \ReflectionClass($model))->getShortName() . DIRECTORY_SEPARATOR;
        return $dir;
    }

    private function getFileName($model, $request)
    {
        $name = $model->id ."-". $request->getClientOriginalName();
        return $name;
    }

    private function locationBig($dir, $model, $image){
        $location = public_path($dir . $this->getFileName($model, $image));
        return $location;
    }

    private function locationSmall($dir, $model, $image){
        $locationSmall = public_path($dir . $this->smallDir . DIRECTORY_SEPARATOR . $this->getFileName($model, $image));
        return $locationSmall;
    }

    private function getBigImage($model){
        $pathToBig = $this->getNameOfDirectory($model) . "$model->image";
        return $pathToBig;
    }

    private function getSmallImage($model){
        $pathToSmall = $this->getNameOfDirectory($model) . $this->smallDir . DIRECTORY_SEPARATOR . "$model->image" ;
        return $pathToSmall;
    }

    private function Resize($image, $location, $locationSmall){
        $height = Image::make($image)->height();
        $width = Image::make($image)->width();
        if ($height > $width) {

            Image::make($image)->heighten(600, function ($constraint) {
                $constraint->upsize();
            })->save($location);

            Image::make($image)->heighten(100, function ($constraint) {
                $constraint->upsize();
            })->save($locationSmall);

        } else {

            Image::make($image)->widen(800, function ($constraint) {
                $constraint->upsize();
            })->save($location);

            Image::make($image)->widen(100, function ($constraint) {
                $constraint->upsize();
            })->save($locationSmall);
        }
    }

    private function createDir($dir){

        if (!file_exists(public_path($dir)) )
            mkdir(public_path($dir) , 0777, true);

        if(!file_exists($dir . $this->smallDir . DIRECTORY_SEPARATOR) )
            mkdir(public_path($dir . $this->smallDir . DIRECTORY_SEPARATOR) , 0777, true);
    }

    public function savePhoto($request, $model, $dir=null){
        if(empty($dir)){
            $dir = $this->getNameOfDirectory($model);
        }
        $image = $request->file('image');

        $this->createDir($dir);
        $this->Resize($image, $this->locationBig($dir, $model, $image), $this->locationSmall($dir, $model, $image));
        $model->image = $this->getFileName($model, $image);

        $model->save();
    }

    public function saveManyPhoto($request, $model, $tableForPhotos){
        $dir = $this->getNameOfDirectory($model);

        $image = $request->file('image');
        $this->createDir($dir);

        foreach ($image as $one) {
            $this->Resize($one, $this->locationBig($dir, $model, $one), $this->locationSmall($dir, $model, $one));
            $tableForPhotos->create([
                'product_id' => $model->id,
                'name' => $this->getFileName($model, $one)
            ]);
        }
    }


    public function deletePhoto($model){
        $arrFile = [];
        if(!empty($model->photos)){
            foreach ($model->photos as $one){
                array_push($arrFile,
                    $this->getBigImage($model) . $one['original']['name'],
                    $this->getSmallImage($model) . $one['original']['name']
                );
            }
        }else{
            $arrFile = [$this->getBigImage($model), $this->getSmallImage($model)];
        }
        File::delete($arrFile);
    }



    public function updatePhoto($request, $model){
        $dir = $this->getNameOfDirectory($model);

        $this->createDir($dir);

        $image = $request->file('image'); // Треба якось виділити окремо

        $this->Resize($image, $this->locationBig($dir, $model, $image), $this->locationSmall($dir, $model, $image));

        $data['image'] = $this->getFileName($model, $image);

        File::delete($this->getSmallImage($model), $this->getBigImage($model));

        $model->update($data);
    }

}
