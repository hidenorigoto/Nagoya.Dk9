<?php
namespace Nagoya\Dk9\Model;

abstract class NodeRenderer
{
    /**
     * @param Node $node
     * @param null $depth
     * @return mixed
     */
    abstract public function render(Node $node, $depth = null);
}
