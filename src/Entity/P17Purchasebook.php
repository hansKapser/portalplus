<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * P17Purchasebook
 *
 * @ORM\Table(name="p17_purchasebook", indexes={@ORM\Index(name="ticketID", columns={"ticketID"}), @ORM\Index(name="projectID", columns={"projectID"}), @ORM\Index(name="examUserID", columns={"examUserID"})})
 * @ORM\Entity
 */
class P17Purchasebook
{
    /**
     * @var int
     *
     * @ORM\Column(name="orderID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="projectID", type="integer", nullable=true)
     */
    private $projectid;

    /**
     * @var int
     *
     * @ORM\Column(name="firmID", type="integer", nullable=false)
     */
    private $firmid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="creditor", type="integer", nullable=true)
     */
    private $creditor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="supplier_firmID", type="integer", nullable=true, options={"default"="-1"})
     */
    private $supplierFirmid = '-1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="supplier_company", type="string", length=50, nullable=true)
     */
    private $supplierCompany;

    /**
     * @var int|null
     *
     * @ORM\Column(name="supplier_ticketID", type="integer", nullable=true)
     */
    private $supplierTicketid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="confirmationNo", type="string", length=25, nullable=true)
     */
    private $confirmationno;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="confirmationDate", type="date", nullable=true)
     */
    private $confirmationdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="purchaseNo", type="string", length=25, nullable=true)
     */
    private $purchaseno;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="purchaseDate", type="date", nullable=true)
     */
    private $purchasedate;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="week", type="boolean", nullable=true)
     */
    private $week = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="reason", type="string", length=2, nullable=true)
     */
    private $reason;

    /**
     * @var string|null
     *
     * @ORM\Column(name="basisPrice", type="string", length=30, nullable=true)
     */
    private $basisprice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="offerNo", type="string", length=20, nullable=true)
     */
    private $offerno;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="offerDate", type="date", nullable=true)
     */
    private $offerdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryCondition", type="string", length=10, nullable=true)
     */
    private $deliverycondition;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dispatch", type="string", length=10, nullable=true)
     */
    private $dispatch;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postNumberReceiver", type="string", length=30, nullable=true)
     */
    private $postnumberreceiver;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryNo", type="string", length=20, nullable=true)
     */
    private $deliveryno;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="deliveryDate", type="date", nullable=true)
     */
    private $deliverydate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="incomingDate", type="date", nullable=true)
     */
    private $incomingdate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="receiptDate", type="date", nullable=true)
     */
    private $receiptdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="shippingCosts", type="decimal", precision=6, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $shippingcosts = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="packingCost", type="decimal", precision=8, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $packingcost = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="invoiceNo", type="string", length=20, nullable=true)
     */
    private $invoiceno;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="invoiceDate", type="date", nullable=true)
     */
    private $invoicedate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="invoiceInDate", type="integer", nullable=true)
     */
    private $invoiceindate = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="invoiceNoInternal", type="string", length=20, nullable=true)
     */
    private $invoicenointernal;

    /**
     * @var bool
     *
     * @ORM\Column(name="factCorrect", type="boolean", nullable=false, options={"default"="-1"})
     */
    private $factcorrect = '-1';

    /**
     * @var bool
     *
     * @ORM\Column(name="calcCorrect", type="boolean", nullable=false, options={"default"="-1"})
     */
    private $calccorrect = '-1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="invoiceComment", type="text", length=65535, nullable=true)
     */
    private $invoicecomment;

    /**
     * @var bool
     *
     * @ORM\Column(name="termPayment", type="boolean", nullable=false, options={"default"="1"})
     */
    private $termpayment = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="postOutID", type="string", length=100, nullable=true)
     */
    private $postoutid;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reminder1", type="date", nullable=true)
     */
    private $reminder1;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reminder1sent", type="date", nullable=true)
     */
    private $reminder1sent;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reminder2", type="date", nullable=true)
     */
    private $reminder2;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reminder2sent", type="date", nullable=true)
     */
    private $reminder2sent;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reminder3", type="date", nullable=true)
     */
    private $reminder3;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="reminder3sent", type="date", nullable=true)
     */
    private $reminder3sent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="user", type="string", length=25, nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="printForm", type="string", length=10, nullable=false, options={"default"="UeBW"})
     */
    private $printform = 'UeBW';

    /**
     * @var string
     *
     * @ORM\Column(name="printLang", type="string", length=3, nullable=false, options={"default"="de"})
     */
    private $printlang = 'de';

    /**
     * @var int|null
     *
     * @ORM\Column(name="examUserID", type="integer", nullable=true)
     */
    private $examuserid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="userID", type="integer", nullable=true)
     */
    private $userid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetime = 'CURRENT_TIMESTAMP';

    /**
     * @var \P17Tickets
     *
     * @ORM\ManyToOne(targetEntity="P17Tickets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ticketID", referencedColumnName="ticketID")
     * })
     */
    private $ticketid;

    public function getOrderid(): ?int
    {
        return $this->orderid;
    }

    public function getProjectid(): ?int
    {
        return $this->projectid;
    }

    public function setProjectid(?int $projectid): self
    {
        $this->projectid = $projectid;

        return $this;
    }

    public function getFirmid(): ?int
    {
        return $this->firmid;
    }

    public function setFirmid(int $firmid): self
    {
        $this->firmid = $firmid;

        return $this;
    }

    public function getCreditor(): ?int
    {
        return $this->creditor;
    }

    public function setCreditor(?int $creditor): self
    {
        $this->creditor = $creditor;

        return $this;
    }

    public function getSupplierFirmid(): ?int
    {
        return $this->supplierFirmid;
    }

    public function setSupplierFirmid(?int $supplierFirmid): self
    {
        $this->supplierFirmid = $supplierFirmid;

        return $this;
    }

    public function getSupplierCompany(): ?string
    {
        return $this->supplierCompany;
    }

    public function setSupplierCompany(?string $supplierCompany): self
    {
        $this->supplierCompany = $supplierCompany;

        return $this;
    }

    public function getSupplierTicketid(): ?int
    {
        return $this->supplierTicketid;
    }

    public function setSupplierTicketid(?int $supplierTicketid): self
    {
        $this->supplierTicketid = $supplierTicketid;

        return $this;
    }

    public function getConfirmationno(): ?string
    {
        return $this->confirmationno;
    }

    public function setConfirmationno(?string $confirmationno): self
    {
        $this->confirmationno = $confirmationno;

        return $this;
    }

    public function getConfirmationdate(): ?\DateTimeInterface
    {
        return $this->confirmationdate;
    }

    public function setConfirmationdate(?\DateTimeInterface $confirmationdate): self
    {
        $this->confirmationdate = $confirmationdate;

        return $this;
    }

    public function getPurchaseno(): ?string
    {
        return $this->purchaseno;
    }

    public function setPurchaseno(?string $purchaseno): self
    {
        $this->purchaseno = $purchaseno;

        return $this;
    }

    public function getPurchasedate(): ?\DateTimeInterface
    {
        return $this->purchasedate;
    }

    public function setPurchasedate(?\DateTimeInterface $purchasedate): self
    {
        $this->purchasedate = $purchasedate;

        return $this;
    }

    public function getWeek(): ?bool
    {
        return $this->week;
    }

    public function setWeek(?bool $week): self
    {
        $this->week = $week;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getBasisprice(): ?string
    {
        return $this->basisprice;
    }

    public function setBasisprice(?string $basisprice): self
    {
        $this->basisprice = $basisprice;

        return $this;
    }

    public function getOfferno(): ?string
    {
        return $this->offerno;
    }

    public function setOfferno(?string $offerno): self
    {
        $this->offerno = $offerno;

        return $this;
    }

    public function getOfferdate(): ?\DateTimeInterface
    {
        return $this->offerdate;
    }

    public function setOfferdate(?\DateTimeInterface $offerdate): self
    {
        $this->offerdate = $offerdate;

        return $this;
    }

    public function getDeliverycondition(): ?string
    {
        return $this->deliverycondition;
    }

    public function setDeliverycondition(?string $deliverycondition): self
    {
        $this->deliverycondition = $deliverycondition;

        return $this;
    }

    public function getDispatch(): ?string
    {
        return $this->dispatch;
    }

    public function setDispatch(?string $dispatch): self
    {
        $this->dispatch = $dispatch;

        return $this;
    }

    public function getPostnumberreceiver(): ?string
    {
        return $this->postnumberreceiver;
    }

    public function setPostnumberreceiver(?string $postnumberreceiver): self
    {
        $this->postnumberreceiver = $postnumberreceiver;

        return $this;
    }

    public function getDeliveryno(): ?string
    {
        return $this->deliveryno;
    }

    public function setDeliveryno(?string $deliveryno): self
    {
        $this->deliveryno = $deliveryno;

        return $this;
    }

    public function getDeliverydate(): ?\DateTimeInterface
    {
        return $this->deliverydate;
    }

    public function setDeliverydate(?\DateTimeInterface $deliverydate): self
    {
        $this->deliverydate = $deliverydate;

        return $this;
    }

    public function getIncomingdate(): ?\DateTimeInterface
    {
        return $this->incomingdate;
    }

    public function setIncomingdate(?\DateTimeInterface $incomingdate): self
    {
        $this->incomingdate = $incomingdate;

        return $this;
    }

    public function getReceiptdate(): ?\DateTimeInterface
    {
        return $this->receiptdate;
    }

    public function setReceiptdate(?\DateTimeInterface $receiptdate): self
    {
        $this->receiptdate = $receiptdate;

        return $this;
    }

    public function getShippingcosts()
    {
        return $this->shippingcosts;
    }

    public function setShippingcosts($shippingcosts): self
    {
        $this->shippingcosts = $shippingcosts;

        return $this;
    }

    public function getPackingcost()
    {
        return $this->packingcost;
    }

    public function setPackingcost($packingcost): self
    {
        $this->packingcost = $packingcost;

        return $this;
    }

    public function getInvoiceno(): ?string
    {
        return $this->invoiceno;
    }

    public function setInvoiceno(?string $invoiceno): self
    {
        $this->invoiceno = $invoiceno;

        return $this;
    }

    public function getInvoicedate(): ?\DateTimeInterface
    {
        return $this->invoicedate;
    }

    public function setInvoicedate(?\DateTimeInterface $invoicedate): self
    {
        $this->invoicedate = $invoicedate;

        return $this;
    }

    public function getInvoiceindate(): ?int
    {
        return $this->invoiceindate;
    }

    public function setInvoiceindate(?int $invoiceindate): self
    {
        $this->invoiceindate = $invoiceindate;

        return $this;
    }

    public function getInvoicenointernal(): ?string
    {
        return $this->invoicenointernal;
    }

    public function setInvoicenointernal(?string $invoicenointernal): self
    {
        $this->invoicenointernal = $invoicenointernal;

        return $this;
    }

    public function getFactcorrect(): ?bool
    {
        return $this->factcorrect;
    }

    public function setFactcorrect(bool $factcorrect): self
    {
        $this->factcorrect = $factcorrect;

        return $this;
    }

    public function getCalccorrect(): ?bool
    {
        return $this->calccorrect;
    }

    public function setCalccorrect(bool $calccorrect): self
    {
        $this->calccorrect = $calccorrect;

        return $this;
    }

    public function getInvoicecomment(): ?string
    {
        return $this->invoicecomment;
    }

    public function setInvoicecomment(?string $invoicecomment): self
    {
        $this->invoicecomment = $invoicecomment;

        return $this;
    }

    public function getTermpayment(): ?bool
    {
        return $this->termpayment;
    }

    public function setTermpayment(bool $termpayment): self
    {
        $this->termpayment = $termpayment;

        return $this;
    }

    public function getPostoutid(): ?string
    {
        return $this->postoutid;
    }

    public function setPostoutid(?string $postoutid): self
    {
        $this->postoutid = $postoutid;

        return $this;
    }

    public function getReminder1(): ?\DateTimeInterface
    {
        return $this->reminder1;
    }

    public function setReminder1(?\DateTimeInterface $reminder1): self
    {
        $this->reminder1 = $reminder1;

        return $this;
    }

    public function getReminder1sent(): ?\DateTimeInterface
    {
        return $this->reminder1sent;
    }

    public function setReminder1sent(?\DateTimeInterface $reminder1sent): self
    {
        $this->reminder1sent = $reminder1sent;

        return $this;
    }

    public function getReminder2(): ?\DateTimeInterface
    {
        return $this->reminder2;
    }

    public function setReminder2(?\DateTimeInterface $reminder2): self
    {
        $this->reminder2 = $reminder2;

        return $this;
    }

    public function getReminder2sent(): ?\DateTimeInterface
    {
        return $this->reminder2sent;
    }

    public function setReminder2sent(?\DateTimeInterface $reminder2sent): self
    {
        $this->reminder2sent = $reminder2sent;

        return $this;
    }

    public function getReminder3(): ?\DateTimeInterface
    {
        return $this->reminder3;
    }

    public function setReminder3(?\DateTimeInterface $reminder3): self
    {
        $this->reminder3 = $reminder3;

        return $this;
    }

    public function getReminder3sent(): ?\DateTimeInterface
    {
        return $this->reminder3sent;
    }

    public function setReminder3sent(?\DateTimeInterface $reminder3sent): self
    {
        $this->reminder3sent = $reminder3sent;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(?string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPrintform(): ?string
    {
        return $this->printform;
    }

    public function setPrintform(string $printform): self
    {
        $this->printform = $printform;

        return $this;
    }

    public function getPrintlang(): ?string
    {
        return $this->printlang;
    }

    public function setPrintlang(string $printlang): self
    {
        $this->printlang = $printlang;

        return $this;
    }

    public function getExamuserid(): ?int
    {
        return $this->examuserid;
    }

    public function setExamuserid(?int $examuserid): self
    {
        $this->examuserid = $examuserid;

        return $this;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(?int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getTicketid(): ?P17Tickets
    {
        return $this->ticketid;
    }

    public function setTicketid(?P17Tickets $ticketid): self
    {
        $this->ticketid = $ticketid;

        return $this;
    }


}
