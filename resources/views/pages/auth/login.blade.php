<x-filament-panels::page.simple>
    @if (filament()->hasRegistration())
    <x-slot name="subheading">
        {{ __('filament-panels::pages/auth/login.actions.register.before') }}

        {{ $this->registerAction }}
    </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
    scopes: $this->getRenderHookScopes()) }}

    <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
    scopes: $this->getRenderHookScopes()) }}

    <script src="https://www.google.com/recaptcha/api.js?render={{ $recaptchaSiteKey }}"></script>

    <script>
    function initializeRecaptcha() {
        grecaptcha.ready(function () {
            const refreshToken = () => {
                grecaptcha.execute('{{ $recaptchaSiteKey }}', {action: 'auth'}).then(function (token) {
                    @this.set('recaptchaToken', token);
                });
            }
            refreshToken();
        });
    }

    initializeRecaptcha();
    </script>
</x-filament-panels::page.simple>