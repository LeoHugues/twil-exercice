<?php

namespace TwilBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TwilBundle\Entity\Product;
use TwilBundle\Type\ProductType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('TwilBundle:default:index.html.twig');
    }
    
        
    /**
     * @Route("/product", name="list_product")
     */
    public function listProductAction(Request $request)
    {
        $manager = $this->get("product.manager");
        $products = $manager->getAll();
        
        return $this->render('TwilBundle:product:list.html.twig', ["products" => $products]);
    }
    
    /**
     * @Route("/product/edit", name="create_product")
     */
    public function createProductAction(Request $request)
    {
        $product = new Product();
        
        return $this->handleProductChangeAndGetResponse($request, $product, $this->generateUrl('create_product'));
    }
    
    /**
     * @Route("/product/update/{id}", name="update_product")
     */
    public function updateProductAction(Request $request, $id)
    {
        $manager = $this->get("product.manager");
        $product = $manager->get($id);
        return $this->handleProductChangeAndGetResponse(
                $request,
                $product, 
                $this->generateUrl('update_product', array('id' => $product->getId()))
         );
    }
    
    protected function handleProductChangeAndGetResponse(Request $request, Product $product, $action) {
        $form = $this->createForm(
                new ProductType(), 
                $product, 
                ["action" => $action]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->get("product.manager");
            $manager->add($product);
            
            return $this->redirectToRoute('list_product');
        }

        return $this->render('TwilBundle:product:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
     /**
     * @Route("/product/{id}", name="show_product")
     */
    public function showAction($id)
    {
        $manager = $this->get("product.manager");
        $product = $manager->get($id);
        
        return $this->render('TwilBundle:product:show.html.twig', ["product" => $product]);
    }
}
