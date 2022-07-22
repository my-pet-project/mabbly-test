<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="team")
 * @ORM\Entity()
 * @ApiResource(
 *     normalizationContext={"groups"={"report:collection:get"}},
 *     collectionOperations={},
 *     itemOperations={"get"}
 * )
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue()
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Groups({"report:collection:get"})
     */
    private string $name;

    /**
     * @var Account[]|Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Account", mappedBy="team")
     * @Groups({"report:collection:get"})
     */
    private $accounts;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Account[]|Collection
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param $accounts
     */
    public function setAccounts($accounts): void
    {
        $this->accounts = $accounts;
    }

    /**
     * @Groups({"report:collection:get"})
     * @return int
     */
    public function getSize(): int
    {
        return count($this->getAccounts());
    }
}
