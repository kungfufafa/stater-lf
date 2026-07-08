<?php

namespace {
    use Illuminate\Support\HtmlString;

    if (! function_exists('shopper')) {
        /**
         * Access the custom admin panel helper instance.
         *
         * Provides the generic appshell surface used by the customized
         * Filament panel (brand logo, panel path prefix, version label).
         */
        function shopper()
        {
            return new class
            {
                public function getRenderHook($hook)
                {
                    return new HtmlString('');
                }

                public function prefix()
                {
                    return 'admin';
                }

                public function version()
                {
                    return 'v2';
                }

                public function getBrandLogo()
                {
                    return null;
                }
            };
        }
    }

    if (! function_exists('shopper_setting')) {
        function shopper_setting($key = null, $default = null, $withCache = true)
        {
            $settings = [
                'name' => config('app.name'),
                'email' => config('mail.from.address', 'admin@admin.com'),
            ];

            return $key === null ? $settings : data_get($settings, $key, $default);
        }
    }

    if (! function_exists('shopper_panel_assets')) {
        function shopper_panel_assets($asset)
        {
            return url('admin'.$asset);
        }
    }
}
