<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movies Details</title>
    <link rel="stylesheet" href="CSS/Edit_details.css">
</head>
<body>

<!-- Back Button -->
<button class="back-button" onclick="document.location='Edit_movies.html'">Back to Edit</button>

<!-- Headline -->
<h1>Edit Movies Details</h1>

<!-- Form Layout -->
<div class="form-container">
    <!-- Cover Section -->
    <div class="cover-container">
        <label for="upload-cover" class="add-cover">
            <input type="file" id="upload-cover" accept="image/*" />
            Edit Cover
        </label>
        <img id="cover-preview" src="" alt="Cover Image" />

     <!-- Dropdown for Sections -->
     <label class="dropdown-title">Movie Sections</label>
     <div class="dropdown single-select">
         <div class="select">
             <span class="selected">Now Showing</span>
             <div class="caret"></div>
         </div>
         <ul class="menu">
             <li class="active">Now Showing</li>
             <li>Advanced Sales</li>
         </ul>
     </div>
 </div>

    <!-- Movie Form -->
    <div class="movie-form">
        <div class="form-group">
            <textarea placeholder="Edit Movie Title" rows="1"></textarea>
        </div>
        <div class="form-group">
            <textarea placeholder="Edit Cast" rows="2"></textarea>
        </div>
        <div class="form-group">
            <textarea placeholder="Edit Director" rows="1"></textarea>
        </div>
        <div class="form-group">
            <textarea placeholder="Edit Movie Rating" rows="1"></textarea>
        </div>
        <div class="form-group">
            <textarea placeholder="Edit Movie Genre" rows="1"></textarea>
        </div>
        <div class="form-group">
            <textarea placeholder="Edit Movie Language" rows="1"></textarea>
        </div>
        <div class="form-group">
            <textarea placeholder="Edit Movie Subtitles" rows="1"></textarea>
        </div>
        <div class="form-group">
            <textarea placeholder="Edit Movie Runtime (mins)" rows="1"></textarea>
        </div>
        <div class="form-group">
            <textarea placeholder="Edit Movie Synopsis" rows="5"></textarea>
        </div>
        <button class="add-button">Update</button>
    </div>
</div>

<script>
    // Dropdown functionality
    document.querySelectorAll('.dropdown').forEach(dropdown => {
        const select = dropdown.querySelector('.select');
        const caret = dropdown.querySelector('.caret');
        const menu = dropdown.querySelector('.menu');
        const selected = dropdown.querySelector('.selected');

        select.addEventListener('click', () => {
            menu.classList.toggle('menu-open');
            caret.classList.toggle('caret-rotate');
        });

        menu.querySelectorAll('li').forEach(option => {
            option.addEventListener('click', () => {
                if (dropdown.classList.contains('single-select')) {
                    selected.textContent = option.textContent;
                    menu.querySelectorAll('li').forEach(opt => opt.classList.remove('active'));
                    option.classList.add('active');
                } else if (dropdown.classList.contains('multi-select')) {
                    const checkbox = option.querySelector('input[type="checkbox"]');
                    checkbox.checked = !checkbox.checked;

                    const selectedOptions = Array.from(menu.querySelectorAll('input:checked'))
                        .map(checkbox => checkbox.value);

                    selected.textContent = selectedOptions.length > 0 
                        ? selectedOptions.join(', ') 
                        : 'Select Theaters';
                }
            });
        });
    });
</script>

<script>
    // Cover preview functionality
    const fileInput = document.getElementById('upload-cover');
    const preview = document.getElementById('cover-preview');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>

</body>
</html>