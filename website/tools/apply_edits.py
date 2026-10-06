#!/usr/bin/env python3
"""
Apply the Amatec copy and AIO edits to a copy of the theme.

Usage:
    python3 apply_edits.py <theme_dir> [--skip ID,ID,...] [--dry-run]

<theme_dir> is the folder that contains functions.php (the `amatec` theme).
Every `find` string must match exactly once (or at least once for all=True
edits); otherwise nothing is written and the script exits with an error.
New files in tools/new-files/ are copied into the theme at the same paths.
"""
import os
import shutil
import sys

HERE = os.path.dirname(os.path.abspath(__file__))
sys.path.insert(0, HERE)
from edits import EDITS  # noqa: E402

NEW_FILES = os.path.join(HERE, "new-files")


def main():
    if len(sys.argv) < 2:
        sys.exit(__doc__)
    theme = os.path.abspath(sys.argv[1])
    if not os.path.isfile(os.path.join(theme, "functions.php")):
        sys.exit(f"Not a theme folder (no functions.php): {theme}")
    skip = set()
    if "--skip" in sys.argv:
        skip = set(sys.argv[sys.argv.index("--skip") + 1].split(","))
    dry = "--dry-run" in sys.argv

    buffers, errors, applied = {}, [], []
    for ed in EDITS:
        if ed["id"] in skip:
            continue
        path = os.path.join(theme, ed["file"])
        if path not in buffers:
            if not os.path.isfile(path):
                errors.append(f"{ed['id']}: file missing {ed['file']}")
                continue
            with open(path, encoding="utf-8") as fh:
                buffers[path] = fh.read()
        text = buffers[path]
        n = text.count(ed["find"])
        if ed["all"] and n < 1 or not ed["all"] and n != 1:
            errors.append(f"{ed['id']}: expected {'>=1' if ed['all'] else '1'} match in {ed['file']}, found {n}")
            continue
        if ed["find"] == ed["replace"]:
            applied.append(f"{ed['id']} (check only)")
            continue
        buffers[path] = text.replace(ed["find"], ed["replace"]) if ed["all"] else text.replace(ed["find"], ed["replace"], 1)
        applied.append(ed["id"])

    if errors:
        print("NOTHING WRITTEN. Fix these first:")
        print("\n".join("  " + e for e in errors))
        sys.exit(1)

    if dry:
        print(f"Dry run OK: {len(applied)} edits would apply.")
        return

    for path, text in buffers.items():
        with open(path, "w", encoding="utf-8") as fh:
            fh.write(text)

    copied = []
    for root, _, files in os.walk(NEW_FILES):
        for name in files:
            src = os.path.join(root, name)
            rel = os.path.relpath(src, NEW_FILES)
            dst = os.path.join(theme, rel)
            os.makedirs(os.path.dirname(dst), exist_ok=True)
            shutil.copyfile(src, dst)
            copied.append(rel)

    print(f"Applied {len(applied)} edits: {', '.join(applied)}")
    print(f"Copied {len(copied)} new files: {', '.join(sorted(copied))}")


if __name__ == "__main__":
    main()
