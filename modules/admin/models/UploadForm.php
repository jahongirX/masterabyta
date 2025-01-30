<?php 

namespace app\modules\admin\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

use app\helpers\CustomHelper;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $map;
    public $image_desctop;
    public $image_tablet;
    public $image_mobile;
    public $image;
    public $image2;
    public $image3;
    public $image4;
    public $image5;
    public $image6;
    public $image7;
    public $image8;
    public $image9;
    public $image10;
    public $image11;
    public $image12;
    public $image13;
    public $image14;
    public $image15;

    public $image_1_1;
    public $image_1_2;
    public $image_1_3;
    public $image_2_1;
    public $image_2_2;
    public $image_2_3;
    public $image_3_1;
    public $image_3_2;
    public $image_3_3;
    public $image_4_1;
    public $image_4_2;
    public $image_4_3;
    public $image_5_1;
    public $image_5_2;
    public $image_5_3;
    public $image_6_1;
    public $image_6_2;
    public $image_6_3;
    public $image_7_1;
    public $image_7_2;
    public $image_7_3;
    public $image_8_1;
    public $image_8_2;
    public $image_8_3;
    public $image_9_1;
    public $image_9_2;
    public $image_9_3;
    public $image_10_1;
    public $image_10_2;
    public $image_10_3;
    public $image_11_1;
    public $image_11_2;
    public $image_11_3;
    public $image_12_1;
    public $image_12_2;
    public $image_12_3;
    public $image_13_1;
    public $image_13_2;
    public $image_13_3;
    public $image_14_1;
    public $image_14_2;
    public $image_14_3;
    public $image_15_1;
    public $image_15_2;
    public $image_15_3;
    public $image_16_1;
    public $image_16_2;
    public $image_16_3;
    public $image_17_1;
    public $image_17_2;
    public $image_17_3;
    public $image_18_1;
    public $image_18_2;
    public $image_18_3;
    public $image_19_1;
    public $image_19_2;
    public $image_19_3;
    public $image_20_1;
    public $image_20_2;
    public $image_20_3;
    public $image_21_1;
    public $image_21_2;
    public $image_21_3;
    public $image_22_1;
    public $image_22_2;
    public $image_22_3;
    public $image_23_1;
    public $image_23_2;
    public $image_23_3;
    public $image_24_1;
    public $image_24_2;
    public $image_24_3;
    public $image_25_1;
    public $image_25_2;
    public $image_25_3;
    public $image_26_1;
    public $image_26_2;
    public $image_26_3;
    public $image_27_1;
    public $image_27_2;
    public $image_27_3;
    public $image_28_1;
    public $image_28_2;
    public $image_28_3;
    public $image_29_1;
    public $image_29_2;
    public $image_29_3;
    public $image_30_1;
    public $image_30_2;
    public $image_30_3;

    protected $image_name;

    public function rules()
    {
        return [
            // [['image'], 'file', 'extensions' => 'png, jpg, jpeg, svg'],
            [['map', 'image_desctop', 'image_tablet', 'image_mobile'], 'file'],
            [['image', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'image8', 'image9', 'image10', 'image11', 'image12', 'image13', 'image14', 'image15'], 'file'],
            [['image_1_1', 'image_1_2', 'image_1_3', 'image_2_1', 'image_2_2', 'image_2_3', 'image_3_1', 'image_3_2', 'image_3_3', 'image_4_1', 'image_4_2', 'image_4_3', 'image_5_1', 'image_5_2', 'image_5_3', 'image_6_1', 'image_6_2', 'image_6_3', 'image_7_1', 'image_7_2', 'image_7_3', 'image_8_1', 'image_8_2', 'image_8_3', 'image_9_1', 'image_9_2', 'image_9_3', 'image_10_1', 'image_10_2', 'image_10_3', 'image_11_1', 'image_11_2', 'image_11_3', 'image_12_1', 'image_12_2', 'image_12_3', 'image_13_1', 'image_13_2', 'image_13_3', 'image_14_1', 'image_14_2', 'image_14_3', 'image_15_1', 'image_15_2', 'image_15_3', 'image_16_1', 'image_16_2', 'image_16_3', 'image_17_1', 'image_17_2', 'image_17_3', 'image_18_1', 'image_18_2', 'image_18_3', 'image_19_1', 'image_19_2', 'image_19_3', 'image_20_1', 'image_20_2', 'image_20_3', 'image_21_1', 'image_21_2', 'image_21_3', 'image_22_1', 'image_22_2', 'image_22_3', 'image_23_1', 'image_23_2', 'image_23_3', 'image_24_1', 'image_24_2', 'image_24_3', 'image_25_1', 'image_25_2', 'image_25_3', 'image_26_1', 'image_26_2', 'image_26_3', 'image_27_1', 'image_27_2', 'image_27_3', 'image_28_1', 'image_28_2', 'image_28_3', 'image_29_1', 'image_29_2', 'image_29_3', 'image_30_1', 'image_30_2', 'image_30_3'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'map' => 'Карта',
            'image_desctop' => 'Изображение (десктоп)',
            'image_tablet' => 'Изображение (планшеты)',
            'image_mobile' => 'Изображение (мобильные)',
            'image' => 'Изображение',
            'image2' => 'Изображение 2',
            'image3' => 'Изображение 3',
            'image4' => 'Изображение 4',
            'image5' => 'Изображение 5',
            'image6' => 'Изображение 6',
            'image7' => 'Изображение 7',
            'image8' => 'Изображение 8',
            'image9' => 'Изображение 9',
            'image10' => 'Изображение 10',
            'image11' => 'Изображение 11',
            'image12' => 'Изображение 12',
            'image13' => 'Изображение 13',
            'image14' => 'Изображение 14',
            'image15' => 'Изображение 15',

            'image_1_1' => 'Изображение 1',
            'image_1_2' => 'Изображение 2',
            'image_1_3' => 'Изображение 3',
            'image_2_1' => 'Изображение 1',
            'image_2_2' => 'Изображение 2',
            'image_2_3' => 'Изображение 3',
            'image_3_1' => 'Изображение 1',
            'image_3_2' => 'Изображение 2',
            'image_3_3' => 'Изображение 3',
            'image_4_1' => 'Изображение 1',
            'image_4_2' => 'Изображение 2',
            'image_4_3' => 'Изображение 3',
            'image_5_1' => 'Изображение 1',
            'image_5_2' => 'Изображение 2',
            'image_5_3' => 'Изображение 3',
            'image_6_1' => 'Изображение 1',
            'image_6_2' => 'Изображение 2',
            'image_6_3' => 'Изображение 3',
            'image_7_1' => 'Изображение 1',
            'image_7_2' => 'Изображение 2',
            'image_7_3' => 'Изображение 3',
            'image_8_1' => 'Изображение 1',
            'image_8_2' => 'Изображение 2',
            'image_8_3' => 'Изображение 3',
            'image_9_1' => 'Изображение 1',
            'image_9_2' => 'Изображение 2',
            'image_9_3' => 'Изображение 3',
            'image_10_1' => 'Изображение 1',
            'image_10_2' => 'Изображение 2',
            'image_10_3' => 'Изображение 3',
            'image_11_1' => 'Изображение 1',
            'image_11_2' => 'Изображение 2',
            'image_11_3' => 'Изображение 3',
            'image_12_1' => 'Изображение 1',
            'image_12_2' => 'Изображение 2',
            'image_12_3' => 'Изображение 3',
            'image_13_1' => 'Изображение 1',
            'image_13_2' => 'Изображение 2',
            'image_13_3' => 'Изображение 3',
            'image_14_1' => 'Изображение 1',
            'image_14_2' => 'Изображение 2',
            'image_14_3' => 'Изображение 3',
            'image_15_1' => 'Изображение 1',
            'image_15_2' => 'Изображение 2',
            'image_15_3' => 'Изображение 3',
            'image_16_1' => 'Изображение 1',
            'image_16_2' => 'Изображение 2',
            'image_16_3' => 'Изображение 3',
            'image_17_1' => 'Изображение 1',
            'image_17_2' => 'Изображение 2',
            'image_17_3' => 'Изображение 3',
            'image_18_1' => 'Изображение 1',
            'image_18_2' => 'Изображение 2',
            'image_18_3' => 'Изображение 3',
            'image_19_1' => 'Изображение 1',
            'image_19_2' => 'Изображение 2',
            'image_19_3' => 'Изображение 3',
            'image_20_1' => 'Изображение 1',
            'image_20_2' => 'Изображение 2',
            'image_20_3' => 'Изображение 3',
            'image_21_1' => 'Изображение 1',
            'image_21_2' => 'Изображение 2',
            'image_21_3' => 'Изображение 3',
            'image_22_1' => 'Изображение 1',
            'image_22_2' => 'Изображение 2',
            'image_22_3' => 'Изображение 3',
            'image_23_1' => 'Изображение 1',
            'image_23_2' => 'Изображение 2',
            'image_23_3' => 'Изображение 3',
            'image_24_1' => 'Изображение 1',
            'image_24_2' => 'Изображение 2',
            'image_24_3' => 'Изображение 3',
            'image_25_1' => 'Изображение 1',
            'image_25_2' => 'Изображение 2',
            'image_25_3' => 'Изображение 3',
            'image_26_1' => 'Изображение 1',
            'image_26_2' => 'Изображение 2',
            'image_26_3' => 'Изображение 3',
            'image_27_1' => 'Изображение 1',
            'image_27_2' => 'Изображение 2',
            'image_27_3' => 'Изображение 3',
            'image_28_1' => 'Изображение 1',
            'image_28_2' => 'Изображение 2',
            'image_28_3' => 'Изображение 3',
            'image_29_1' => 'Изображение 1',
            'image_29_2' => 'Изображение 2',
            'image_29_3' => 'Изображение 3',
            'image_30_1' => 'Изображение 1',
            'image_30_2' => 'Изображение 2',
            'image_30_3' => 'Изображение 3',
        ];
    }

    public function imageName($param)
    {
        if ($this->$param && $this->validate()) {
            // if(empty($this->image_name)) {
            //     $this->image_name = CustomHelper::transliterator($this->$param->baseName). '.' .CustomHelper::transliterator($this->$param->extension);
            // }
            // $file_name = $this->image_name;
            
            $file_name = CustomHelper::transliterator($this->$param->baseName). '.' .CustomHelper::transliterator($this->$param->extension);
            return $file_name;
        }else{
            return false;
        }
    }
    
    public function upload($dir, $id, $modelParam, $formParam = null)
    {
        if (empty($formParam)) {
            $formParam = $modelParam;
        }
        if ($modelParam && $this->$formParam && $this->validate()) {
            FileHelper::createDirectory('upload/custom/' . $dir . '/' . $id . '/' . $modelParam);
            $file_name = $this->imageName($formParam);
            $this->$formParam->saveAs('upload/custom/' . $dir . '/' . $id . '/' . $modelParam . '/' . $file_name);
            return $file_name;
        } else {
            return false;
        }
    }
}


 ?>