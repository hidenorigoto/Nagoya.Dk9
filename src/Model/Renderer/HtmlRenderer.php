<?php
namespace Nagoya\Dk9\Model\Renderer;

use Nagoya\Dk9\Model\Node;
use Nagoya\Dk9\Model\NodeRenderer;

class HtmlRenderer extends NodeRenderer
{
    /**
     * @inheritdoc
     */
    protected function formatCollection($content)
    {
        return sprintf('<ul>%s</ul>', $content);
    }

    /**
     * @inheritdoc
     */
    protected function formatNode(Node $node, $childContent, $depth)
    {
        return sprintf('<li>%s%s</li>' . PHP_EOL, $node->name, $childContent);
    }
}
