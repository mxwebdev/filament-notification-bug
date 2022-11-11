import './bootstrap';

import '@nextapps-be/livewire-sortablejs';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import AlpineFloatingUI from '@awcodes/alpine-floating-ui';
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm';

Alpine.plugin(AlpineFloatingUI)
Alpine.plugin(NotificationsAlpinePlugin)

window.Alpine = Alpine;

Alpine.plugin(collapse);
Alpine.start();
