<div class="col-md-12">
    <div class="cms-default-index">
        <h1><?= $this->context->action->uniqueId ?></h1>
        <p>
            <? if(\Yii::$app->user->can('admin')){
                //представление с формой для создания пользователей
                echo '<br>Admin<br>';
            }else{
                //представление показывающее пользователю ошибку
                echo '<br>not Admin<br>';
                if(\Yii::$app->user->can('moderator'))
                {
                    echo '<br>Moderator<br>';
                }
                else
                {
                    echo '<br>not Moderator<br>';
                    if(\Yii::$app->user->can('user'))
                    {
                        echo '<br>User<br>';
                    }
                    else
                    {
                        echo '<br>not User<br>';
                    }
                }

            }?>
        </p>
        <p>
            This is the view content for action "<?= $this->context->action->id ?>".
            The action belongs to the controller "<?= get_class($this->context) ?>"
            in the "<?= $this->context->module->id ?>" module.
        </p>
        <p>
            You may customize this page by editing the following file:<br>
            <code><?= __FILE__ ?></code>
        </p>
    </div>
</div>