<?php

namespace App\Domain\MarketPlace\Entity;

use App\Domain\MarketPlace\Repository\MarketPlaceBankAccountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarketPlaceBankAccountRepository::class)]
class MarketPlaceBankAccount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $iban;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $bic;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $bankName;

    #[ORM\OneToOne(
        inversedBy: 'marketPlaceBankAccount',
        targetEntity: MarketPlaceVendor::class,
        cascade: ['persist', 'remove']
    )]
    private ?MarketPlaceVendor $MarketPlaceVendor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(?string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getBic(): ?string
    {
        return $this->bic;
    }

    public function setBic(?string $bic): self
    {
        $this->bic = $bic;

        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(?string $bankName): self
    {
        $this->bankName = $bankName;

        return $this;
    }

    public function getMarketPlaceVendor(): ?MarketPlaceVendor
    {
        return $this->MarketPlaceVendor;
    }

    public function setMarketPlaceVendor(?MarketPlaceVendor $MarketPlaceVendor): self
    {
        $this->MarketPlaceVendor = $MarketPlaceVendor;

        return $this;
    }
}
