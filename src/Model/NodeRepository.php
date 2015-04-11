<?php
namespace Nagoya\Dk9\Model;

class NodeRepository
{
    /**
     * @var Node[]
     */
    public $nodes = [];

    /**
     * @param Node $node
     */
    public function add(Node $node)
    {
        $this->nodes[$node->id] = $node;
    }

    /**
     * @param $id
     * @return Node|null
     */
    public function findOneById($id)
    {
        if (!array_key_exists($id, $this->nodes)) return null;

        return $this->nodes[$id];
    }

    /**
     * @return Node[]
     */
    public function findAll()
    {
        return $this->nodes;
    }
}
