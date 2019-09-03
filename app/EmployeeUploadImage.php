<?php

namespace App;

use Image;
use Illuminate\Http\UploadedFile;

class EmployeeUploadImage
{
    protected $path = "/img/photo/";

    protected $originalPath = '';

    protected $imageUpload;

    protected $imageName = '';

    /**
     * Instantiate a new EmployeeUploadImage instance.
     * 
     * @param Illuminate\Http\UploadedFile
     */
    public function __construct(UploadedFile $file)
    {
        $this->imageUpload = Image::make($file);
        $this->imageName = time() . '-' . $file->getClientOriginalName();
        $this->originalPath = public_path() . $this->path;
    }

    /**
    * Upload image for employee and return image name
    *
    * @return void
    */
    public function upload() {
        $this->imageUpload->orientate();                       
        $this->imageUpload->fit(300, 300, function ($constraint) {
            $constraint->upsize();
        });
        $this->imageUpload->save($this->originalPath . $this->imageName, 80);
    }

    /**
    * Return image name
    *
    * @return string $imageName
    */
    public function getName() {
        return $this->imageName;
    }

}
