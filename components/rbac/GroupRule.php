<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 14.03.2016
 * Time: 14:20
 */

namespace app\components\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * User group rule class.
 */
class GroupRule extends Rule
{
    /**
     * @inheritdoc
     */
    public $name = 'group';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;

            if ($item->name === 'admin') {
                return $role === $item->name;
            } elseif ($item->name === 'moderator') {
                return $role === $item->name ||  $role === 'admin';
            } elseif ($item->name === 'user') {
                return $role === $item->name ||  $role === 'admin' || $role === 'moderator';
            }
        }
        return false;
    }
}