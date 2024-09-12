<li class="me-2" role="presentation">
    <button @click="activeTab = '{{ $targetTab }}'"
            class="inline-block p-4 border-b-2 rounded-t-lg" id="{{ $targetTab }}-tab"
            data-tabs-target="#{{ $targetTab }}"
            type="button"
            role="tab"
            aria-controls="{{ $targetTab }}"
           >{{ $title }}
    </button>
</li>
