<?php

namespace App\Controller;

use App\Entity\NewsInformations;
use App\Form\NewsInformationsType;
use App\Repository\NewsInformationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// #[Route('/news/informations')]
#[Route('/news')]
class NewsInformationsController extends AbstractController
{
    #[Route('/', name: 'app_news_informations_index', methods: ['GET'])]
    public function index(NewsInformationsRepository $newsInformationsRepository): Response
    {
        return $this->render('news_informations/index.html.twig', [
            'news_informations' => $newsInformationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_news_informations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NewsInformationsRepository $newsInformationsRepository): Response
    {
        $newsInformation = new NewsInformations();
        $form = $this->createForm(NewsInformationsType::class, $newsInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsInformation->setcreatedAt(new \DateTime());
            $newsInformation->setUpdatedAt(new \DateTime());

            $newsInformationsRepository->add($newsInformation, true);

            return $this->redirectToRoute('app_news_informations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news_informations/new.html.twig', [
            'news_information' => $newsInformation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_informations_show', methods: ['GET'])]
    public function show(NewsInformations $newsInformation): Response
    {
        return $this->render('news_informations/show.html.twig', [
            'news_information' => $newsInformation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_news_informations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NewsInformations $newsInformation, NewsInformationsRepository $newsInformationsRepository): Response
    {
        $form = $this->createForm(NewsInformationsType::class, $newsInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsInformationsRepository->add($newsInformation, true);

            return $this->redirectToRoute('app_news_informations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news_informations/edit.html.twig', [
            'news_information' => $newsInformation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_informations_delete', methods: ['POST'])]
    public function delete(Request $request, NewsInformations $newsInformation, NewsInformationsRepository $newsInformationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $newsInformation->getId(), $request->request->get('_token'))) {
            $newsInformationsRepository->remove($newsInformation, true);
        }

        return $this->redirectToRoute('app_news_informations_index', [], Response::HTTP_SEE_OTHER);
    }
}
