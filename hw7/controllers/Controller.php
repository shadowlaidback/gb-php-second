<?php
namespace fadeev\php2\controllers;
use fadeev\php2\interfaces\IRenderer;
use fadeev\php2\services\TemplateRenderer;
use fadeev\php2\services\TwigRenderer;

abstract class Controller
{
  private $action;
  private $defaultAction = 'index';
  private $layout = 'main';
  private $useLayout = true;
  private $renderer;

  /**
   * Controller constructor
   * @param $renderer
   */
  public function __construct(IRenderer $renderer)
  {
      $this->renderer = $renderer;
  }

  public function runAction($action = null)
  {
    $this->action = $action ?: $this->defaultAction;
    $method = "action".ucfirst($this->action);
    if(method_exists($this, $method)){
      $this->$method();
    } else {
      throw new \Exception("Action not found", 404);
    }
  }

  public function render($template, $arParams = array())
  {
    if($this->useLayout){
      return $this->renderTemplate(
        "layouts/{$this->layout}",
        array(
          "content" => $this->renderTemplate($template, $arParams)
        )
      );
    } else {
      return $this->renderTemplate($template, $arParams);
    }
  }

  public function renderTemplate($template, $arParams = array())
  {
    return $this->renderer->render($template, $arParams);
  }
}
?>