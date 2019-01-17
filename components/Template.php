<?php

namespace components;

use Exception;

/**
 * Class Template
 * @package components
 */
class Template
{
  /**
   * @var string
   */
  private $templatesDir;

  /**
   * Template constructor.
   * @param string $templatesDir
   */
  public function __construct(string $templatesDir)
  {
    $this->templatesDir = $templatesDir;
  }

  public function render(
    string $template,
    array $variables = [],
    string $layout = 'layouts/main'
  ) {
    extract($variables);

    $template = $this->getTemplateFile($template);
    ob_start();
    require_once $template;
    $content = ob_get_clean();

    $layout = $this->getTemplateFile($layout);
    require_once $layout;
  }

  /**
   * @param string $template
   * @return string
   * @throws Exception
   */
  private function getTemplateFile(string $template): string
  {
    $rout = "{$this->templatesDir}/{$template}.php";
    if (!file_exists($rout)) {
      throw new Exception("Template '{$template}' is not exists");
    }

    return $rout;
  }
}
