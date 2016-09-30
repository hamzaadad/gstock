<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Fourniseur
 *
 * @ORM\Table(name="fourniseur")
 * @ORM\Entity
 */
class Fourniseur
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
     * @var string
     *
     * @ORM\Column(name="tell", type="string", length=20, nullable=true)
     */
    private $tell;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="text", length=16777215, nullable=true)
     */
    private $adress;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     */
    private $nom;


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
     * Set tell
     *
     * @param string $tell
     *
     * @return Fourniseur
     */
    public function setTell($tell)
    {
        $this->tell = $tell;

        return $this;
    }

    /**
     * Get tell
     *
     * @return string
     */
    public function getTell()
    {
        return $this->tell;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Fourniseur
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Fourniseur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
}

