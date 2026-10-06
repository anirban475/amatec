<?php
// Test harness: php test_render.php <theme_dir>. Stubs the few WordPress functions the AIO parts use.
define('ABSPATH',1);
function __($s,$d=null){return $s;} function esc_html_e($s,$d=null){echo htmlspecialchars($s,ENT_QUOTES);} function esc_html($s){return htmlspecialchars($s,ENT_QUOTES);}
function esc_attr($s){return htmlspecialchars($s,ENT_QUOTES);} function wp_json_encode($d,$f=0){return json_encode($d,$f);}
function add_action(){} function home_url($p=''){return 'https://amatec.in'.$p;} function get_theme_file_uri($p){return 'https://amatec.in/wp-content/themes/amatec/'.$p;}
function is_front_page(){return true;} function is_page($x=null){return false;}
$T=$argv[1];
require "$T/inc/aio.php";
foreach (['home'=>amatec_home_faqs()] + array_combine(['make','n8n','monday','zoho','ai','tchat','stock'], array_map('amatec_platform_faqs',['make','n8n','monday','zoho','ai','tchat','stock'])) as $k=>$f) { echo "$k: ".count($f)." faqs\n"; if(!$f) exit("EMPTY $k\n"); }
ob_start(); $args=['data'=>['faqs'=>amatec_home_faqs()]]; include "$T/template-parts/landing/faq.php"; $h=ob_get_clean();
preg_match('#<script type="application/ld\+json">(.*?)</script>#s',$h,$m); $j=json_decode($m[1],true); echo "FAQPage valid: ".($j['@type']==='FAQPage' && count($j['mainEntity'])===7 ? 'yes':'NO')."\n";
ob_start(); include "$T/template-parts/home/summary.php"; $s=ob_get_clean(); echo "summary chars: ".strlen(strip_tags($s))."\n";
ob_start(); amatec_org_schema(); $o=ob_get_clean(); preg_match('#>(.*)</script>#s',$o,$m); $j=json_decode($m[1],true); echo "Org valid: ".($j['name']==='Amatec'?'yes':'NO')."\n";
