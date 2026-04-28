from rembg import remove
from PIL import Image, ImageOps
import sys

input_path = sys.argv[1]
output_path = sys.argv[2]
size_type = sys.argv[3]

img = Image.open(input_path).convert("RGBA")

cut = remove(img)

bg = Image.new("RGBA", cut.size, (30, 90, 200, 255))

bg.paste(cut, (0, 0), cut)

if size_type == "3x4":
    target_size = (300, 400)
else:
    target_size = (400, 600)

final = ImageOps.fit(
    bg.convert("RGB"),
    target_size,
    method=Image.Resampling.LANCZOS
)

final.save(output_path, "JPEG", quality=95)

print("done")
