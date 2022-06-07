<?php

declare(strict_types=1);

namespace App\Domain\MarketPlace\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\MarketPlace\Repository\MarketPlaceVendorRepository;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Product\ProductVariant;
use App\Entity\Taxonomy\Taxon;
use App\Entity\User\ShopUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Id\UuidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

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
    itemOperations: []
)]
class MarketPlaceVendor implements ResourceInterface
{
    public const CREATED = 'CREATED';
    public const WAITING_VALIDATION = 'WAITING_VALIDATION';
    public const VALIDATED = 'validated';

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id;

    #[ORM\OneToOne(inversedBy: 'marketplaceVendor', targetEntity: ShopUser::class)]
    private ?ShopUser $user;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $state = self::CREATED;

    #[ORM\OneToOne(
        mappedBy: 'MarketPlaceVendor',
        targetEntity: MarketPlaceBankAccount::class,
        cascade: ['persist', 'remove']
    )]
    private ?MarketPlaceBankAccount $marketPlaceBankAccount;

    /** @var Collection<int, MarketPlaceStore> */
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

    /** @var Collection<int, ProductVariant> */
    #[ORM\OneToMany(mappedBy: 'marketPlaceVendor', targetEntity: ProductVariant::class)]
    private Collection $productVariants;

    #[Groups(['shop:create:vendor'])]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $phoneNumber;

    public function __construct()
    {
        $this->marketPlaceStores = new ArrayCollection();
        $this->productVariants = new ArrayCollection();
    }

    public function getId(): ?Uuid
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
     * @return Collection<int, MarketPlaceStore>
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

    /**
     * @return Collection<int, ProductVariant>
     */
    public function getProductVariants(): Collection
    {
        return $this->productVariants;
    }

    public function addProductVariant(ProductVariant $productVariant): self
    {
        if (!$this->productVariants->contains($productVariant)) {
            $this->productVariants[] = $productVariant;
            $productVariant->setMarketPlaceVendor($this);
        }

        return $this;
    }

    public function removeProductVariant(ProductVariant $productVariant): self
    {
        if ($this->productVariants->removeElement($productVariant)) {
            // set the owning side to null (unless already changed)
            if ($productVariant->getMarketPlaceVendor() === $this) {
                $productVariant->setMarketPlaceVendor(null);
            }
        }

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
}
