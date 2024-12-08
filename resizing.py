from PIL import Image
import os

# Specify the directory containing your files
directory = "./images"  # Replace with your directory path

# Load movie1.png to get its dimensions
reference_image_path = os.path.join(directory, "movie1.jpg")
try:
    with Image.open(reference_image_path) as ref_img:
        target_size = ref_img.size  # (width, height)
except FileNotFoundError:
    print("Error: 'movie1.jpg' not found in the specified directory.")
    exit()

# Process all .jpg files in the directory
for filename in os.listdir(directory):
    if filename.endswith(".jpg"):
        image_path = os.path.join(directory, filename)
        try:
            with Image.open(image_path) as img:
                # Resize the image to match movie1.png
                resized_img = img.resize(target_size, Image.Resampling.LANCZOS)
                
                # Save with the same filename
                resized_img.save(image_path)
                print(f"Resized and saved: {filename}")
        except Exception as e:
            print(f"Error processing {filename}: {e}")

print("All .jpg files have been resized.")
