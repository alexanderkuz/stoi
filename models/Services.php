<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "services".
 *
 * @property integer $id
 * @property string $type
 * @property integer $parent_id
 * @property string $active
 * @property string $code
 * @property string $name
 * @property integer $sort
 * @property string $created_date
 * @property string $updated_date
 * @property string $picture
 * @property string $path_picture
 * @property string $preview_text
 * @property string $detail_text
 * @property string $title
 * @property string $keywords
 * @property string $description
 */
class Services extends \yii\db\ActiveRecord
{
    const ACTIVE = 'Yes';
    const INACTIVE = 'No';

    const TYPE_CATALOG = 'catalog';
    const TYPE_ITEM = 'item';

    const SIZE_VARCHAR=255;
    const SIZE_TEXT=65535;

    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['name', 'required'], //'created_date', 'updated_date'
            ['name', 'string', 'max' => self::SIZE_VARCHAR],
            [['created_date'], 'safe'],

            [['picture', 'path_picture'], 'string', 'max' => self::SIZE_VARCHAR],

            [['title', 'keywords', 'description'], 'string', 'max' => self::SIZE_VARCHAR],

            ['code', 'required'],
            ['code', 'string', 'max' => self::SIZE_VARCHAR],
            ['code', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app','This code has already been taken.')],

            ['parent_id', 'integer'],
            ['parent_id', 'default', 'value' => 0],

            ['sort', 'integer','max'=>4294967295],
            ['sort', 'default', 'value' => 500],

            ['active', 'string'],
            ['active', 'default', 'value' => self::INACTIVE],
            ['active', 'in', 'range' => array_keys(self::getActivesArray())],

            ['type', 'string'],
            ['type', 'default', 'value' => self::TYPE_CATALOG],
            ['type', 'in', 'range' => array_keys(self::getTypesArray())],

            [[ 'preview_text', 'detail_text'], 'string', 'max' => self::SIZE_TEXT],


           // [['imageFile'], 'file', 'extensions' => 'png, jpg, gif'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg, gif'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'active' => Yii::t('app', 'Status'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'sort' => Yii::t('app', 'Sort'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'picture' => Yii::t('app', 'Picture'),
            'imageFile'=> Yii::t('app', 'Picture'),
            'path_picture' => Yii::t('app', 'Path Picture'),
            'preview_text' => Yii::t('app', 'Preview Text'),
            'detail_text' => Yii::t('app', 'Detail Text'),
            'title' => Yii::t('app', 'Title'),
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @inheritdoc
     * @return ServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServicesQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_date',
                'updatedAtAttribute' => 'updated_date',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    public function getActiveName()
    {
        return ArrayHelper::getValue(self::getActivesArray(), $this->active);
    }

    public static function getActivesArray()
    {
        return [
            self::INACTIVE => Yii::t('app','Inactive'),//waiting for confirmation //Ожидает подтверждения
            self::ACTIVE => Yii::t('app','Active'),//Active //Активен

        ];
    }
    public static function getTypesArray()
    {
        return [
            self::TYPE_CATALOG => Yii::t('app','Catalog'),//waiting for confirmation //Ожидает подтверждения
            self::TYPE_ITEM => Yii::t('app','Item'),//Active //Активен

        ];
    }

    public function getTypeName()
    {
        return ArrayHelper::getValue(self::getTypesArray(), $this->type);
    }

    public static function getParentsList($id)
    {
        // Выбираем только те категории, у которых есть дочерние категории
    /*    $parents = self::find()
            //->parent_id($id)
            ->select(['c.id', 'c.name'])

          //  ->where(['c.parent_id'=>$id])
            ->distinct(true)
            ->all();*/
        $parents = self::find()
            //->parent_id($id)
            ->select(['c.id', 'c.name'])
            //->orWhere(['parent_id'=>$id,'type'=>self::TYPE_CATALOG])
            ->where(['c.type'=>self::TYPE_CATALOG])
            ->join('JOIN', 'services c', '(services.id = c.id) and (services.id='.$id.')')
            ->orderBy('c.sort')
            ->all();

        return ArrayHelper::map($parents, 'id', 'name');
    }

    public static function getParentsListAll($id,$array=[],$num=0,$str=' - ')
    {
        $tire=' - ';
        $count=1;
        $str1=$str;
        if ($id!==null)
        {
            $model = self::find()
                ->select(['id', 'name'])
                ->where(['type'=>self::TYPE_CATALOG,'parent_id'=>$num])
                ->andWhere('id<>:id',[':id'=>$id])
                ->orderBy('sort asc')
                ->all();
            foreach ($model as $val)
            {
                $array[$val->id]=$str.$val->name;
                $str1=$str.$tire;
                $array=self::getParentsListAll($id,$array,$val->id,$str1);

            }
        }
        else
        {
            $model = self::find()
                ->select(['id', 'name'])
                ->where(['type'=>self::TYPE_CATALOG,'parent_id'=>$num])

                ->orderBy('sort asc')
                ->all();
            foreach ($model as $val)
            {
                $array[$val->id]=$str.$val->name;
                $str1=$str.$tire;
                $array=self::getParentsListAll($id,$array,$val->id,$str1);

            }
        }


        return $array;//ArrayHelper::map($parents,'id', 'name');
    }

    public static function getParentID($id)
    {
        return self::find()->select(['parent_id'])->where(['id'=>$id])->one();
    }

    public static function getCountItem($id)
    {
        return self::find()->where(['parent_id'=>$id])->count();
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    public function getParentName()
    {
        $parent = $this->parent;

        return $parent ? $parent->name : Yii::t('app','Root');
    }

    public static function getListMenu($parent_id=0)
    {
        $array=[];
        $model=self::find()->select(['id','parent_id','name'])->where(['type'=>self::TYPE_CATALOG,'parent_id'=>$parent_id])->orderBy('sort asc')->all();
        foreach ($model as $val)
        {
            $array[]=
                [
                    'label'=>$val->name,
                    'url'=>['/cms/services/index','id'=>$val->id],
                    'items'=>self::getListMenu($val->id)
                ];
        }
        return $array;
    }

    //breadcrumb
    public static function getListBreadcrumb($id,$array)
    {
        //['label' => $this->title , 'url' => ['index']];
        if ($id!=0)
        {
            $model=self::find()->select(['id','parent_id','name'])->where(['id'=>$id])->one();
            if ($model!==null)
            {
                $array=self::getListBreadcrumb($model->parent_id,$array);
                $array[]=
                    [
                        'label'=>$model->name,
                        'url'=>['index','id'=>$model->id],
                    ];
            }
        }
        return $array;
    }
}
