<?php
namespace Nagoya\Dk9\Model;

class Node
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $parentId;

    /**
     * @var NodeCollection
     */
    public $children;

    public function __construct($id, $name, $parentId)
    {
        $this->children = new NodeCollection();

        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
    }

    /**
     * @param Node $node
     */
    public function addChildNode(Node $node)
    {
        $this->children->addNode($node);
    }
}
