<?php
namespace Nagoya\Dk9\Model\Renderer;

use Nagoya\Dk9\Model\Node;
use Nagoya\Dk9\Model\NodeRenderer;
use Nagoya\Dk9\Model\RootNode;

class CliRenderer extends NodeRenderer
{
    /**
     * @param Node $node
     * @param null $depth
     * @return mixed|string
     */
    public function render(Node $node, $depth = null)
    {
        if ($node instanceof RootNode) {
            return $this->renderChildren($node, $depth);
        } else {
            $buf = str_repeat('  ', $depth);
            $buf .= '* ' . $node->name . PHP_EOL;
            if ($childBuf = $this->renderChildren($node, $depth + 1)) {
                $buf .= $childBuf;
            }

            return $buf;
        }
    }

    /**
     * @param $node
     * @param $depth
     * @return mixed
     */
    private function renderChildren($node, $depth)
    {
        $childBuf = array_reduce($node->children, function ($current, Node $node) use ($depth) {
            return $current . $this->render($node, $depth);
        }, '');

        if ($childBuf) {
            return $childBuf;
        }
    }
}
