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

        var_dump( $this->getDoctrine()->getRepository(Entities::class)->findAll());
        die();

        $number = random_int(0, 100);
        return $this->render(
            'home/home.html.twig',
            [
                'number' => $number,
                'title' => 'Home',
            ]
        );
    }
}