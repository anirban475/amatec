#!/usr/bin/env python3
"""Write the 420 px logo copies the theme serves through srcset.

The bundled logos are 1200x480 but show at 42 px (header) and 54 px
(footer) tall, so a 420x168 copy covers screens up to 3x and is a third
of the bytes. Resampled with premultiplied alpha so the edges stay clean.

Usage:  python3 build_logos.py <theme-dir>      (needs Pillow)
"""
import os
import sys

from PIL import Image

if len(sys.argv) != 2:
    sys.exit(__doc__)
img = os.path.join(sys.argv[1], 'assets', 'img')
for name in ('amatec-logo-full', 'amatec-logo-full-white'):
    src = Image.open(os.path.join(img, name + '.png')).convert('RGBA')
    small = src.convert('RGBa').resize((420, 168), Image.LANCZOS).convert('RGBA')
    out = os.path.join(img, name + '-420.png')
    small.save(out, optimize=True)
    print('%s %d bytes' % (out, os.path.getsize(out)))
