<?php
$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = isset($_POST['input']) ? $_POST['input'] : '';
    $lines = explode("\n", trim($input));
    $channels = [];
    
    for ($i = 0; $i < count($lines); $i++) {
        if (strpos($lines[$i], 'http') === 0) {
            $channelName = trim($lines[$i-2]);
            $url = trim($lines[$i]);
            $channels[] = "$channelName,$url";
        }
    }
    
    $result = implode("\n", array_unique($channels));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>频道链接提取</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        textarea { width: 100%; height: 300px; margin: 10px 0; padding: 10px; }
        button { padding: 10px 20px; background: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <form method="post">
            <h3>粘贴框：</h3>
            <textarea name="input" placeholder="请粘贴原始数据..."><?= isset($_POST['input']) ? htmlspecialchars($_POST['input']) : '' ?></textarea>
            <button type="submit">提取频道链接</button>
            
            <h3>输出结果：</h3>
            <textarea readonly><?= htmlspecialchars($result) ?></textarea>
        </form>
    </div>
</body>
</html>