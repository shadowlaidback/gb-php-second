<?php
namespace fadeev\php2\controllers;
use fadeev\php2\models\Order;
use fadeev\php2\models\repositories\OrderRepository;
use fadeev\php2\models\Basket;
use fadeev\php2\models\repositories\BasketRepository;
use fadeev\php2\models\User;
use fadeev\php2\models\repositories\UserRepository;
use fadeev\php2\services\Sessions;

class OrderController extends Controller
{
  public function actionIndex()
  {
    $user_id = (new Sessions)->Get("user_id");
    if (!empty($user_id)) {
      $order = (new Order)->OrderPrepare($user_id);
    } else {
      header("Location: /auth/?".http_build_query(array("back_url" => "/order/")));
    }

    echo $this->render("order", ["order" => $order]);
  }
}
?>