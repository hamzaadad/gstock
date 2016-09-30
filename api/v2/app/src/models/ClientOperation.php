<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ClientOperation
 *
 * @ORM\Table(name="client_operation", indexes={@ORM\Index(name="ref_cli", columns={"ref_cli"}), @ORM\Index(name="ref_vend", columns={"ref_vend"}), @ORM\Index(name="ref_operation", columns={"ref_operation"})})
 * @ORM\Entity
 */
class ClientOperation
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
     * @ORM\Column(name="holding_amount", type="integer", nullable=true)
     */
    private $holdingAmount;

    /**
     * @var integer
     *
     * @ORM\Column(name="advance", type="integer", nullable=true)
     */
    private $advance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var \Basket
     *
     * @ORM\ManyToOne(targetEntity="Basket")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_operation", referencedColumnName="id")
     * })
     */
    private $refOperation;

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
     * Set holdingAmount
     *
     * @param integer $holdingAmount
     *
     * @return ClientOperation
     */
    public function setHoldingAmount($holdingAmount)
    {
        $this->holdingAmount = $holdingAmount;

        return $this;
    }

    /**
     * Get holdingAmount
     *
     * @return integer
     */
    public function getHoldingAmount()
    {
        return $this->holdingAmount;
    }

    /**
     * Set advance
     *
     * @param integer $advance
     *
     * @return ClientOperation
     */
    public function setAdvance($advance)
    {
        $this->advance = $advance;

        return $this;
    }

    /**
     * Get advance
     *
     * @return integer
     */
    public function getAdvance()
    {
        return $this->advance;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ClientOperation
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
     * Set refOperation
     *
     * @param \Basket $refOperation
     *
     * @return ClientOperation
     */
    public function setRefOperation(\Basket $refOperation = null)
    {
        $this->refOperation = $refOperation;

        return $this;
    }

    /**
     * Get refOperation
     *
     * @return \Basket
     */
    public function getRefOperation()
    {
        return $this->refOperation;
    }

    /**
     * Set refCli
     *
     * @param \Clients $refCli
     *
     * @return ClientOperation
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
     * @return ClientOperation
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

