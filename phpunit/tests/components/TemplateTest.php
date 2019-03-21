<?php

namespace phpunit\tests\components;

use Exception;
use PHPUnit\Framework\TestCase;
use components\Template;

/**
 * Class TemplateTest
 * @package phpunit\tests\components
 */
class TemplateTest extends TestCase
{
    /**
     * @var string
     */
    private $templatesDir = __DIR__ . '/../../views';

    /**
     * @var Template
     */
    private $template;

    public function setUp()
    {
        $this->template = new Template($this->templatesDir);
    }

    public function testRender()
    {
        ob_start();
        $this->template->render('template');
        $renderResult = ob_get_clean();
        $this->assertEquals($this->getExpectedHTML(), $renderResult);

        $this->expectException(Exception::class);
        $this->template->render('not-existed.file');
    }

    /**
     * @return string
     */
    private function getExpectedHTML(): string
    {
        ob_start();
        require "{$this->templatesDir}/template.php";
        $content = ob_get_clean();

        ob_start();
        require "{$this->templatesDir}/layouts/main.php";
        return ob_get_clean();
    }
}
