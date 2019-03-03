<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/property", name="admin.property.index")
     */
    public function index()
    {
        $properties = $this->repository->findAll();
        
        return $this->render('admin_property/index.html.twig', [
            
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/admin/property/create", name="admin.property.create")
     */
    public function create(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $property->setCreatedAt(new \DateTime());
            $this->em->persist($property);
            $this->em->flush();

            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin_property/create.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]); 
    }

     /**
     * @Route("/admin/{id}/edit", name="admin.property.edit")
     */
    public function edit(Property $property, Request $request) 
    {
        
        $form = $this->createForm(PropertyType::class, $property);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();

            return $this->redirectToRoute('admin.property.index');
        }
        
        return $this->render('admin_property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/admin/{id}/delete", name="admin.property.delete")
     */
    public function delete(Property $property, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token')))
        {
            $this->em->remove($property);
            $this->em->flush();
            return $this->redirectToRoute('admin.property.index');
        }

    }

}
