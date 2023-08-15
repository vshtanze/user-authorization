<?php declare(strict_types=1);

namespace App\Controller;

use App\Security\AppCustomAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    #[IsGranted(AppCustomAuthenticator::ROLE_ADMIN)]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
