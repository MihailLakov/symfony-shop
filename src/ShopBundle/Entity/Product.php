<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ShopBundle\Entity\Brand;
/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * @var bool
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published;

    /**
     * @var int
     * 
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * 
     */
    private $category;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="image",  type="string")
     * @Assert\Image()
     */
    private $image;
    /**
     * Get id
     *
     * @return int
     */
    
    /**
     * @ORM\ManyToOne(targetEntity="Brand")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     * @var Brand 
     */
    private $brand;
    
     /**
     * @var Review[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="ShopBundle\Entity\Review", mappedBy="product")
     */
    private $reviews;

    /**
     * @var Tag[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ShopBundle\Entity\Tag")
     * @ORM\JoinTable(name="product_tags", joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")})
     */
    private $tags;
    public function __construct() {
        $this->reviews = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return Product
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Product
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return bool
     */
    public function getPublished()
    {
        return $this->published;
    }
    
    /**
     * set Image
     * @param type $image
     * @return \ShopBundle\Entity\Product
     */
    public function setImage($image){
        $this->image = $image;
        return $this;
    }
    
    /**
     * Get Image
     * @return type
     */
    public function getImage(){
        return $this->image;
    }
    /**
     * Set Category
     * @param  \ShopBundle\Entity\Category $category
     * @return \ShopBundle\Entity\Product\
     */
    public function setCategory($category){
        $this->category = $category;
        return $this;
    }
    
    /**
     * 
     * @return \ShopBundle\Entity\Category $category
     */
    public function getCategory(){
        return $this->category;
    }
    
    /**
     * Set Brand
     * @param Brand $brand     
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * Get brand
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
    /**
     * @return Review[]|ArrayCollection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param Review[]|ArrayCollection $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @return Tag[]|ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
    
}

