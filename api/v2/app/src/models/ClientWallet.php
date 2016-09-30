<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ClientWallet
 *
 * @ORM\Table(name="client_wallet", indexes={@ORM\Index(name="ref_cli", columns={"ref_cli"})})
 * @ORM\Entity
 */
class ClientWallet
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
     * @ORM\Column(name="amout", type="integer", nullable=true)
     */
    private $amout;

    /**
     * @var integer
     *
     * @ORM\Column(name="avout", type="integer", nullable=true)
     */
    private $avout;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set amout
     *
     * @param integer $amout
     *
     * @return ClientWallet
     */
    public function setAmout($amout)
    {
        $this->amout = $amout;

        return $this;
    }

    /**
     * Get amout
     *
     * @return integer
     */
    public function getAmout()
    {
        return $this->amout;
    }

    /**
     * Set avout
     *
     * @param integer $avout
     *
     * @return ClientWallet
     */
    public function setAvout($avout)
    {
        $this->avout = $avout;

        return $this;
    }

    /**
     * Get avout
     *
     * @return integer
     */
    public function getAvout()
    {
        return $this->avout;
    }

    /**
     * Set refCli
     *
     * @param \Clients $refCli
     *
     * @return ClientWallet
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
}

