<?php
namespace Nagoya\Dk9\Model\Renderer;

use Nagoya\Dk9\Model\Node;
use Nagoya\Dk9\Model\NodeRenderer;
use Nagoya\Dk9\Model\RootNode;

class HtmlRenderer extends NodeRenderer
{
    /**
     * @param Node $node
     * @param null $depth
     * @return string
     */
    public function render(Node $node, $depth = null)
    {
        if ($node instanceof RootNode) {
            return $this->renderChildren($node, $depth);
        } else {
            $buf = '<li>' . $node->name . PHP_EOL;
            if ($childBuf = $this->renderChildren($node, $depth + 1)) {
                $buf .= $childBuf;
            }
            $buf .= '</li>' . PHP_EOL;

            return $buf;
        }
    }

    /**
     * @param $node
     * @param $depth
     * @return string
     */
    private function renderChildren($node, $depth)
    {
        $childBuf = array_reduce($node->children, function ($current, Node $node) use ($depth) {
            return $current . $this->render($node, $depth);
        }, '');

        if ($childBuf) {
            return '<ul>' . $childBuf . '</ul>' . PHP_EOL;
        }
    }
}
