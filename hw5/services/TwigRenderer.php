<?php
namespace fadeev\php2\services;
use fadeev\php2\interfaces\IRenderer;

class TwigRenderer implements IRenderer
{
  public function Render($template, $arParams = array())
  {
    $templatePath = $template.".php";
    $loader = new \Twig_Loader_Filesystem(TEMPLATES_DIR);
    $twig = new \Twig_Environment($loader);
    return $twig->render($templatePath, $arParams);
  }
}