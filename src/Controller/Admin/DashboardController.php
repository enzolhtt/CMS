<?php
 
namespace App\Controller\Admin;
 
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\Galerie;
use App\Entity\Image;
use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 
#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
#[Route('/admin', name: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator) {}
 
    public function index(): Response
    {
        $user = $this->getUser(); // Récupérer l'utilisateur connecté

        if ($user->getRoles() != "ROLE_USER"){
            return $this->redirectToRoute("user");
        }
        // Redirection automatique vers la liste des utilisateurs
        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();
 
        return $this->redirect($url);
    }
 
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CMS');
    }
 
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Pages', 'fa fa-folder-open', Page::class);
        yield MenuItem::linkToCrud('Articles', 'fa fa-book', Article::class);
        yield MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Commentaire::class);
        yield MenuItem::linkToCrud('Galeries', 'fa fa-briefcase', Galerie::class);
        yield MenuItem::linkToCrud('Images', 'fa fa-photo', Image::class);
    }
}