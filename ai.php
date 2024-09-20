<?php

require __DIR__ . '/vendor/autoload.php'; // Make sure this path is correct

use Orhanerday\OpenAi\OpenAi;

$open_ai_key = 'your-api-key';
$open_ai = new OpenAi($open_ai_key);

$category = isset($_POST['category']) ? $_POST['category'] : '';
$creator = isset($_POST['creator']) ? $_POST['creator'] : '';
$jumlah = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 2;
$genre = isset($_POST['genre']) ? $_POST['genre'] : '';
$mode = isset($_POST['mode']) ? $_POST['mode'] : 0;

$quiz = [];

function generate($system_content, $user_content) {
    global $open_ai; // Ensure $open_ai is available here

    $chat = $open_ai->chat([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                "role" => "system",
                "content" => $system_content
            ],
            [
                "role" => "user",
                "content" => $user_content
            ]
        ],
        'temperature' => 1.0,
        'max_tokens' => 50,
        'frequency_penalty' => 0,
        'presence_penalty' => 0,
    ]);

    $response = json_decode($chat, true);
    return $response["choices"][0]["message"]["content"];
}

for ($i = 0; $i < $jumlah; $i++) {

    if ($mode == 0) {
        $response = generate(
            "1. Send only emojis as a hint for an $category. 2. After the emojis, provide the correct $category title, separated by a comma.",
            "1. kirim hanya emoji tidak boleh ada kata. petunjuk yang mewakili $category, pisahkan dengan koma. 2. berikan judul yg benar dari $category tersebut, pisahkan dengan koma."
        );


    } else if ($mode == 1) {
        $response = generate(
            "1. Send only emojis as a hint for an $category, creator is $creator, and genre is $genre. 2. After the emojis, provide the correct $category title, separated by a comma.",
            "1. kirim hanya emoji tidak boleh ada kata. petunjuk yang mewakili $category, pembuatnya $creator, dan genre $genre, pisahkan dengan koma. 2. berikan judul yg benar dari $category tersebut, pisahkan dengan koma."
        );
    }

    list($emoji, $title) = explode(',', $response, 2);

    $quiz[] = [
        'emoji' => trim($emoji),
        'title' => trim($title)
    ];
}

?>

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
            font-size: 3rem; /* Adjust the size of emojis here */
        }
        .quiz-item {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tebak Karakter Anime dari Emoji</h1>
        <form action="check_answer.php" method="post">
            <input type="hidden" name="quiz" value="<?= htmlspecialchars(json_encode($quiz)) ?>"> <!-- Post array quiz to checkanswer.php --> 
            <?php foreach ($quiz as $index => $row): ?>
                <div class="quiz-item">
                    <p class="emoji"><?= $row['emoji'] ?></p>
                    <div class="form-group">
                        <label for="answer<?= $index ?>">Jawab:</label>
                        <textarea name="answers[<?= $index ?>]" id="answer<?= $index ?>" class="form-control" placeholder="Masukkan jawaban" rows="3" required></textarea>
                    </div>
                </div>
            <?php endforeach ?>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
