import sys
import face_recognition
import os

# Image from PHP
test_image = sys.argv[1]

# Known faces folder
KNOWN_DIR = "faces"

known_encodings = []
known_names = []

# Load known faces
for file in os.listdir(KNOWN_DIR):

    if file.endswith(".jpg") or file.endswith(".png"):

        img = face_recognition.load_image_file(KNOWN_DIR+"/"+file)

        enc = face_recognition.face_encodings(img)

        if len(enc) > 0:
            known_encodings.append(enc[0])
            name = file.split(".")[0]
            known_names.append(name)


# Load test image
unknown = face_recognition.load_image_file(test_image)
unknown_enc = face_recognition.face_encodings(unknown)

if len(unknown_enc) == 0:
    print("Unknown")
    exit()

# Compare
for face in unknown_enc:

    result = face_recognition.compare_faces(known_encodings, face)

    if True in result:

        index = result.index(True)
        print(known_names[index])
        exit()

print("Unknown")
