<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ReceiptRepository")
 * 
 * @Vich\Uploadable
 */
class Receipt
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
     /**
      * @var File
      * @Vich\UploadableField(mapping="receipt_image", fileNameProperty="imageName")
      */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=500)
     *
     * @var string|null
     */

    private $imageName;


    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $instruction;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $preparation;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingrediant", inversedBy="receipts")
     */
    private $ingrediant;

    public function __construct()
    {
        $this->ingrediant = new ArrayCollection();
    }


    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(string $instruction): self
    {
        $this->instruction = $instruction;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): self
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    
    /**
     * Get the value of imageName
     */ 
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set the value of imageName
     *
     * @return  self
     */ 
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get the value of imageFile
     *
     * @return  File
     */ 
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @param  File  $imageFile
     *
     * @return  self
     */ 
    public function setImageFile(File $imageFile)
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * @return Collection|Ingrediant[]
     */
    public function getIngrediant(): Collection
    {
        return $this->ingrediant;
    }

    public function addIngrediant(Ingrediant $ingrediant): self
    {
        if (!$this->ingrediant->contains($ingrediant)) {
            $this->ingrediant[] = $ingrediant;
        }

        return $this;
    }

    public function removeIngrediant(Ingrediant $ingrediant): self
    {
        if ($this->ingrediant->contains($ingrediant)) {
            $this->ingrediant->removeElement($ingrediant);
        }

        return $this;
    }

  
}
