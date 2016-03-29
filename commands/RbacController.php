<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 14.03.2016
 * Time: 14:25
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\components\rbac\GroupRule;
use yii\rbac\PhpManager;

/**
 * RBAC console controller.
 */
class RbacController extends Controller
{
    /**
     * Initial RBAC action
     * @param integer $id Superadmin ID
     */
    public function actionInit($id = null)
    {
        $auth = new PhpManager;
        $auth->init();

        $auth->removeAll(); //удаляем старые данные
        // Rules
        $groupRule = new GroupRule();

        $auth->add($groupRule);

        // Roles
        $user = $auth->createRole('user');
        $user->description = 'User';
        $user->ruleName = $groupRule->name;
        $auth->add($user);

        $moderator = $auth->createRole('moderator');
        $moderator ->description = 'Moderator';
        $moderator ->ruleName = $groupRule->name;
        $auth->add($moderator);
        $auth->addChild($moderator, $user);

        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $admin->ruleName = $groupRule->name;
        $auth->add($admin);
        $auth->addChild($admin, $moderator);

       // $auth->assign($admin, 1);

    }
}