<?php

namespace Sober\Bundle;

use Sober\Bundle\Loader;

/**
 * Hook
 */
add_action('after_setup_theme', function () {
    new Loader();
});
