<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/properties", name="property.index")
     */
    public function index()
    {
        $properties = $this->repository->findAll();
        
        return $this->render('property/index.html.twig', [
            'controller_name' => 'PropertyController',
            'current_menu' => 'properties',
            'properties' => $properties
        ]);
    }
}
