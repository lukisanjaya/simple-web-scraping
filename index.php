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
$content = str_replace('<h3>Related posts:</h3>', '', $content);
$content = str_replace($html->find('div[style=border: 0pt none ; margin: 0pt; padding: 0pt;]', 0)->outertext, '', $content);
$publishDate = $html->find('meta[property=article:published_time]', 0)->content;

foreach ($html->find('a[rel=category tag]') as $val) :
	$category[] = strtolower($val->plaintext);
endforeach;

$data = [
	'link'       => $html->find('link[rel=canonical]', 0)->href,
	'publish_at' => date("Y-m-d", strtotime($publishDate)),
	'title'      => $html->find('h1', 0)->plaintext,
	'img'        => $html->find('img.size-full', 0)->src,
	'content'    => $content,
	'author'	 => $html->find('div.blog-meta a[title]', 0)->plaintext,
	'category'	 => $category,

];
// innertext

// $content = str_replace(search, replace, subject)
var_dump($data);
// var_dump($html->find('div[style=border: 0pt none ; margin: 0pt; padding: 0pt;]', 0)->outertext);
