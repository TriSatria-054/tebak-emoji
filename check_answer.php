<?php 

$total_right = 0;
$total_wrong = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz Results</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .emoji {
            font-size: 5rem; /* Adjust the size of emojis here */
            text-align: center;
        }
        .result-item {
            margin-bottom: 1.5rem;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            background-color: #f8f9fa;
        }
        .btn-new {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tebak Karakter Anime dari Emoji</h1>
        
        <?php 
            $quiz = json_decode($_POST['quiz'], true);
        
            foreach($quiz as $index => $row){
                $quiz[$index]['answer'] = $_POST['answers'][$index];
            }
        ?>

        <?php foreach($quiz as $index => $row): ?>
            <?php 
            if ($row['title'] == $row['answer']) {
                $total_right++;
            } else {
                $total_wrong++;
            }
            ?>
            <div class="result-item">
                <p class="emoji"><?= htmlspecialchars($row['emoji']) ?></p>
                <p><strong>Your Answer:</strong> <?= htmlspecialchars($row['answer']) ?></p>
                <p><strong>Correct Answer:</strong> <?= htmlspecialchars($row['title']) ?></p>
            </div>
        <?php endforeach ?>
        
        <div class="text-center mt-4">
            <p><strong>Total Right:</strong> <?= $total_right ?></p>
            <p><strong>Total Wrong:</strong> <?= $total_wrong ?></p>
            <a href="identifikasi.php" class="btn btn-primary btn-new">Try Again</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
