<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservation')]
    public function reservation(ReservationRepository $reservationRepository): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $reservations = $reservationRepository->findBy([], ['id' => 'DESC']);

        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    //delete reservation
    #[Route('/reservation/delete/{id}', name: 'app_reservation_delete')]
    public function delete($id, EntityManagerInterface $em, ReservationRepository $reservationRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $reservation = $reservationRepository->find($id);
        $em->remove($reservation);
        $em->flush();

        return $this->redirectToRoute('app_reservation');
    }
}
