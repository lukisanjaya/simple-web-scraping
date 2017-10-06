<?php

require __DIR__ . '/vendor/autoload.php';

use PHPHtmlParser\Dom;
use Sunra\PhpSimple\HtmlDomParser;

// buat objek dari class Dom (instansiasi)
$dom  = new Dom;
$url  = $dom->loadFromUrl('http://blog.mitschool.co.id/belajar-ionic-framework/');
$html = $url->outerHtml;
$html = HtmlDomParser::str_get_html($html);

$content = $html->find('div.single-blog-content', 0)->innertext;
$publishDate = $html->find('meta[property=article:published_time]', 0)->content;

foreach ($html->find('a[rel=category tag]') as $val) :
	$category[] = strtolower($val->plaintext);
endforeach;

$data = [
	'publish_at' => date("Y-m-d", strtotime($publishDate)),
	'title'      => $html->find('h1', 0)->plaintext,
	'img'        => $html->find('img.size-full', 0)->src,
	'content'    => $content,
	'author'	 => $html->find('div.blog-meta a[title]', 0)->plaintext,
	'category'	 => $category,

];

var_dump($data);
