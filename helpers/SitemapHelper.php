<?php 

namespace app\helpers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class SitemapHelper
{

	public static function to($loc, $timestamp, $changefreq, $priority)
	{
		if (empty($timestamp)) {
			$timestamp = time();
		}

		$xml = "<url>
				<loc>".$loc."</loc>
				<lastmod>" .date('Y-m-d', $timestamp). "T" .date('h:i:s', $timestamp). "+03:00</lastmod>
				<changefreq>".$changefreq."</changefreq>
				<priority>".$priority."</priority>
			</url>";

		// $lastmod = date('Y-m-d', $timestamp). "T" .date('h:i:s', $timestamp). "+03:00";
		// $xml = array(
		// 	'url' => array(
		// 			'loc' => $loc,
		// 			'lastmod' => $lastmod,
		// 			'changefreq' => $changefreq,
		// 			'priority' => $priority
		// 		)
		// 	);

		return $xml;
	}

	public static function getSitemap($url = null)
	{
		$sitemap = array();

		if (!empty($url) && is_array($url)) {
			$timestamp = time();

	        if (!empty($url['index'])) {
	            foreach ($url['index'] as $key => $value) {
	                $sitemap[] = SitemapHelper::to($key, $value, 'weekly', 0.9);
	            }
	        }

	        if (!empty($url['page'])) {
	            foreach ($url['page'] as $key => $value) {
	                $sitemap[] = SitemapHelper::to($key, $value, 'weekly', 0.7);
	            }
	        }

	        if (!empty($url['category'])) {
	            foreach ($url['category'] as $key => $value) {
	                $sitemap[] = SitemapHelper::to($key, $value, 'weekly', 0.5);
	            }
	        }

	        if (!empty($url['service'])) {
	            foreach ($url['service'] as $key => $value) {
	                $sitemap[] = SitemapHelper::to($key, $value, 'weekly', 0.5);
	            }
	        }
		}
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . implode('', $sitemap) . '</urlset>';
		return $sitemap;
	}

}




?>