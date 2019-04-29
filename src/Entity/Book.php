<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * App\Entity\Book
 * 
 * @ORM\Entity
 * @ORM\Table(name="bookshop_book",indexes={@ORM\Index(name="IDX_BOOKTITLE", columns={"title"}),@ORM\Index(name="IDX_BOOKAUTHOR", columns={"author"})})
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string $isbn
     *
     * @ORM\Column(name="isbn",  type="string", length=20, nullable=false)
     */
    private $isbn;
    
    /**
     * @var string $title
     *
     * @ORM\Column(name="title",  type="string", length=100, nullable=false)
     */
    private $title;
    
    /**
     * @var string $author
     *
     * @ORM\Column(name="author",  type="string", length=100, nullable=false)
     */
    private $author;
    
    
    /**
     * @var float $price
     *
     * @ORM\Column(name="price",  type="float", nullable=false)
     */
    private $price;
   
       
     /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="books")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
     protected $category;  
    
    
    
   
    /**
     * Constructor
     */
    public function __construct()
    {
       
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
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    
    /**
     * Set author
     *
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }
    
    
    
    /**
     * Set price
     *
     * @param float $price
     *
     * @return Book
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
    
   
        /**
     * Set category
     *
     * @param \App\Entity\Category $category
     *
     * @return Profile
     */
    public function setCategory(\App\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

}
