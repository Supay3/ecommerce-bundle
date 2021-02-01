<?php


namespace App\Controller;


class RouteName
{
    // Routes for homepage
    public const HOME = 'home';

    // Route for administration dashboard
    public const ADMIN_INDEX = 'admin_index';

    // Routes for administration products
    public const ADMIN_PRODUCT_INDEX = 'admin_product_index';
    public const ADMIN_PRODUCT_NEW = 'admin_product_new';
    public const ADMIN_PRODUCT_SHOW = 'admin_product_show';
    public const ADMIN_PRODUCT_EDIT = 'admin_product_edit';
    public const ADMIN_PRODUCT_DELETE = 'admin_product_delete';

    // Routes for administration product options
    public const ADMIN_PRODUCT_OPTION_INDEX = 'admin_product_option_index';
    public const ADMIN_PRODUCT_OPTION_NEW = 'admin_product_option_new';
    public const ADMIN_PRODUCT_OPTION_SHOW = 'admin_product_option_show';
    public const ADMIN_PRODUCT_OPTION_EDIT = 'admin_product_option_edit';
    public const ADMIN_PRODUCT_OPTION_DELETE = 'admin_product_option_delete';

    // Routes for administration product attribute
    public const ADMIN_PRODUCT_ATTRIBUTE_INDEX = 'admin_product_attribute_index';
    public const ADMIN_PRODUCT_ATTRIBUTE_NEW = 'admin_product_attribute_new';
    public const ADMIN_PRODUCT_ATTRIBUTE_SHOW = 'admin_product_attribute_show';
    public const ADMIN_PRODUCT_ATTRIBUTE_EDIT = 'admin_product_attribute_edit';
    public const ADMIN_PRODUCT_ATTRIBUTE_DELETE = 'admin_product_attribute_delete';
}