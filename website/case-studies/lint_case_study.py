#!/usr/bin/env python3
"""Lint a case study JSON against WRITING-RULES.md. Prints OK or a list of problems.

Usage: python3 lint_case_study.py <file.json> [<file.json> ...]
"""
import json
import re
import sys

PLATFORMS = {'make', 'n8n', 'zoho', 'monday', 'ai'}
INDUSTRIES = {'Ecommerce', 'Logistics and distribution', 'Web hosting', 'Recruitment', 'Real estate',
              'Marketing agencies', 'Food production', 'Retail and trading', 'Accounting and finance',
              'Property management', 'Sales teams', 'SaaS', 'Customer support'}
BANNED = ['delve', 'underscore', 'foster', 'enhance', 'leverage', 'utilise', 'utilize', 'spearhead', 'embark',
          'pivotal', 'crucial', 'intricate', 'seamless', 'robust', 'vibrant', 'tapestry', 'landscape', 'realm',
          'testament', 'journey', 'ecosystem', 'game changer', 'game-changer', 'paradigm shift', 'overall',
          'in summary', 'in conclusion', 'streamline', 'boost', 'cutting-edge', 'cutting edge', 'unlock',
          'empower', 'revolutionise', 'revolutionize', 'supercharge']
SHAPES = [r'\bnot just\b', r'\bnot only\b', r"\bit'?s not\b[^.]*,\s*it'?s\b", r'\bstudies show\b']
SECRETS = [r'[\w.+-]+@[\w-]+\.[\w.]+', r'https?://', r'\bBearer\b', r'secret_', r'shpat_', r'encapiKey',
           r'\+\d[\d\s]{7,}', r'\b\d{9,}\b']
REQUIRED = ['slug', 'title', 'excerpt', 'client_name', 'client_desc', 'country', 'year', 'headline_result',
            'results', 'tools', 'platforms', 'industry', 'seo_title', 'seo_description', 'body_html', 'faqs', 'sources']


def text_of(d):
    parts = [d.get(k, '') for k in ('title', 'excerpt', 'client_desc', 'headline_result', 'seo_title', 'seo_description')]
    parts += d.get('results', []) + d.get('tools', [])
    parts.append(re.sub(r'<[^>]+>', ' ', d.get('body_html', '')))
    for f in d.get('faqs', []):
        parts += [f.get('q', ''), f.get('a', '')]
    return '\n'.join(str(p) for p in parts)


def lint(path):
    probs = []
    try:
        d = json.load(open(path, encoding='utf-8'))
    except Exception as e:  # noqa: BLE001
        return [f'invalid JSON: {e}']
    for k in REQUIRED:
        if k not in d:
            probs.append(f'missing field: {k}')
    if probs:
        return probs
    txt = text_of(d)
    if re.search('[—–]', txt):
        for m in re.finditer(r'.{0,30}[—–].{0,30}', txt):
            probs.append(f'dash: ...{m.group(0)}...')
    low = txt.lower()
    for w in BANNED:
        if re.search(r'\b' + re.escape(w), low):
            probs.append(f'banned word: {w}')
    for s in SHAPES:
        if re.search(s, low):
            probs.append(f'banned shape: {s}')
    for s in SECRETS:
        for m in re.finditer(s, txt):
            probs.append(f'possible secret/contact/ID: {m.group(0)[:40]}')
    n = len(d['excerpt'].split())
    if not 40 <= n <= 60:
        probs.append(f'excerpt is {n} words (40 to 60)')
    body_words = len(re.sub(r'<[^>]+>', ' ', d['body_html']).split())
    if not 600 <= body_words <= 900:
        probs.append(f'body is {body_words} words (600 to 900)')
    h2 = re.findall(r'<h2[^>]*>(.*?)</h2>', d['body_html'])
    if h2 != ['The challenge', 'What we built', 'The results']:
        probs.append(f'H2s must be exactly The challenge / What we built / The results, got {h2}')
    if not set(d['platforms']) or not set(d['platforms']) <= PLATFORMS:
        probs.append(f'platforms must be from {sorted(PLATFORMS)}')
    if d['industry'] not in INDUSTRIES:
        probs.append(f'industry not in list: {d["industry"]}')
    if len(d['title']) > 80:
        probs.append('title over 80 chars')
    if len(d['seo_title']) > 60 or not d['seo_title'].endswith(' | Amatec'):
        probs.append('seo_title must be <= 60 chars and end with " | Amatec"')
    if not 120 <= len(d['seo_description']) <= 165:
        probs.append(f'seo_description is {len(d["seo_description"])} chars (140 to 160)')
    if len(d['headline_result']) > 40:
        probs.append('headline_result over 40 chars')
    if not 3 <= len(d['results']) <= 5:
        probs.append('results must have 3 to 5 items')
    if not 3 <= len(d['faqs']) <= 5:
        probs.append('faqs must have 3 to 5 items')
    if 'AMATEC' in txt:
        probs.append('use "Amatec", not "AMATEC"')
    return probs


if __name__ == '__main__':
    bad = False
    for p in sys.argv[1:]:
        probs = lint(p)
        if probs:
            bad = True
            print(f'{p}:')
            for x in probs:
                print('  - ' + x)
    if not bad:
        print('OK')
    sys.exit(1 if bad else 0)
