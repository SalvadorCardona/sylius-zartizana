<?php

declare(strict_types=1);

namespace App\Domain\MarketPlace\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\MarketPlace\Repository\MarketPlaceVendorRepository;
use App\Entity\Taxonomy\Taxon;
use App\Entity\User\ShopUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MarketPlaceVendorRepository::class)]
#[ApiResource(
    collectionOperations: [
        'create_vendor' => [
            'method' => 'POST',
            'path' => '/shop/market-place-vendors/create',
            'denormalization_context' => ['groups' => 'shop:create:vendor'],
            'output' => false,
        ],
    ],
    itemOperations: [
        'get' => [
            "security" => "is_granted('ROLE_ADMIN')"
        ]
    ]
)]
class MarketPlaceVendor implements ResourceInterface
{
    public const CREATED = 'CREATED';
    public const WAITING_VALIDATION = 'WAITING_VALIDATION';
    public const VALIDATED = 'validated';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['shop:customer:read'])]
    private ?int $id;

    #[ORM\OneToOne(inversedBy: 'marketplaceVendor', targetEntity: ShopUser::class)]
    private ?ShopUser $user;

    #[Groups(['shop:customer:read'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $state = self::CREATED;

    #[ORM\OneToOne(
        mappedBy: 'MarketPlaceVendor',
        targetEntity: MarketPlaceBankAccount::class,
        cascade: ['persist', 'remove']
    )]
    private ?MarketPlaceBankAccount $marketPlaceBankAccount;

    /** @var Collection<array-key, MarketPlaceStore> */
    #[Groups(['shop:create:vendor'])]
    #[ORM\OneToMany(
        mappedBy: 'marketPlaceVendor',
        targetEntity: MarketPlaceStore::class,
        cascade: ['persist', 'remove']
    )]
    private Collection $marketPlaceStores;

    #[Groups(['shop:create:vendor'])]
    #[ORM\ManyToOne(targetEntity: Taxon::class)]
    private ?Taxon $mainTaxon;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $siret;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $profilePicture;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $phoneNumber;

    /** @var Collection<array-key, MarketPlaceProduct> */
    #[ORM\OneToMany(mappedBy: 'MarketPlaceVendor', targetEntity: MarketPlaceProduct::class)]
    private Collection $marketPlaceProducts;

    public function __construct()
    {
        $this->marketPlaceStores = new ArrayCollection();
        $this->marketPlaceProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?ShopUser
    {
        return $this->user;
    }

    public function setUser(?ShopUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMarketPlaceBankAccount(): ?MarketPlaceBankAccount
    {
        return $this->marketPlaceBankAccount;
    }

    public function setMarketPlaceBankAccount(?MarketPlaceBankAccount $marketPlaceBankAccount): self
    {
        // unset the owning side of the relation if necessary
        if ($marketPlaceBankAccount === null && $this->marketPlaceBankAccount !== null) {
            $this->marketPlaceBankAccount->setMarketPlaceVendor(null);
        }

        // set the owning side of the relation if necessary
        if ($marketPlaceBankAccount !== null && $marketPlaceBankAccount->getMarketPlaceVendor() !== $this) {
            $marketPlaceBankAccount->setMarketPlaceVendor($this);
        }

        $this->marketPlaceBankAccount = $marketPlaceBankAccount;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return Collection<array-key, MarketPlaceStore>
     */
    public function getMarketPlaceStores(): Collection
    {
        return $this->marketPlaceStores;
    }

    public function addMarketPlaceStore(MarketPlaceStore $marketPlaceStore): self
    {
        if (!$this->marketPlaceStores->contains($marketPlaceStore)) {
            $this->marketPlaceStores[] = $marketPlaceStore;
            $marketPlaceStore->setMarketPlaceVendor($this);
        }

        return $this;
    }

    public function removeMarketPlaceStore(MarketPlaceStore $marketPlaceStore): self
    {
        if ($this->marketPlaceStores->removeElement($marketPlaceStore)) {
            // set the owning side to null (unless already changed)
            if ($marketPlaceStore->getMarketPlaceVendor() === $this) {
                $marketPlaceStore->setMarketPlaceVendor(null);
            }
        }

        return $this;
    }

    public function getMainTaxon(): ?Taxon
    {
        return $this->mainTaxon;
    }

    public function setMainTaxon(?Taxon $mainTaxon): self
    {
        $this->mainTaxon = $mainTaxon;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

    /**
     * @return Collection<array-key, MarketPlaceProduct>
     */
    public function getMarketPlaceProducts(): Collection
    {
        return $this->marketPlaceProducts;
    }

    public function addMarketPlaceProduct(MarketPlaceProduct $marketPlaceProduct): self
    {
        if (!$this->marketPlaceProducts->contains($marketPlaceProduct)) {
            $this->marketPlaceProducts[] = $marketPlaceProduct;
            $marketPlaceProduct->setMarketPlaceVendor($this);
        }

        return $this;
    }

    public function removeMarketPlaceProduct(MarketPlaceProduct $marketPlaceProduct): self
    {
        if ($this->marketPlaceProducts->removeElement($marketPlaceProduct)) {
            // set the owning side to null (unless already changed)
            if ($marketPlaceProduct->getMarketPlaceVendor() === $this) {
                $marketPlaceProduct->setMarketPlaceVendor(null);
            }
        }

        return $this;
    }
}
