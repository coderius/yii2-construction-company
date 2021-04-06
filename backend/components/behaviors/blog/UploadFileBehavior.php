<?php
//UploadFileBehavior

namespace backend\components\behaviors\blog;

use Closure;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box; 
use yii\imagine\Gd;
use Imagine\Image\Point;
use yii\helpers\FileHelper;
use yii\helpers\ArrayHelper;
use yii\base\DynamicModel;
use yii\web\Response;
use backend\models\blog\BlogArticles;
use yii\base\InvalidCallException;


// 'uploadFileBehavior' => [
//     'class' => UploadFileBehavior::className(),
//     'directories' => [
//         'small' => [
//             'alias' => '',
//             'hendler' => ''
//         ],
//         'middle' => [
//             'alias' => '',
//             'hendler' => ''
//         ],
//         'big' => [
//             'alias' => '',
//             'hendler' => ''
//         ],
//     ]
// ],

class UploadFileBehavior extends Behavior
{
    /**
     * Name of attribute for recording file from form to ActiveRecord. DEfault name of attribute is `file`
     *
     * @var [string]
     */
    public $nameOfAttributeFile = 'file';

    /**
     * Undocumented variable
     *
     * @var string
     */
    public $nameOfAttributeStorage = 'face_img';
    
    /**
     * Image name for renaming file and in next saving in file system and db
     *
     * @var [string]
     */
    public $newFileName;

    /**
     * Undocumented variable
     *
     * @var [array]
     */
    public $directories;

    /**
     * File instance populated by yii\web\UploadedFile::getInstance
     *
     * @var null|UploadedFile the instance of the uploaded file.
     */
    private $fileInstance;

    private $time = false;

    /**
     * {@inheritdoc}
     */
    public function attach($owner)
    {
        parent::attach($owner);
        $this->time = time();
        $this->setFileInstance();
        
    }

     /**
     * {@inheritdoc}
     */
    public function events()
    {
        return [
            // BlogArticles::EVENT_BEFORE_VALIDATE => 'afterLoadHendler',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'afterLoadHendler',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsertHendler',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdateHendler',
        ];
    }

    public function afterLoadHendler($event)
    {
        if($this->isFile()){
            $this->owner->file = $this->getFileInstance();//virtual attribute
            $this->owner->{$this->nameOfAttributeStorage} = $this->getNewFileName();
        }
    }
    

    public function afterInsertHendler($event)
    {
        $this->hendlersReducer(true);
    }
    
    /**
     * Undocumented function
     *
     * @param [type] $event
     * @return void
     */
    public function afterUpdateHendler($event)
    {
        $this->hendlersReducer(false);
    }


    /**
     * Undocumented function
     *
     * @param [type] $insert
     * @return void
     */
    protected function hendlersReducer($insert)
    {
        if ($this->isFile())
        {
            foreach($this->directories as $dir){
                if ($dir['path'] instanceof Closure || (is_array($dir['path']) && is_callable($dir['path']))) {
                    $dirPath = $dir['path']($this->owner->attributes);
                }else{
                    throw new InvalidCallException('Param `path` mast be instanceof Closure or callable method.');
                }
                
                if(!$insert){
                    FileHelper::removeDirectory($dirPath);
                }
                
                FileHelper::createDirectory($dirPath);
                $newFilePath = $dirPath . $this->getNewFileName();

                if ($dir['hendler'] instanceof Closure || (is_array($dir['hendler']) && is_callable($dir['hendler']))) {
                    $dir['hendler']($this->getFileInstance()->tempName, $newFilePath);
                }else{
                    throw new InvalidCallException('Param `hendler` mast be instanceof Closure or callable method.');
                }
            }
        }
    }

    /**
     * Get the instance of the uploaded file.
     *
     * @return  null|UploadedFile
     */
    protected function getFileInstance()
    {
        return $this->fileInstance;
    }

    /**
     * Set the instance of the uploaded file.
     *
     * @param  null|UploadedFile  $fileInstance  the instance of the uploaded file.
     *
     * @return  self
     */ 
    protected function setFileInstance()
    {
        $this->fileInstance = UploadedFile::getInstance($this->owner, $this->nameOfAttributeFile);
    }

    /**
     * Get image name for renaming file and in next saving in file system and db
     *
     * @return  [string]
     */ 
    protected function getNewFileName()
    {
        $file = $this->getFileInstance();
        $baseName = $file->baseName;
        $ext = $file->extension;
        
         return $this->newFileName ?
            $this->newFileName . '.' . $file->extension :
            $file->baseName . '_' . $this->time . '.' . $file->extension;
    }

    protected function isFile()
    {
        return  $this->getFileInstance() && $this->getFileInstance()->tempName;
        
    }

}