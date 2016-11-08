<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */


namespace JaySDe\HandlebarsBundle;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\TemplateNameParserInterface;

class HandlebarsEngine implements EngineInterface
{
    protected $engine;
    protected $parser;
    protected $environment;

    /**
     * Constructor.
     *
     * @param HandlebarsEnvironment       $handlebars   A HandlebarsEnvironment instance
     * @param TemplateNameParserInterface $parser       A TemplateNameParserInterface instance
     */
    public function __construct(HandlebarsEnvironment $handlebars, TemplateNameParserInterface $parser)
    {
        $this->environment = $handlebars;
        $this->parser = $parser;
    }

    public function render($name, array $parameters = array())
    {
        return $this->environment->render($name, $parameters);
    }

    public function exists($name)
    {
        $loader = $this->environment->getLoader();

        return $loader->exists((string) $name);
    }

    public function supports($name)
    {
        $template = $this->parser->parse($name);

        return in_array($template->get('engine'), ['hbs', 'handlebars']);
    }

    public function renderResponse($view, array $parameters = array(), Response $response = null)
    {
        if (null === $response) {
            $response = new Response();
        }

        $response->setContent($this->render($view, $parameters));

        return $response;
    }
}
