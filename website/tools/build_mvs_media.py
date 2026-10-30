#!/usr/bin/env python3
"""Build the Multi Vendor SKU page media from the originals in mvs-media/source/.

For each slot name used by amatec_mvs_media() in the theme:
  still  source/{name}-still.png or source/{name}.png
         -> {name}.webp at full width, plus {name}-1000w.webp and {name}-800w.webp
            when the original is wider (never upscaled). WebP quality 92.
  video  source/{name}.gif
         -> {name}.mp4 (H.264) and {name}.webm (VP9), 10 fps. The page loops them.

When a GIF and a still both exist, the video is cropped to the part of the GIF
that matches the still, so poster and video line up (the stills were cut from
the GIFs without Zoho's top bar). Also writes og-multi-vendor-sku.jpg
(1200x630 share image) from the 01-po-autofill still.

Output: amatec/assets/media/multi-vendor-sku/ (or argv[1]; sources argv[2]).
Re-run after adding originals.

Needs cwebp (brew install webp) and a Python with Pillow + imageio-ffmpeg:
  python3 -m venv .venv && .venv/bin/pip install pillow imageio-ffmpeg
  .venv/bin/python mvs-media/build_media.py
"""

import os
import subprocess
import sys

import imageio_ffmpeg
from PIL import Image, ImageChops, ImageDraw, ImageSequence, ImageStat

HERE = os.path.dirname(os.path.abspath(__file__))
# Optional args: [output dir] [source dir]; defaults fit the OneDrive project layout.
OUT = sys.argv[1] if len(sys.argv) > 1 else os.path.join(HERE, '..', 'amatec', 'assets', 'media', 'multi-vendor-sku')
SRC = sys.argv[2] if len(sys.argv) > 2 else os.path.join(HERE, 'source')
SLOTS = [
    '01-po-autofill', '02-setup-drop-files', '03-my-sku-list', '04-vendor-switch',
    '05-duplicate-block', '06-bill-paste-match', '07-price-change-card', '08-bill-check',
    '09-po-pdf-column', '10-search-import-export',
]
WIDTHS = (1000, 800)
WEBP = ['-quiet', '-q', '92', '-m', '6', '-sharp_yuv', '-mt', '-metadata', 'none']
FFMPEG = imageio_ffmpeg.get_ffmpeg_exe()


def run(cmd):
    subprocess.run(cmd, check=True)


def diff(a, b):
    return sum(ImageStat.Stat(ImageChops.difference(a, b)).mean) / 3


def find_crop(gif_path, still):
    """Offset (dx, dy) of the still inside the GIF, searched coarse then fine."""
    frames = [f.convert('RGB') for f in ImageSequence.Iterator(Image.open(gif_path))]
    gw, gh = frames[0].size
    sw, sh = still.size
    if (sw, sh) == (gw, gh):
        return 0, 0
    k = 8
    small = still.resize((sw // k, sh // k))
    best = None
    for i, fr in enumerate(frames):
        fs = fr.resize((gw // k, gh // k))
        for dy in range(0, (gh - sh) // k + 1):
            for dx in range(0, (gw - sw) // k + 1):
                d = diff(fs.crop((dx, dy, dx + small.width, dy + small.height)), small)
                if best is None or d < best[0]:
                    best = (d, i, dx * k, dy * k)
    _, i, cx, cy = best
    fine = None
    for dy in range(max(0, cy - k), min(gh - sh, cy + k) + 1):
        for dx in range(max(0, cx - k), min(gw - sw, cx + k) + 1):
            d = diff(frames[i].crop((dx, dy, dx + sw, dy + sh)), still)
            if fine is None or d < fine[0]:
                fine = (d, dx, dy)
    print(f'  crop offset {fine[1]},{fine[2]} (frame {i}, mean diff {fine[0]:.2f})')
    return fine[1], fine[2]


def build_still(name, path):
    with Image.open(path) as im:
        w = im.width
    run(['cwebp', *WEBP, path, '-o', os.path.join(OUT, f'{name}.webp')])
    for tw in WIDTHS:
        if tw < w:
            run(['cwebp', *WEBP, '-resize', str(tw), '0', path, '-o', os.path.join(OUT, f'{name}-{tw}w.webp')])


def build_video(name, gif, still_path):
    with Image.open(gif) as g:
        gw, gh = g.size
    if still_path:
        still = Image.open(still_path).convert('RGB')
        dx, dy = find_crop(gif, still)
        w, h = still.size
    else:
        dx, dy, w, h = 0, 0, gw, gh
    w, h = w - w % 2, h - h % 2
    vf = f'crop={w}:{h}:{dx}:{dy},fps=10,format=yuv420p'
    base = [FFMPEG, '-y', '-v', 'error', '-i', gif, '-vf', vf, '-an']
    run(base + ['-c:v', 'libx264', '-preset', 'slow', '-crf', '18', '-tune', 'stillimage',
                '-movflags', '+faststart', os.path.join(OUT, f'{name}.mp4')])
    run(base + ['-c:v', 'libvpx-vp9', '-crf', '24', '-b:v', '0', '-row-mt', '1',
                '-deadline', 'good', '-cpu-used', '1', os.path.join(OUT, f'{name}.webm')])


def build_og(still_path):
    """1200x630 share image: the screenshot on the brand navy."""
    canvas = Image.new('RGB', (1200, 630), (10, 44, 73))
    shot = Image.open(still_path).convert('RGB')
    tw = 1120
    shot = shot.resize((tw, round(shot.height * tw / shot.width)), Image.LANCZOS)
    mask = Image.new('L', shot.size, 0)
    ImageDraw.Draw(mask).rounded_rectangle((0, 0, shot.width, shot.height), radius=14, fill=255)
    canvas.paste(shot, ((1200 - shot.width) // 2, (630 - shot.height) // 2), mask)
    canvas.save(os.path.join(OUT, 'og-multi-vendor-sku.jpg'), quality=90, optimize=True, progressive=True)


def main():
    os.makedirs(OUT, exist_ok=True)
    for name in SLOTS:
        still = next((p for p in (os.path.join(SRC, f'{name}-still.png'), os.path.join(SRC, f'{name}.png'))
                      if os.path.isfile(p)), None)
        gif = os.path.join(SRC, f'{name}.gif')
        gif = gif if os.path.isfile(gif) else None
        if not still and not gif:
            print(f'{name}: no source yet, placeholder stays')
            continue
        print(f'{name}: still={bool(still)} video={bool(gif)}')
        if still:
            build_still(name, still)
        if gif:
            build_video(name, gif, still)
    og = os.path.join(SRC, '01-po-autofill.png')
    if os.path.isfile(og):
        build_og(og)
    for f in sorted(os.listdir(OUT)):
        print(f'{os.path.getsize(os.path.join(OUT, f)):>10,}  {f}')


if __name__ == '__main__':
    sys.exit(main())
