<?php


namespace  App\Controller ;


use App\Entity\Invoice;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;

Class FactureController {


    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Invoice $data
     * @Route("/api/factuers/{id}/increment")
     */
    public function __invoke(Invoice  $data){

        $data->setChrono($data->getChrono()+1);
        $this->manager->flush();

       return $data;

    }







}