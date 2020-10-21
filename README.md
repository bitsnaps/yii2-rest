<p align="center">
    <h1 align="center">Yii 2 Basic REST API</h1>
</p>


1- Create a REST controller:
----------------------------

```
class PostController extends yii\rest\ActiveController
{

  public $modelClass = Post::class;

}
```

2- Configure the request component:
-------------------------------------------------

```
'components' => [
    'request' => [
        //...
        // Tell Yii2 to parse json request
        'parsers' => [
          'application/json' => yii\web\JsonParser::class
        ]
    ],
```

3- Setup and endpoint & configure routes:
-----------------------------------------

```
'urlManager' => [
    'enablePrettyUrl' => true,
    // 'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
      ['class' => yii\rest\UrlRule::class, 'controller' => 'post', /* Optional */ 'pluralize' => false],
    ],
],
```

You should now be able to query the server:

Fetch all posts:
```
curl -X GET http://localhost/web/post
```

Create a post:  
```
curl -X POST \
  http://localhost/web/post \
  -H 'accept: application/json' \
  -H 'content-type: application/json' \
  -d '{
	"title":"Post 01",
	"body":"Create the PostController by extending ActiveController class"
}'
```
Delete a post:
```
curl -X DELETE 'http://localhostweb/post/delete?id=4'
```

More info and customization can be found here:
https://www.yiiframework.com/doc/guide/2.0/en/rest-quick-start
