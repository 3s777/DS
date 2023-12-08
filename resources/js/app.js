import './bootstrap';
import.meta.glob([
    '../images/**',
    '../fonts/**'
]);

import '../blocks/ui/input-text/input-text';
import '../blocks/ui/textarea/textarea';
import '../blocks/ui/tabs/tabs';
import '../blocks/ui/tooltip/tooltip';

Fancybox.bind("[data-fancybox]", {
    // Your custom options
});

