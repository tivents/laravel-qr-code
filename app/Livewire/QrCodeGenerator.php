<?php

declare(strict_types = 1);

namespace App\Livewire;

use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use JeroenDesloovere\VCard\VCard;
use JeroenDesloovere\VCard\Formatter\VCardFormatter;

class QrCodeGenerator extends Component
{
    public $activeTab = 'websiteUrl';
    public $email;
    public $phone;
    public $name;
    public $company_name;
    public $address;
    public $websiteUrl;
    public $qrImage;
    public $qrCodeData;
    public $instagramLink;
    public $facebookLink;
    public $tiktokLink;
    public $whatsappLink;

    public function render()
    {
        return view('livewire.qr-code-generator');
    }


    public function refresh()
    {
        $this->reset();
    }

    public function data()
    {
        $this->name = '';
        $this->company_name = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
        $this->websiteUrl = '';
        $this->instagramLink = '';
        $this->facebookLink = '';
        $this->tiktokLink = '';
        $this->whatsappLink = '';
    }

    public function generateQrCode(): void
    {

        $vcard = new VCard();

        // Set the basic information
        $vcard->addName($this->name);
        $vcard->addCompany($this->company_name);
        $vcard->addPhoneNumber($this->phone);
        $vcard->addEmail($this->email);
        $vcard->addAddress($this->address);

        // Add social media links
        $vcard->addURL($this->websiteUrl, 'Website');
        $vcard->addURL($this->instagramLink, 'Instagram');
        $vcard->addURL($this->facebookLink, 'Facebook');
        $vcard->addURL($this->tiktokLink, 'TikTok');
        $vcard->addURL($this->whatsappLink, 'WhatsApp');
        $vcard->addLabel('street, worktown, workpostcode Belgium');

        // Format the VCard data as a string
        $qrCodeData = $vcard->getOutput();

        $this->qrCodeData = $qrCodeData;
    }

    public function download($qrCodeData)
    {
        return response()->streamDownload(
            function ()  use ($qrCodeData) {
                echo QrCode::size(200)
                    ->format('s')
                    ->generate($qrCodeData);
            },
            'qr-code.png',
            [
                'Content-Type' => 'image/png',
            ]
        );
    }
}
