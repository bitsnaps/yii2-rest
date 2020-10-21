<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Post;

/**
* set `authenticator` if you want to implement an authentication methods (HTTP Basic, OAuth2...)
*/
class PostController extends ActiveController
{

  public $modelClass = Post::class;

}
