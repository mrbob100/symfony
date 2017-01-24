<?php
namespace VL\SiteBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use VL\SiteBundle\Repository\CategoryRepository;
class Searcher
{
    private $repository;

    public function __construct(CategoryRepository $category)
    {
        $this->repository=$category;
    }


    public function searchCategory( $slug, $post)
    {
        return $this->repository->searchCategory($slug, $post);
    }
}
