<?php
namespace Nagoya\Dk9\Model\Renderer;

use Nagoya\Dk9\Model\Node;
use Nagoya\Dk9\Model\NodeRenderer;

class CliRenderer extends NodeRenderer
{
    /**
     * @inheritdoc
     */
    protected function formatCollection($content)
    {
        return $content;
    }

    /**
     * @inheritdoc
     */
    protected function formatNode(Node $node, $childContent, $depth)
    {
        return sprintf('%s* %s' . PHP_EOL . '%s', str_repeat('  ', $depth), $node->name, $childContent);
    }
}
