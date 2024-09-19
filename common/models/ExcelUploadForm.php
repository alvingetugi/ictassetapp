<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ExcelUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

	//public $imageFile;

    public function rules()
    {
        return [
            [['file'], 'required'],
            [['file'], 'file', 'extensions' => 'xlsx, xls'],		
        ];
    }
}