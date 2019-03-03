<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
    /**
     * @Route("/admin/property", name="admin_property")
     */
    public function index()
    {
        return $this->render('admin_property/index.html.twig', [
            'controller_name' => 'AdminPropertyController',
        ]);
    }
}
