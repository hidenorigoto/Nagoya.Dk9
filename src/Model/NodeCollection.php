<?php
namespace Nagoya\Dk9\Model;

class NodeCollection
{
    /**
     * @var Node[]
     */
    public $nodes = [];

    public function addNode(Node $node)
    {
        $this->nodes[] = $node;
    }
    }
