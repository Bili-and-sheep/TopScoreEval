<?php

namespace App\Controller;

use App\Entity\StreamOfTMWR;
use App\Form\StreamOfTMWRType;
use App\Repository\StreamOfTMWRRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/stream/of/t/m/w/r')]
class StreamOfTMWRController extends AbstractController
{
    #[Route('/', name: 'app_stream_of_t_m_w_r_index', methods: ['GET'])]
    public function index(StreamOfTMWRRepository $streamOfTMWRRepository): Response
    {
        return $this->render('stream_of_tmwr/index.html.twig', [
            'stream_of_t_m_w_rs' => $streamOfTMWRRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_stream_of_t_m_w_r_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $streamOfTMWR = new StreamOfTMWR();
        $form = $this->createForm(StreamOfTMWRType::class, $streamOfTMWR);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($streamOfTMWR);
            $entityManager->flush();

            return $this->redirectToRoute('app_stream_of_t_m_w_r_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('stream_of_tmwr/new.html.twig', [
            'stream_of_t_m_w_r' => $streamOfTMWR,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stream_of_t_m_w_r_show', methods: ['GET'])]
    public function show(StreamOfTMWR $streamOfTMWR): Response
    {
        return $this->render('stream_of_tmwr/show.html.twig', [
            'stream_of_t_m_w_r' => $streamOfTMWR,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_stream_of_t_m_w_r_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StreamOfTMWR $streamOfTMWR, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StreamOfTMWRType::class, $streamOfTMWR);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_stream_of_t_m_w_r_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('stream_of_tmwr/edit.html.twig', [
            'stream_of_t_m_w_r' => $streamOfTMWR,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_stream_of_t_m_w_r_delete', methods: ['POST'])]
    public function delete(Request $request, StreamOfTMWR $streamOfTMWR, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$streamOfTMWR->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($streamOfTMWR);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_stream_of_t_m_w_r_index', [], Response::HTTP_SEE_OTHER);
    }
}
