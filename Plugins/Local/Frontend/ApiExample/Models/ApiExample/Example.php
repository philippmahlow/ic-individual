<?php

namespace Shopware\CustomModels\ApiExample;

use Doctrine\Common\Collections\ArrayCollection;
use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Models\Article\Article;
use Shopware\Models\Article\Detail;
use Shopware\Models\Article\Supplier;
use Shopware\Models\Media\Media;

/**
 * @ORM\Table(name="s_plugin_api_example")
 * @ORM\Entity
 */
class Example extends ModelEntity
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Shopware\Models\Article\Supplier")
     * @ORM\JoinTable(name="s_plugin_example_supplier",
     *      joinColumns={
     *          @ORM\JoinColumn(
     *              name="example_id",
     *              referencedColumnName="id"
     *          )
     *      },
     *      inverseJoinColumns={
     *          @ORM\JoinColumn(
     *              name="supplier_id",
     *              referencedColumnName="id"
     *          )
     *      }
     * )
     */
    protected $supplier;


    /**
     * @var Media
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Media\Media")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     */
    protected $media;


    /**
     * @var int
     * @ORM\Column(name="media_id", type="integer", nullable=true)
     */
    protected $mediaId;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * @return Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param Media $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * @return int
     */
    public function getMediaId()
    {
        return $this->mediaId;
    }

    /**
     * @param int $mediaId
     */
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
    }

    /**
     * @return ArrayCollection
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * @param ArrayCollection $supplier
     */
    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;
    }



}