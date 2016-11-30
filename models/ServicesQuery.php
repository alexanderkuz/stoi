<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Services]].
 *
 * @see Services
 */
class ServicesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    public function parent_id($id)
    {
        return $this->andWhere(['parent_id' => $id]);
    }

    /**
     * @inheritdoc
     * @return Services[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Services|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}