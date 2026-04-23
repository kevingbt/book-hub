<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Book>
     */
    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: 'book_author')]
    private Collection $author_book;

    public function __construct()
    {
        $this->author_book = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getAuthorBook(): Collection
    {
        return $this->author_book;
    }

    public function addAuthorBook(Book $authorBook): static
    {
        if (!$this->author_book->contains($authorBook)) {
            $this->author_book->add($authorBook);
            $authorBook->setBookAuthor($this);
        }

        return $this;
    }

    public function removeAuthorBook(Book $authorBook): static
    {
        if ($this->author_book->removeElement($authorBook)) {
            // set the owning side to null (unless already changed)
            if ($authorBook->getBookAuthor() === $this) {
                $authorBook->setBookAuthor(null);
            }
        }

        return $this;
    }
}
