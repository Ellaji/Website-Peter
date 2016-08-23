# To run this script, PIL or Pillow should be installed
# Also jpeg and png decoders (libraries) should be installed with PIl or Pillow

import os
# Next is a parser for GETting command line OPTions
import getopt
import sys
from PIL import Image

# Parse the arguments
opts, args = getopt.getopt(sys.argv[1:], 'd:w:h:')

# Set 'empty' default values to the needed variables, so we can check passed arguments
directory = ''
width = -1
height = -1
 
# If an argument was passed in, assign it to the correct variable
for opt, arg in opts:
    if opt == '-d':
      directory = arg
    elif opt == '-w':
      width = int(arg)
    elif opt == '-h':
      height = int(arg)
 
# Check passed arguments
if width == -1 or height == -1 or directory == '':
    print('Invalid command line arguments. -d [directory] ' \
      '-w [width in px] -h [height in px] are required')
      # in my case: python BatchResizer.py -d /Users/Mirella/Desktop/Photos -w 405 -h 405
    # If an argument is missing exit the application.
    exit()

# Iterate through every image given in the directory argument and resize it
for image in os.listdir(directory):
  # Next line is to solve a hidden file bug
  if image == ".DS_Store":
    pass
  else:
    print('Resizing image ' + image)
    # Next line is to solve a hidden file bug
    if image == ".DS_Store":
      pass
    else:
      # Open the file 
      img = Image.open(os.path.join(directory, image))
      # Check whether file is landscape or portrait
      original_width, original_height = img.size
      if original_width > original_height: 
        # For landscape images
        baseWidth = width
        # Calculate the height using the same aspect ratio
        widthPercent = (baseWidth / float(img.size[0]))
        ratioHeight = int((float(img.size[1]) * float(widthPercent)))
        # Resize it.
        img = img.resize((baseWidth, ratioHeight), Image.BILINEAR)
        # Save it back to disk.
        img.save(os.path.join(directory, 'thumb-' + image))
      elif original_width < original_height:
        # For portrait images      
        baseHeight = height
        # Calculate the height using the same aspect ratio
        heightPercent = (baseHeight / float(img.size[1]))
        ratioWidth = int((float(img.size[0]) * float(heightPercent)))
        # Resize it.
        img = img.resize((ratioWidth, baseHeight), Image.BILINEAR) 
        # Save it back to disk.
        img.save(os.path.join(directory, 'thumb-' + image))
      else: # image must be square already then
        # Resize it.
        img = img.resize((width, height), Image.BILINEAR)
        # Save it back to disk.
        img.save(os.path.join(directory, 'thumb-' + image))
      
 
print('Batch processing complete.')
 

