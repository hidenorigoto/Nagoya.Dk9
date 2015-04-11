<?php
namespace Nagoya\Dk9;

use Nagoya\Dk9\Model\Node;
use Nagoya\Dk9\Model\NodeRenderer;
use Nagoya\Dk9\Model\NodeRepository;
use Nagoya\Dk9\Model\RootNode;

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
        $rootNode = $this->initRootNode();
        $this->parseData($data);
        $this->buildTree($rootNode);

        return $this->renderer->render($rootNode, 0);
    }

    /**
     * ルートノード初期化
     * @return RootNode
     */
    private function initRootNode()
    {
        $rootNode = new RootNode(0, '', null);
        $this->repository->add($rootNode);

        return $rootNode;
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
     */
    private function buildTree()
    {
        foreach ($this->repository->findAll() as $node)
        {
            $parent = $this->repository->findOneById($node->parentId);
            if ($parent) {
                $parent->addChildNode($node);
            }
        }
    }
}
