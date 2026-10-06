<?php
// Prints every landing page entry from inc/lp-pages.php as readable text: php dump_lp.php <theme_dir>/inc/lp-pages.php
define('ABSPATH',1);
require $argv[1];
$p = amatec_lp_pages();
foreach ($p as $slug=>$d) {
  echo "\n######## $slug\n";
  echo "eyebrow: {$d['eyebrow']}\n";
  $h=$d['hero']; echo "HERO: {$h['lead']} [{$h['accent']}] ".($h['tail']??'')."\nintro: {$h['intro']}\noutcome: {$h['outcome']}\n";
  echo "card: ".implode(' | ', array_map(fn($i)=>"{$i['label']}/{$i['sub']}/{$i['tag']}", $h['card']['items']))."\n";
  foreach (['benefits','automate','delivery','why'] as $k) { if(!isset($d[$k])) continue; $x=$d[$k];
    echo strtoupper($k).": ".($x['eyebrow']??'')." | ".($x['title']??'')." | ".($x['sub']??'')."\n";
    foreach (($x['items']??[]) as $it) echo "  - ".(is_array($it)? (($it['t']??'').': '.($it['d']??'')) : $it)."\n";
    foreach ($x as $kk=>$vv) if(!in_array($kk,['eyebrow','title','sub','items'])) echo "  [$kk] ".json_encode($vv, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)."\n";
  }
  echo "STACK: {$d['stack']['text']} | ".implode(', ',$d['stack']['chips'])."\n";
  if(isset($d['quote'])) echo "QUOTE: ".json_encode($d['quote'],JSON_UNESCAPED_UNICODE)."\n";
  if(isset($d['testimonial'])) echo "TESTI: ".json_encode($d['testimonial'],JSON_UNESCAPED_UNICODE)."\n";
  foreach ($d['faqs'] as $f) echo "  Q: {$f['q']}\n     A: {$f['a']}\n";
  echo "CTA: ".json_encode($d['cta'],JSON_UNESCAPED_UNICODE)."\nMETA: ".json_encode($d['meta'],JSON_UNESCAPED_UNICODE)."\n";
}
