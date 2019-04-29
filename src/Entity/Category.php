<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * App\Entity\Category
 * 
 * @ORM\Entity
 * @ORM\Table(name="bookshop_category",indexes={@ORM\Index(name="IDX_CATEGORYNAME", columns={"name"})})
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     * 
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;
    
    
     /**
     * @ORM\OneToMany(targetEntity="Book", mappedBy="category")
     */
    protected $books;

       
    
    public function __construct() {
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
 
    /**
     * Set setName
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
 
        return $this;
    }
 
    /**
     * Get getName
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }    
    
    
    
   /**
     * Add book
     *
     * @param \App\Entity\Book $book
     *
     * @return Category
     */
    public function addBook(\App\Entity\Book $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \App\Entity\Book $book
     */
    public function removeBook(\App\Entity\Book $book)
    {
        $this->books->removeElement($book);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }
    
}
