import openai

openai.api_key = "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"

response = openai.Image.create(
    prompt="a white siamese cat",
    n=1,
    size="1024x1024"
)

image_url = response['data'][0]['url']

html_content = f"""
<!DOCTYPE html>
<html>
<head>
    <title>Bildanzeige</title>
</head>
<body>
    <h1>Generiertes Bild</h1>
    <img src="{image_url}" alt="Generiertes Bild">
</body>
</html>
"""

with open("image.html", "w") as f:
    f.write(html_content)
