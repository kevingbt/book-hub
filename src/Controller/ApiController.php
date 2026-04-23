<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    #[Route('/api/books', name: 'api_books', methods: ['GET'])]
    public function books(BookRepository $bookRepository): JsonResponse
    {
        $books = $bookRepository->findAll();

        $data = [];

        foreach ($books as $book) {
            $data[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'year' => $book->getYear(),
                'description' => $book->getDescription(),
                'author' => $book->getBookAuthor()?->getName(),
                'categories' => array_map(
                    fn($cat) => $cat->getName(),
                    $book->getBookCategory()->toArray()
                ),
            ];
        }

        return $this->json($data);
    }

    #[Route('/api/books/{id}', name: 'api_book_show', methods: ['GET'])]
    public function book(int $id, BookRepository $bookRepository): JsonResponse
    {
        $book = $bookRepository->find($id);



        return $this->json([
            'id' => $book->getId(),
            'title' => $book->getTitle(),
            'year' => $book->getYear(),
            'description' => $book->getDescription(),
            'author' => $book->getBookAuthor()?->getName(),
            'categories' => array_map(
                fn($cat) => $cat->getName(),
                $book->getBookCategory()->toArray()
            ),
        ]);
    }

    #[Route('/api/authors', name: 'api_authors', methods: ['GET'])]
    public function authors(AuthorRepository $authorRepository): JsonResponse
    {
        $authors = $authorRepository->findAll();

        $data = [];

        foreach ($authors as $author) {
            $data[] = [
                'id' => $author->getId(),
                'name' => $author->getName(),
            ];
        }

        return $this->json($data);
    }
}