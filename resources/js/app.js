import './bootstrap';
import * as Turbo from '@hotwired/turbo';

// Set delay progress bar Turbo ke 250ms agar lebih konsisten & tidak berkedip (flicker) saat internet cepat
Turbo.config.drive.progressBarDelay = 50;

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);

window.Alpine = Alpine;

Alpine.start();
