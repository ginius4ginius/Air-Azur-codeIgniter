<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
	function css_url($nom)
	{
		return base_url() . 'assets/css/' . $nom . '.css';
	}
}

if ( ! function_exists('css_boot_url'))
{
	function css_boot_url($nom)
	{
		return base_url() . 'assets/css/bootstrap-3.3.7-dist/css/' . $nom . '.css';
	}
}

if ( ! function_exists('css_js_url'))
{
	function css_js_url($nom)
	{
		return base_url() . 'assets/css/bootstrap-3.3.7-dist/js/' . $nom . '.js';
	}
}

if ( ! function_exists('js_url'))
{
	function js_url($nom)
	{
		return base_url() . 'assets/js/' . $nom . '.js';
	}
}

if ( ! function_exists('img_url'))
{
	function img_url($nom)
	{
		return base_url() . 'assets/img/' . $nom;
	}
}

if ( ! function_exists('img'))
{
	function img($nom, $alt = '')
	{
		return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
	}
}
