<?php
namespace Nagoya\Dk9;

use Nagoya\Dk9\Model\Node;
use Nagoya\Dk9\Model\NodeCollection;
use Nagoya\Dk9\Model\NodeRenderer;
use Nagoya\Dk9\Model\NodeRepository;

class Dk9
{
    /**
     * @var NodeRepository
     */
    private $repository;

    /**
     * @var NodeRenderer
     */
    private $renderer;

    public function __construct(NodeRepository $repository, NodeRenderer $renderer)
    {
        $this->repository = $repository;
        $this->renderer = $renderer;
    }

    public function solve($data)
    {
        $rootNodeCollection = $this->initRootNodeCollection();
        $this->parseData($data);
        $this->buildTree($rootNodeCollection);

        return $this->renderer->renderCollection($rootNodeCollection, 0);
    }

    /**
     * ルートノードコレクション初期化
     * @return NodeCollection
     */
    private function initRootNodeCollection()
    {
        $rootNodeCollection = new NodeCollection();
        return $rootNodeCollection;
    }

    /**
     * データをパースする
     * @param $data
     */
    private function parseData($data)
    {
        foreach ($data as $element)
        {
            $node = new Node($element['id'], $element['value'], $element['parent_id']);
            $this->repository->add($node);
        }
    }

    /**
     * 木構造への整形
     * @param NodeCollection $rootNodeCollection
     */
    private function buildTree(NodeCollection $rootNodeCollection)
    {
        foreach ($this->repository->findAll() as $node)
        {
            $parent = $this->repository->findOneById($node->parentId);
            if ($parent) {
                $parent->addChildNode($node);
            } else {
                $rootNodeCollection->addNode($node);
            }
        }
    }
}
