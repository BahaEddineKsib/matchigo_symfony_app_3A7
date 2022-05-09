<?php

namespace App\Controller;

use App\Entity\PlanPlace;
use App\Controller\PlanController;
use App\Form\PlanPlaceType;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlanPlaceController extends AbstractController
{
    /**
     * @Route("/planplace/", name="app_plan_place_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $planPlaces = $entityManager
            ->getRepository(PlanPlace::class)
            ->findAll();

        return $this->render('plan_place/index.html.twig', [
            'plan_places' => $planPlaces,
        ]);
    }

    /**
     * @Route("/newPLANPLACE", name="app_plan_place_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, FlashyNotifier $flashy): Response
    {
        $flashy->info("PLACE");
        $planPlace = new PlanPlace();
        $form = $this->createForm(PlanPlaceType::class, $planPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flashy->info("NEW PLACE");
            $entityManager->persist($planPlace);
            $entityManager->flush();


            return $this->redirectToRoute('app_plan_show', ['id' => $planPlace->getIdplan()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plan_place/new.html.twig', [
            'plan_place' => $planPlace,
            'planPlaceForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/planplace/{ref}", name="app_plan_place_show", methods={"GET"})
     */
    public function show(PlanPlace $planPlace): Response
    {
        return $this->render('plan_place/show.html.twig', [
            'plan_place' => $planPlace,
        ]);
    }

    /**
     * @Route("/planplace/{ref}/edit", name="app_plan_place_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PlanPlace $planPlace, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlanPlaceType::class, $planPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plan_place_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plan_place/edit.html.twig', [
            'plan_place' => $planPlace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/planplace/delete/{ref}", name="app_plan_place_delete", methods={"POST"})
     */
    public function delete(Request $request, PlanPlace $planPlace, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planPlace->getRef(), $request->request->get('_token'))) {
            $entityManager->remove($planPlace);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plan_show', ['id' => $planPlace->getIdplan()->getId()], Response::HTTP_SEE_OTHER);
    }
}
