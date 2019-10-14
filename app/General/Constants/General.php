<?php

/**
 * page size
 */
const g_PAGECOUNT = 20;

/**
 * Upper limit on the textbox fields
 */
const g_EMAIL_MAX_LENGTH = 32;
const g_FIRST_NAME_MAX_LENGTH = 250;
const g_LAST_NAME_MAX_LENGTH = 250;
const g_PASSWORD_MAX_LENGTH = 18;
const g_PASSWORD_MIN_LENGTH = 6;

/**
 * Get last page url
 * */
define('REFERER_URL', isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '');	//上一页地址


/**
 * Cookie值
 */
const g_COOKIE_TIMEZONE = 'timezone';

/**
 * 产品图片尺寸
 */
const ProductImageSize1 = '64x64';
const ProductImageSize2 = '120x120';
const ProductImageSize3 = '350x350';
const ProductImageSize4 = '600x600';
const ProductImageSize5 = '950x950';

