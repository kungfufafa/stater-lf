<?php

namespace {
    use Illuminate\Support\HtmlString;

    if (! function_exists('shopper')) {
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

namespace Shopper\Facades {
    use Illuminate\Support\HtmlString;

    class Shopper
    {
        public static function getThemeLink()
        {
            return new HtmlString('');
        }
    }
}

namespace Shopper\View {
    class LayoutRenderHook
    {
        const CONTENT_START = 'CONTENT_START';

        const CONTENT_END = 'CONTENT_END';

        const HEAD_START = 'HEAD_START';

        const HEAD_END = 'HEAD_END';

        const BODY_START = 'BODY_START';

        const BODY_END = 'BODY_END';

        const HEADER_START = 'HEADER_START';

        const HEADER_END = 'HEADER_END';

        const DASHBOARD_START = 'DASHBOARD_START';

        const DASHBOARD_END = 'DASHBOARD_END';

        const ACCOUNT_START = 'ACCOUNT_START';

        const ACCOUNT_END = 'ACCOUNT_END';

        const SETTINGS_INDEX_START = 'SETTINGS_INDEX_START';

        const SETTINGS_INDEX_END = 'SETTINGS_INDEX_END';
    }
    class CatalogRenderHook
    {
        const REVIEWS_TABLE_BEFORE = 'REVIEWS_TABLE_BEFORE';

        const REVIEWS_TABLE_AFTER = 'REVIEWS_TABLE_AFTER';

        const TAGS_TABLE_BEFORE = 'TAGS_TABLE_BEFORE';

        const TAGS_TABLE_AFTER = 'TAGS_TABLE_AFTER';

        const ATTRIBUTES_TABLE_BEFORE = 'ATTRIBUTES_TABLE_BEFORE';

        const ATTRIBUTES_TABLE_AFTER = 'ATTRIBUTES_TABLE_AFTER';

        const BRANDS_TABLE_BEFORE = 'BRANDS_TABLE_BEFORE';

        const BRANDS_TABLE_AFTER = 'BRANDS_TABLE_AFTER';

        const CATEGORIES_TABLE_BEFORE = 'CATEGORIES_TABLE_BEFORE';

        const CATEGORIES_TABLE_AFTER = 'CATEGORIES_TABLE_AFTER';
    }
    class CollectionRenderHook
    {
        const INDEX_TABLE_BEFORE = 'INDEX_TABLE_BEFORE';

        const INDEX_TABLE_AFTER = 'INDEX_TABLE_AFTER';

        const EDIT_FORM_BEFORE = 'EDIT_FORM_BEFORE';

        const EDIT_FORM_AFTER = 'EDIT_FORM_AFTER';
    }
    class SalesRenderHook
    {
        const SUPPLIERS_TABLE_BEFORE = 'SUPPLIERS_TABLE_BEFORE';

        const SUPPLIERS_TABLE_AFTER = 'SUPPLIERS_TABLE_AFTER';

        const DISCOUNTS_TABLE_BEFORE = 'DISCOUNTS_TABLE_BEFORE';

        const DISCOUNTS_TABLE_AFTER = 'DISCOUNTS_TABLE_AFTER';
    }
    class OrderRenderHook
    {
        const INDEX_TABLE_BEFORE = 'INDEX_TABLE_BEFORE';

        const INDEX_TABLE_AFTER = 'INDEX_TABLE_AFTER';

        const SHIPMENTS_TABLE_BEFORE = 'SHIPMENTS_TABLE_BEFORE';

        const SHIPMENTS_TABLE_AFTER = 'SHIPMENTS_TABLE_AFTER';

        const ABANDONED_CARTS_TABLE_BEFORE = 'ABANDONED_CARTS_TABLE_BEFORE';

        const ABANDONED_CARTS_TABLE_AFTER = 'ABANDONED_CARTS_TABLE_AFTER';

        const DETAIL_HEADER_AFTER = 'DETAIL_HEADER_AFTER';

        const DETAIL_MAIN_BEFORE = 'DETAIL_MAIN_BEFORE';

        const DETAIL_MAIN_AFTER = 'DETAIL_MAIN_AFTER';

        const DETAIL_SIDEBAR_BEFORE = 'DETAIL_SIDEBAR_BEFORE';

        const DETAIL_SIDEBAR_AFTER = 'DETAIL_SIDEBAR_AFTER';
    }
    class ProductRenderHook
    {
        const INDEX_TABLE_BEFORE = 'INDEX_TABLE_BEFORE';

        const INDEX_TABLE_AFTER = 'INDEX_TABLE_AFTER';

        const VARIANT_HEADER_AFTER = 'VARIANT_HEADER_AFTER';

        const VARIANT_MAIN_AFTER = 'VARIANT_MAIN_AFTER';

        const VARIANT_SIDEBAR_AFTER = 'VARIANT_SIDEBAR_AFTER';

        const EDIT_HEADER_AFTER = 'EDIT_HEADER_AFTER';

        const EDIT_TABS_BEFORE = 'EDIT_TABS_BEFORE';

        const EDIT_TABS_END = 'EDIT_TABS_END';

        const EDIT_CONTENT_BEFORE = 'EDIT_CONTENT_BEFORE';

        const EDIT_CONTENT_AFTER = 'EDIT_CONTENT_AFTER';
    }
    class CustomerRenderHook
    {
        const SHOW_HEADER_AFTER = 'SHOW_HEADER_AFTER';

        const SHOW_TABS_BEFORE = 'SHOW_TABS_BEFORE';

        const SHOW_TABS_END = 'SHOW_TABS_END';

        const SHOW_CONTENT_BEFORE = 'SHOW_CONTENT_BEFORE';

        const SHOW_CONTENT_AFTER = 'SHOW_CONTENT_AFTER';
    }
}

namespace Shopper\Sidebar {
    class AdminSidebar {}
    if (! function_exists('\Shopper\Sidebar\sidebar_width')) {
        function sidebar_width()
        {
            return '16rem';
        }
    }
    if (! function_exists('\Shopper\Sidebar\sidebar_collapsed_width')) {
        function sidebar_collapsed_width()
        {
            return '4.5rem';
        }
    }
    if (! function_exists('\Shopper\Sidebar\sidebar_breakpoint')) {
        function sidebar_breakpoint()
        {
            return 'lg';
        }
    }
    if (! function_exists('\Shopper\Sidebar\sidebar_is_collapsible')) {
        function sidebar_is_collapsible()
        {
            return true;
        }
    }
}
