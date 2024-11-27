<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Picture Upload</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }

      .form-container {
        text-align: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 300px;
      }

      .file-label {
        display: block;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
      }

      input[type="file"] {
        display: block;
        margin: 10px auto;
        padding: 5px;
        font-size: 14px;
      }

      .preview-container {
        margin-top: 20px;
        border: 2px dashed #d3d3d3;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
      }

      .preview-container img {
        display: block;
        margin: 0 auto;
        border-radius: 50%;
        border: 2px solid #ddd;
      }

      .preview-placeholder {
        color: #888;
        font-size: 14px;
      }
    </style>
  </head>
  <body>
    <div class="form-container">
      <form>
        <label for="profilePic" class="file-label"
          >Upload Profile Picture</label
        >
        <input type="file" id="profilePic" accept="image/*" />
      </form>
      <div id="profile-pic-preview" class="preview-container">
        <p class="preview-placeholder">No image selected</p>
      </div>
    </div>
    <script>
      document
        .getElementById("profilePic")
        .addEventListener("change", function (e) {
          const file = e.target.files[0];
          const previewContainer = document.getElementById(
            "profile-pic-preview"
          );
          previewContainer.innerHTML = ""; // Clear previous preview or placeholder

          if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
              const img = document.createElement("img");
              img.src = e.target.result;
              img.alt = "Profile Preview";
              img.style.width = "100px";
              img.style.height = "100px";
              previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
          } else {
            // If no file is selected, display a placeholder text
            const placeholder = document.createElement("p");
            placeholder.className = "preview-placeholder";
            placeholder.textContent = "No image selected";
            previewContainer.appendChild(placeholder);
          }
        });
    </script>
  </body>
</html>