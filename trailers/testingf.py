from moviepy.editor import VideoFileClip
import os

def trim_trailer_if_large(video_path):
    # Check the original file size
    original_size = os.path.getsize(video_path) / (1024 * 1024)  # Convert to MB

    # Load the video
    video = VideoFileClip(video_path)
    
    # Calculate the new size threshold
    new_size_threshold = original_size + 10  # Increase by 10 MB

    # Trim the video by 1/5 of its duration
    duration = video.duration
    trim_duration = duration / 5
    new_video = video.subclip(0, duration - trim_duration)

    # Write the new video to a file
    trimmed_video_path = "trimmed_" + os.path.basename(video_path)
    new_video.write_videofile(trimmed_video_path, codec="libx264")

    # Check the new file size
    new_size = os.path.getsize(trimmed_video_path) / (1024 * 1024)  # Convert to MB

    if new_size > new_size_threshold:
        print(f"The trimmed video size ({new_size:.2f} MB) exceeds the threshold of {new_size_threshold:.2f} MB.")
        return trimmed_video_path
    else:
        print(f"The trimmed video size ({new_size:.2f} MB) is within the acceptable limit.")
        return trimmed_video_path

if __name__ == "__main__":
    video_file_path = "your_trailer.mp4"  # Replace with your video file path
    result_file = trim_trailer_if_large(video_file_path)
    print(f"Processed video saved as: {result_file}")