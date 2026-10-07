#!/usr/bin/env python3
"""Render checks for the AIO rewrite: FAQ/FAQPage parity, Organization schema, /llms.txt, dashes.

Usage: python3 check_local.py [base_url]   (default http://localhost:8080; use https://amatec.in for live)
"""
import json, re, sys, urllib.request
BASE = sys.argv[1] if len(sys.argv) > 1 else 'http://localhost:8080'
def get(p):
    r = urllib.request.urlopen(urllib.request.Request(BASE + p, headers={'User-Agent': 'Mozilla/5.0 amatec-check'}))
    return r.status, r.headers.get('Content-Type'), r.read().decode('utf-8')
def ld(html):
    return [json.loads(b) for b in re.findall(r'<script type="application/ld\+json">(.*?)</script>', html, re.S)]
ok = True
pages = ['/', '/make-com-automation/', '/n8n-workflow-automation/', '/monday-com-workflow-automation/',
         '/zoho-workflow-automation/', '/ai-powered-task-automation/', '/t-chat-zoho-extension/',
         '/stock-procurement-for-zoho-inventory/', '/workflow-automation/']
for p in pages:
    _, _, h = get(p)
    faq = [d for d in ld(h) if d.get('@type') == 'FAQPage']
    visible = h.count('class="lp-faq-item')
    n = len(faq[0]['mainEntity']) if faq else 0
    good = len(faq) == 1 and n == visible and n > 0
    ok &= good
    print(f'{p:42} FAQPage blocks={len(faq)} questions={n} visible={visible} {"yes" if good else "NO"}')
_, _, h = get('/')
org = [d for d in ld(h) if 'Organization' in (d.get('@type') or [])]
print('home "What Amatec does":', h.count('What Amatec does'), '| Org valid:', 'yes' if len(org) == 1 else 'NO')
for p in ['/about/', '/contact/', '/make-com-automation/']:
    _, _, h = get(p)
    print(f'Org on {p}:', sum('Organization' in (d.get("@type") or []) for d in ld(h)))
s, ct, body = get('/llms.txt')
print('llms.txt:', s, ct, len(body), 'chars')
# visible-text dash check across rendered pages (strip scripts/styles/tags)
for p in pages + ['/about/', '/contact/', '/blog/', '/crm-automation/', '/it-company/', '/hr-operations-automation/']:
    _, _, h = get(p)
    text = re.sub(r'<(script|style)[^>]*>.*?</\1>', '', h, flags=re.S)
    text = re.sub(r'<[^>]+>', ' ', text)
    hits = [m for m in re.findall(r'.{0,40}[—–].{0,40}', text)]
    if hits:
        print(f'DASH {p}:', len(hits), '|', hits[0].strip())
sys.exit(0 if ok else 1)
