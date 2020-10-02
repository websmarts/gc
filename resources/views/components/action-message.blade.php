

<div x-data="{ shown: false, timeout: null }"
    x-init="clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); "
    x-show.transition.opacity.out.duration.1500ms="shown"
    style="display: none;"
    >
    {{ $slot ?? 'Saved.' }}
    
</div>