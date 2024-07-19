<?php

use yii\db\Migration;

/**
 * Class m240719_054851_init_rbac
 */
class m240719_054851_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "createRap" permission
        $createRap = $auth->createPermission('createRap');
        $createRap->description = 'Create a remedial action plan';
        $auth->add($createRap);

        // add "updateRap" permission
        $updateRap = $auth->createPermission('updateRap');
        $updateRap->description = 'Update a remedial action plan';
        $auth->add($updateRap);

        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        // add "supervision officer" role and give this role the "createRap" permission
        $supervisionofficer = $auth->createRole('supervisionofficer');
        $auth->add($supervisionofficer);
        $auth->addChild($supervisionofficer, $createRap);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $updateRap);
        $auth->addChild($admin, $supervisionofficer);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($supervisionofficer, 3);
        $auth->assign($author, 2);
        $auth->assign($admin, 1);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240719_054851_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
