<?php declare(strict_types=1);

namespace App\Controller;

use App\Security\AppCustomAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class SuperAdminController extends AbstractController
{
    #[Route('/super/admin', name: 'app_super_admin')]
    #[IsGranted(AppCustomAuthenticator::ROLE_SUPER_ADMIN)]
    public function index(): Response
    {
        return $this->render('superAdmin/index.html.twig');
    }
}
