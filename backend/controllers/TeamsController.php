<?php

namespace backend\controllers;

use Yii;
use common\models\Teams;
use common\models\TeamsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TeamsController implements the CRUD actions for Teams model.
 */
class TeamsController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Teams models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TeamsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teams model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Teams model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Teams();
        $model->scenario = 'create';
        $rnd = rand(0, 9999);
        $uploadedFiles = '';
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->validate()) {
                Yii::$app->getSession()->setFlash('error', 'Validation failed');
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
            $model->team_created_at = date('Y-m-d H:i:s');
            $model->file = UploadedFile::getInstance($model, 'team_logo');
            if ($model->file != '') {
                $fileName = "teams/logo/{$rnd}-{$model->file}";
                $model->team_logo = $fileName;
                if ($model->save()) {
                    $model->file->saveAs(Yii::getAlias('@frontend') . '/web/uploads/' . $model->team_logo);
                    Yii::$app->getSession()->setFlash('success', 'Team created successfully');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            Yii::$app->getSession()->setFlash('error', 'Validation failed2');
        }


        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Teams model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        $oldIcon = $model->team_logo;
        if ($model->load(Yii::$app->request->post())) {
            $rnd = rand(0, 9999);
            if (!$model->validate()) {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
            $imageName = $model->team_logo;
            $model->file = UploadedFile::getInstance($model, 'team_logo');
            if ($model->file != '') {
                $fileName = "teams/logo/{$rnd}-{$model->file}";
                $model->team_logo = $fileName;
            } else {
                $model->team_logo = $oldIcon;
            }
            $model->team_updated_at = date('Y-m-d H:i:s');
            if ($model->file != '') {
                if ($model->save()) {
                    $model->file->saveAs(Yii::getAlias('@frontend') . '/web/uploads/' . $model->team_logo);
                    if ($oldIcon != '' && file_exists(Yii::getAlias('@frontend') . '/web/uploads/' . $oldIcon)) {
                        $oldfile = Yii::getAlias('@frontend') . '/web/uploads/' . $oldIcon;
                        unlink($oldfile);
                    }
                    Yii::$app->getSession()->setFlash('success', 'Record updated successfully');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->team_logo = $oldIcon;
                if ($model->save(false)) {
                    Yii::$app->getSession()->setFlash('success', 'Record updated successfully');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Teams model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $oldIcon = $model->team_logo;
        if ($oldIcon != '' && file_exists(Yii::getAlias('@frontend') . '/web/uploads/' . $oldIcon)) {
            $oldfile = Yii::getAlias('@frontend') . '/web/uploads/' . $oldIcon;
            unlink($oldfile);
        }
        $model->delete();
        Yii::$app->getSession()->setFlash('success', 'Record deleted successfully');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Teams model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teams the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Teams::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
