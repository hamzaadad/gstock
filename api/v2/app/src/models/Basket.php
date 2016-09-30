<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Basket
 *
 * @ORM\Table(name="basket", indexes={@ORM\Index(name="ref_cli", columns={"ref_cli"}), @ORM\Index(name="ref_vend", columns={"ref_vend"}), @ORM\Index(name="ref_prod", columns={"ref_prod"})})
 * @ORM\Entity
 */
class Basket
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
     * @ORM\Column(name="sell_price", type="float", precision=10, scale=0, nullable=true)
     */
    private $sellPrice;

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
     * @var \Clients
     *
     * @ORM\ManyToOne(targetEntity="Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_cli", referencedColumnName="id")
     * })
     */
    private $refCli;

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
     * @return Basket
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
     * Set sellPrice
     *
     * @param float $sellPrice
     *
     * @return Basket
     */
    public function setSellPrice($sellPrice)
    {
        $this->sellPrice = $sellPrice;

        return $this;
    }

    /**
     * Get sellPrice
     *
     * @return float
     */
    public function getSellPrice()
    {
        return $this->sellPrice;
    }

    /**
     * Set refProd
     *
     * @param \Product $refProd
     *
     * @return Basket
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
     * Set refCli
     *
     * @param \Clients $refCli
     *
     * @return Basket
     */
    public function setRefCli(\Clients $refCli = null)
    {
        $this->refCli = $refCli;

        return $this;
    }

    /**
     * Get refCli
     *
     * @return \Clients
     */
    public function getRefCli()
    {
        return $this->refCli;
    }

    /**
     * Set refVend
     *
     * @param \Users $refVend
     *
     * @return Basket
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
}

