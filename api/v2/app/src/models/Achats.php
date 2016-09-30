<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Achats
 *
 * @ORM\Table(name="achats", indexes={@ORM\Index(name="ref_prod", columns={"ref_prod"}), @ORM\Index(name="ref_for", columns={"ref_for"}), @ORM\Index(name="ref_vend", columns={"ref_vend"})})
 * @ORM\Entity
 */
class Achats
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="qty", type="integer", nullable=true)
     */
    private $qty;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_vend", referencedColumnName="id")
     * })
     */
    private $refVend;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_prod", referencedColumnName="id")
     * })
     */
    private $refProd;

    /**
     * @var \Fourniseur
     *
     * @ORM\ManyToOne(targetEntity="Fourniseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_for", referencedColumnName="id")
     * })
     */
    private $refFor;


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
     * Set qty
     *
     * @param integer $qty
     *
     * @return Achats
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty
     *
     * @return integer
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Achats
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Achats
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set refVend
     *
     * @param \Users $refVend
     *
     * @return Achats
     */
    public function setRefVend(\Users $refVend = null)
    {
        $this->refVend = $refVend;

        return $this;
    }

    /**
     * Get refVend
     *
     * @return \Users
     */
    public function getRefVend()
    {
        return $this->refVend;
    }

    /**
     * Set refProd
     *
     * @param \Product $refProd
     *
     * @return Achats
     */
    public function setRefProd(\Product $refProd = null)
    {
        $this->refProd = $refProd;

        return $this;
    }

    /**
     * Get refProd
     *
     * @return \Product
     */
    public function getRefProd()
    {
        return $this->refProd;
    }

    /**
     * Set refFor
     *
     * @param \Fourniseur $refFor
     *
     * @return Achats
     */
    public function setRefFor(\Fourniseur $refFor = null)
    {
        $this->refFor = $refFor;

        return $this;
    }

    /**
     * Get refFor
     *
     * @return \Fourniseur
     */
    public function getRefFor()
    {
        return $this->refFor;
    }
}

