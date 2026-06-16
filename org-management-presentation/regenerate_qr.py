#!/usr/bin/env python3
"""
Regenerate the demo QR code for the PureBlooms presentation.

Usage:
    python3 regenerate_qr.py                          # reads APP_URL from .env
    python3 regenerate_qr.py https://xxxx.ngrok-free.app   # pass URL directly

Outputs:
    demo-qr.png       - standalone PNG (for printed handouts)
    qr_data_uri.txt   - base64 data URI (paste into slides.html)
"""
import sys
import os
import re

try:
    import qrcode
except ImportError:
    print("Installing qrcode...")
    os.system(f"{sys.executable} -m pip install --break-system-packages 'qrcode[pil]'")
    import qrcode


def get_ngrok_url():
    """Try to extract APP_URL from .env, fallback to arg or prompt."""
    if len(sys.argv) > 1:
        return sys.argv[1].rstrip("/")

    env_path = os.path.join(os.path.dirname(__file__), "..", ".env")
    if os.path.exists(env_path):
        with open(env_path) as f:
            for line in f:
                m = re.match(r"^APP_URL=(.+)$", line.strip())
                if m:
                    return m.group(1).strip().strip('"').rstrip("/")

    return input("Enter the ngrok URL (e.g. https://xxxx.ngrok-free.app): ").strip().rstrip("/")


def main():
    import io, base64

    url = get_ngrok_url()
    print(f"Generating QR for: {url}")

    qr = qrcode.QRCode(
        version=1, box_size=10, border=2,
        error_correction=qrcode.constants.ERROR_CORRECT_L,
    )
    qr.add_data(url)
    qr.make(fit=True)
    img = qr.make_image(fill_color="#0c1210", back_color="white")

    out_dir = os.path.dirname(os.path.abspath(__file__))
    png_path = os.path.join(out_dir, "demo-qr.png")
    img.save(png_path)
    print(f"Saved: {png_path}")

    # Also generate a smaller data-URI version for HTML embedding
    qr2 = qrcode.QRCode(
        version=1, box_size=8, border=1,
        error_correction=qrcode.constants.ERROR_CORRECT_L,
    )
    qr2.add_data(url)
    qr2.make(fit=True)
    img2 = qr2.make_image(fill_color="#0c1210", back_color="white")
    buf = io.BytesIO()
    img2.save(buf, format="PNG")
    data_uri = f"data:image/png;base64,{base64.b64encode(buf.getvalue()).decode()}"

    txt_path = os.path.join(out_dir, "qr_data_uri.txt")
    with open(txt_path, "w") as f:
        f.write(data_uri)
    print(f"Saved: {txt_path} ({len(data_uri)} chars)")
    print("\nDone. Copy qr_data_uri.txt content into slides.html QR <img src=\"...\">.")


if __name__ == "__main__":
    main()
