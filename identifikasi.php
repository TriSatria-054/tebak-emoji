<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .emoji {
            font-size: 2rem; /* Adjust the size of emojis here */
        }
        .form-group label {
            font-weight: bold;
        }
        .advanced-mode {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tebak Karakter Anime dari Emoji</h1>
        
        <form action="ai.php" method="post">
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    <option value="anime" selected>Anime</option>
                    <option value="manga">Manga</option>
                    <option value="game">Game</option>
                    <option value="movie">Movie</option>
                    <option value="book">Book</option>
                </select>
            </div>

            <button type="button" id="advanced-btn" class="btn btn-primary mb-3">Advanced Mode</button>
        
            <div id="advanced-fields" class="advanced-mode">
                <div class="form-group">
                    <label for="creator">Creator</label>
                    <input type="text" id="creator" name="creator" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah Quiz</label>
                    <input type="text" id="jumlah" name="jumlah" class="form-control" value="1">
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" id="genre" name="genre" class="form-control">
                </div>
            </div>

            <input type="hidden" id="mode" name="mode" value="0">
            <br>
            <button type="submit" class="btn btn-success">Generate</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('advanced-btn').addEventListener('click', function() {
            const advancedFields = document.getElementById('advanced-fields');
            const modeInput = document.getElementById('mode');

            if (advancedFields.style.display === 'none' || advancedFields.style.display === '') {
                advancedFields.style.display = 'block';
                this.textContent = 'Basic Mode'; // Change button text to "Basic Mode"
                modeInput.value = '1'; // Set hidden input value to 1 for Advanced Mode
            } else {
                advancedFields.style.display = 'none';
                this.textContent = 'Advanced Mode'; // Change button text back to "Advanced Mode"
                modeInput.value = '0'; // Set hidden input value to 0 for Basic Mode
            }
        });
    </script>
</body>
</html>
