<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnonceRepository")
 * @Vich\Uploadable
 */
class Annonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * 
     * 
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */

    private $filename;

   
    /**
     * 
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     * 
     * @var File|null
     */
    private $imageFile;

    

    

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(min=5, max=25,
     *    minMessage = "il faut enter plus de {{ limit }} caractère",
     *    maxMessage = "il faut entrer moins de  {{ limit }} characters"
     *)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(min=10, max=40,
         *minMessage = "il faut enter plus de {{ limit }} caractère",
         *maxMessage = "il faut entrer moins de  {{ limit }} characters"
     *)
     */
    private $shor_description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(min=15,
     *   minMessage = "il faut enter plus de {{ limit }} caractère",
    
     *)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $date_at;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     *@Assert\Regex(
     * pattern="/[0-9]{10}/"
     *)
     */
    private $numero_tel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Length(min=2, max=15,
     *  minMessage = "il faut enter plus de {{ limit }} caractère",
     *      maxMessage = "il faut entrer moins de  {{ limit }} characters"
     *)

     */
    private $lieu;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Images", inversedBy="annonce", cascade={"persist", "remove"})
     * 

     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="annonces")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="annonces")
     */
    private $region;

   

    


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getShorDescription(): ?string
    {
        return $this->shor_description;
    }

    public function setShorDescription(string $shor_description): self
    {
        $this->shor_description = $shor_description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateAt(): ?\DateTimeInterface
    {
        return $this->date_at;
    }

    public function setDateAt(\DateTimeInterface $date_at): self
    {
        $this->date_at = $date_at;

        return $this;
    }

    public function getNumeroTel(): ?int
    {
        return $this->numero_tel;
    }

    public function setNumeroTel(int $numero_tel): self
    {
        $this->numero_tel = $numero_tel;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getImages(): ?Images
    {
        return $this->images;
    }

    public function setImages(?Images $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }
    /**
    * @return null|string
    */
    public function getFilename(): ?string
    {

        return $this->filename;

    }
    /**
    * @return null|string
    */
    public function setFilename(?string $filename): Annonce
    {
        $this->filename = $filename;

        return $this;
    }

      /**
    * @return null|File
    */
    public function getImageFile(): ?File
    {

        return $this->imageFile;

    }
    
    /**
    * @param null|File $imageFile
    * @return Annonce 
    */
    public function setImageFile(?File $imageFile): Annonce
    {
        $this->imageFile = $imageFile;
           
        return $this;
    }

   


}
