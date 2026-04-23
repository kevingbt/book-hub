<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
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
    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: 'book_category')]
    private Collection $category_book;

    public function __construct()
    {
        $this->category_book = new ArrayCollection();
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
    public function getCategoryBook(): Collection
    {
        return $this->category_book;
    }

    public function addCategoryBook(Book $categoryBook): static
    {
        if (!$this->category_book->contains($categoryBook)) {
            $this->category_book->add($categoryBook);
            $categoryBook->addBookCategory($this);
        }

        return $this;
    }

    public function removeCategoryBook(Book $categoryBook): static
    {
        if ($this->category_book->removeElement($categoryBook)) {
            $categoryBook->removeBookCategory($this);
        }

        return $this;
    }
}
