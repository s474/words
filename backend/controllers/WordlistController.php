<?php

namespace backend\controllers;

use Yii;
use common\models\Wordlist;
use common\models\WordlistSearch;
use common\models\WordlistWordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WordlistController implements the CRUD actions for Wordlist model.
 */
class WordlistController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Wordlist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WordlistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Wordlist model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $wordlistWordSearchModel = new WordlistWordSearch();
        $wordlistWordSearchModel->wordlist_id = $model->id;
        $wordlistWordDataProvider = $wordlistWordSearchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'wordlistWordSearchModel' => $wordlistWordSearchModel,
            'wordlistWordDataProvider' => $wordlistWordDataProvider,            
        ]);
    }

    /**
     * Creates a new Wordlist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wordlist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Wordlist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        $wordlistWordSearchModel = new WordlistWordSearch();
        $wordlistWordSearchModel->wordlist_id = $model->id;
        $wordlistWordDataProvider = $wordlistWordSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('update', [
            'model' => $model,
            'wordlistWordSearchModel' => $wordlistWordSearchModel,
            'wordlistWordDataProvider' => $wordlistWordDataProvider,            
        ]);
    }

    /**
     * Deletes an existing Wordlist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Wordlist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wordlist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wordlist::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
