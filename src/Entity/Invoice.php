<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InvoiceRepository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 * @ApiResource(attributes={"
 *      pagination_enabled"=true,"order":{"id":"desc"}},
 *      collectionOperations={"GET", "POST"},
 *      subresourceOperations={"api_customers_invoices_get_subresource"={
        "normalization_context"={"groups"={"invoices_subresource"}}}},
 *      itemOperations={"GET", "PUT", "DELETE",
 *      "increment"={"method"="post","path"="/invoices/{id}/increment" ,
 *      "controller"="App\Controller\FactureController",
 *      "swagger_context"={
 *          "summary"="incrmentre une facture",
 *          "description"="incrment d'une facutree donnéeds"}
 *      }
 *     },
 *
 *      normalizationContext={"groups"={"invoices_read","customers_read"}}
 * )
 *
 * @ApiFilter(SearchFilter::class)
 * @ApiFilter(OrderFilter::class)

 */
// hdhi ta3ti les properies eli besh ta3ml alihom filtre
// @ApiFilter(SearchFilter::class, properties={"firstName":"partial", "lastName", "company"})

class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"invoices_read"})
     * @Groups({"invoices_read","customers_read","invoices_subresource"})

     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"invoices_read","customers_read","invoices_subresource"})

     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"invoices_read","customers_read","invoices_subresource"})

     */
    private $sentAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"invoices_read","customers_read"})

     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="invoices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"invoices_read","customers_read","invoices_subresource"})

     */
    private $chrono;


    /**
     *
     * Permet de recuperer le user de la facture
     * @Groups({"invoices_read",  "invoices_subresource","invoices_subresource"})
     * @return User
     */
    public function getUser() : User {
        return $this->customer->getUser();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getSentAt(): ?\DateTimeInterface
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeInterface $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getChrono(): ?int
    {
        return $this->chrono;
    }

    public function setChrono(int $chrono): self
    {
        $this->chrono = $chrono;

        return $this;
    }
}
