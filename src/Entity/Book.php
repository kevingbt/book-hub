<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'author_book')]
    private ?Author $book_author = null;

    /**
     * @var Collection<int, category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'category_book')]
    private Collection $book_category;

    public function __construct()
    {
        $this->book_category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBookAuthor(): ?Author
    {
        return $this->book_author;
    }

    public function setBookAuthor(?Author $book_author): static
    {
        $this->book_author = $book_author;

        return $this;
    }

    /**
     * @return Collection<int, category>
     */
    public function getBookCategory(): Collection
    {
        return $this->book_category;
    }

    public function addBookCategory(Category $bookCategory): static
    {
        if (!$this->book_category->contains($bookCategory)) {
            $this->book_category->add($bookCategory);
        }

        return $this;
    }

    public function removeBookCategory(Category $bookCategory): static
    {
        $this->book_category->removeElement($bookCategory);

        return $this;
    }
}
