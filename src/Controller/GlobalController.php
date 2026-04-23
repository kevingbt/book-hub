<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BookRepository;
use App\Repository\AuthorRepository;

final class GlobalController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    #[Route('/', name: 'accueil')]
    public function index(BookRepository $bookRepository, AuthorRepository $authorRepository): Response
    {
        return $this->render('global/index.html.twig', [
            'books'   => $bookRepository->findRandom(3),
            'authors' => $authorRepository->findRandom(3),
        ]);
    }

    #[Route('/global', name: 'app_global')]
    public function global(BookRepository $bookRepository, AuthorRepository $authorRepository): Response
    {
        return $this->render('global/index.html.twig', [
            'books'   => $bookRepository->findRandom(3),
            'authors' => $authorRepository->findRandom(3),
        ]);
    }
}