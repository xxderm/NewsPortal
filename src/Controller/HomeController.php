<?
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Entities;
use Doctrine\ORM\EntityManagerInterface;
class HomeController extends AbstractController
{
    /**
     * @Route("/home/")
     */
    public function index()
    {
        return $this->render(
            'home/home.html.twig',
            [
                'title' => 'Home',
            ]
        );
    }
    public function getNavContent()
    {
        $NavContentArray = [];
        foreach($this->getDoctrine()
                    ->getRepository(Entities::class)
                    ->findAll() as $value)
            $NavContentArray[] = $value->getName();
        return $NavContentArray;
    }
}