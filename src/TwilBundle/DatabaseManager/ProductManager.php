<?php

namespace TwilBundle\DatabaseManager;

use Doctrine\ORM\EntityManager;
use TwilBundle\Entity\Product;

/**
 * Gére les interactions des produits avec la base de donnée
 */
class ProductManager
{
    protected $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function add(Product $product) 
    {
    }
    
    public function getAll() 
    {
    }
    
    public function get($id) 
    {
    }
}
