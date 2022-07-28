import './bootstrap';

import '@nextapps-be/livewire-sortablejs';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

window.Alpine = Alpine;

Alpine.plugin(collapse);
Alpine.start();
