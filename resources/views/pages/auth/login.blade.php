<x-filament-panels::page.simple>
    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}

            {{ $this->registerAction }}
        </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(
        \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
        scopes: $this->getRenderHookScopes(),
    ) }}

    <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}
        <div id="hcaptcha-container" wire:ignore></div>

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(
        \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
        scopes: $this->getRenderHookScopes(),
    ) }}

    <script src="https://js.hcaptcha.com/1/api.js?onload=onloadHCaptcha&render=explicit" async defer></script>

    <script>
        let widgetId = null;

        function onloadHCaptcha() {
            widgetId = hcaptcha.render('hcaptcha-container', {
                sitekey: '{{ $hcaptchaSiteKey }}',
                callback: onSolve,
            });
        }

        function onSolve(token, key) {
            @this.set('hCaptchaToken', token);
        }

        function resetHCaptcha() {
            if (widgetId) hcaptcha.reset(widgetId);
        }
    </script>
</x-filament-panels::page.simple>
