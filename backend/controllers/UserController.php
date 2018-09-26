<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\components\AccessRule;
use frontend\models\SignupForm;
use yii\filters\AccessControl;
use yii\base\Security;
use yii\data\ActiveDataProvider;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['editprofile', 'index', 'view', 'update'],
                'rules' => [
                    [
                        'actions' => ['editprofile', 'index', 'view', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->email);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        return $this->redirect(['editprofile']);
    }
    
    public function actionChangestatususer($id, $status) {
        $model = $this->findModel($id);
        $model->status = $status;
        if ($model->save()) {
            // return $this->redirect(['view', 'id' => $model->cid]);
            Yii::$app->getSession()->setFlash('success', 'Status changed successfully');
            return $this->redirect(['agent']);
        } else {
            // return $this->redirect(['view', 'id' => $model->cid]);
            Yii::$app->getSession()->setFlash('error', 'Error!! Some error occured');
            return $this->redirect(['agent']);
        }
    }

   

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionEditprofile() {
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        $model->scenario = 'editprofile';
        $oldIcon = $model->profile_image;
        $oldpassword = $model->password_hash;

        if ($model->load(Yii::$app->request->post())) {
            $rnd = rand(0, 9999);
            if (!$model->validate()) {
                return $this->render('editprofile', [
                            'model' => $model,
                ]);
            }
            $model->status = 1;
            $imageName = $model->profile_image;
            $model->file = UploadedFile::getInstance($model, 'profile_image');
            if ($model->file != '') {
                    $fileName = "users/admin/{$rnd}-{$model->file}";
                    $model->profile_image = $fileName;
            } else {
                $model->profile_image = $oldIcon;
            }

            if ($model->file != '') {
                $model->password_hash = $oldpassword;
                $model->repassword = $oldpassword;
                if ($model->save()) {
                    $model->file->saveAs(Yii::getAlias('@frontend') . '/web/uploads/' . $model->profile_image);
                    if ($oldIcon != '' && file_exists(Yii::getAlias('@frontend') . '/web/uploads/' . $oldIcon)) {
                        $oldfile = Yii::getAlias('@frontend') . '/web/uploads/' . $oldIcon;
                        unlink($oldfile);
                    }
                    Yii::$app->getSession()->setFlash('success', 'Record updated successfully');
                    return $this->redirect(['editprofile']);
                }
            } else if ($_POST['User']['password_hash'] != 'password' && $model->file != '') {
                $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
                $model->repassword = $model->password_hash;
                if ($model->save()) {
                    $model->file->saveAs(Yii::getAlias('@frontend') . '/web/uploads/' . $model->profile_image);
                    if ($oldIcon != '' && file_exists(Yii::getAlias('@frontend') . '/web/uploads/' . $oldIcon)) {
                        $oldfile = Yii::getAlias('@frontend') . '/web/uploads/' . $oldIcon;
                        unlink($oldfile);
                    }
                    Yii::$app->getSession()->setFlash('success', 'Record updated successfully');
                    return $this->redirect(['editprofile']);
                }
            } else if ($_POST['User']['password_hash'] != 'password') {
                $model->password_hash = Yii::$app->security->generatePasswordHash($_POST['User']['password_hash']);
                $model->repassword = $model->password_hash;
                if ($model->validate()) {
                    $model->profile_image = $oldIcon;
                    if ($model->save(false)) {
                        Yii::$app->getSession()->setFlash('success', 'Record updated successfully');
                        return $this->redirect(['editprofile']);
                    }
                }
            } else {
                $model->password_hash = $oldpassword;
                $model->repassword = $oldpassword;
                $model->profile_image = $oldIcon;
                if ($model->save(false)) {
                    Yii::$app->getSession()->setFlash('success', 'Record updated successfully');
                    return $this->redirect(['editprofile']);
                }
            }
        }
        return $this->render('editprofile', [
                    'model' => $model,
        ]);
    }

}
