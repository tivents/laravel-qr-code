<div  x-data="{ activeTab: @entangle('activeTab') }">
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <x-tab-nav-link title='Website URL' target-tab="websiteUrl"/>
            <x-tab-nav-link title='E-mail Address' target-tab="emailAddress"/>
            <x-tab-nav-link title='Phonenumber' target-tab="phoneNumber"/>
            <x-tab-nav-link title='vCard' target-tab="vCard"/>
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="@if($activeTab !== 'websiteUrl') hidden @endif p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="websiteUrl" role="tabpanel" aria-labelledby="websiteUrl-tab" >
            <div class="grid grid-cols-1 grid-rows-1 md:grid-cols-2">
                <div class="me-4 block rounded-lg bg-white shadow-secondary-1 dark:bg-surface-dark dark:text-white text-surface">
                    <div class="p-6">
                       <x-floating-input input-name="Website URL" input-id="websiteUrl" type="text"/>
                    </div>
                </div>

                <div
                    class="block rounded-lg bg-white shadow-secondary-1 dark:bg-surface-dark dark:text-white text-surface">
                    <div class="p-6">
                        <div wire:loading >
                            <x-loading-spinner />
                        </div>

                        @if ($websiteUrl !== null)
                            {!! SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->style('dot')->size(400)->eye('circle')->generate('https://'.$websiteUrl) !!}
                            <div class="p-5">
                                <button
                                    type="button"
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                    wire:click="download('{{$websiteUrl}}')">
                                    Download
                                </button>
                                <button  wire:click="refresh" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Reset
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="@if($activeTab !== 'emailAddress') hidden @endif p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="emailAddress" role="tabpanel" aria-labelledby="emailAddress-tab" >
            <label for="email">Email</label>
            <input type="email" id="email" wire:model.lazy="email"
                   class="w-full border border-gray-300 px-2 py-1">
            @if ($email !== null)
                <div class="my-4 flex justify-center">
                    {!! SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->style('square')->size(400)->eye('circle')->email($email) !!}
                </div>
                <div class="my-4 text-center">
                    <button danger type="button" wire:click="refresh">
                        reset
                    </button>
                </div>
            @endif
        </div>
        <div class="@if($activeTab !== 'phoneNumber') hidden @endif p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="phoneNumber" role="tabpanel" aria-labelledby="phoneNumber-tab">
            <label for="phone">Phone</label>
            <input type="number" id="phone" wire:model.lazy="phone"
                   class="w-full border border-gray-300 px-2 py-1">
            @if ($phone !== null)
                <div class="my-4 flex justify-center">
                    {!! SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->style('square')->size(400)->eye('circle')->phoneNumber($phone) !!}
                </div>
                <div class="my-4 text-center">
                    <button danger type="button" wire:click="refresh">
                        reset
                    </button>
                </div>
            @endif
        </div>
        <div class="@if($activeTab !== 'vCard') hidden @endif p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="vCard" role="tabpanel" aria-labelledby="vCard-tab">
            <div class="grid grid-cols-1 grid-rows-1 md:grid-cols-2">
                <div class="me-4 block rounded-lg bg-white shadow-secondary-1 dark:bg-surface-dark dark:text-white text-surface">
                    <div class="p-6">
                        <x-floating-input input-name="Name" input-id="name" type="text" />
                        <x-floating-input input-name="Company Name" input-id="company_name" type="text" />
                        <x-floating-input input-name="Phone" input-id="phone" type="number" />
                        <x-floating-input input-name="Email" input-id="email" type="email" />
                        <x-floating-input input-name="Address" input-id="address" type="text" />
                        <x-floating-input input-name="Website" input-id="website" type="text" />
                        <x-floating-input input-name="Instagram" input-id="instagramLink" type="text" />
                        <x-floating-input input-name="Facebook" input-id="facebookLink" type="text" />
                        <x-floating-input input-name="TikTok" input-id="tiktokLink" type="text" />
                        <x-floating-input input-name="WhatsApp" input-id="whatsappLink" type="text" />
                    </div>
                </div>
            </div>
            <div class="my-4 text-center">
                <button danger type="button" wire:click="generateQrCode">
                    generate Qr Code
                </button>
                <button danger type="button" wire:click="data">
                    fill with data
                </button>
            </div>
            @if ($qrCodeData !== null)
                <div class="my-4 flex justify-center">
                    {!! SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->style('square')->size(400)->eye('circle')->generate($qrCodeData) !!}
                </div>
                <div class="my-4 text-center">
                    <button danger type="button" wire:click="refresh">
                        reset
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
