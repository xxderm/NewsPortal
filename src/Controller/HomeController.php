<?
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class HomeController extends AbstractController
{
    /**
     * @Route("/home/")
     */
    public function index()
    {
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