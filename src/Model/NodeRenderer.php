<?php
namespace Nagoya\Dk9\Model;

abstract class NodeRenderer
{
    /**
     * @param NodeCollection $collection
     * @param null $depth
     * @return string
     */
    public function renderCollection(NodeCollection $collection, $depth = null)
    {
        if (count($collection->nodes) === 0) return '';

        $content = array_reduce($collection->nodes, function ($current, Node $node) use ($depth) {
            return $current . $this->renderNode($node, $depth);
        }, '');

        return $this->formatCollection($content);
    }

    /**
     * @param Node $node
     * @param null $depth
     * @return mixed
     */
    public function renderNode(Node $node, $depth = null)
    {
        $childContent = $this->renderCollection($node->children, $depth + 1);
        return $this->formatNode($node, $childContent, $depth);
    }

    /**
     * @param $content
     * @return mixed
     */
    abstract protected function formatCollection($content);

    /**
     * @param Node $node
     * @param $childContent
     * @param $depth
     * @return mixed
     */
    abstract protected function formatNode(Node $node, $childContent, $depth);
}
