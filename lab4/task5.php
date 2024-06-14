<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Form</title>
</head>
<body>
<h2>Encryption / Decryption</h2>
<form action="" method="post">
    <label for="textToProcess">Text to Process:</label><br>
    <textarea id="textToProcess" name="textToProcess" rows="4" cols="50"></textarea><br>
    <label for="encryptionMethod">Encryption Method:</label>
    <select name="encryptionMethod" id="encryptionMethod">
        <option value="aes-256-cbc">AES-256-CBC</option>
        <option value="des-ede3-cbc">DES-EDE3-CBC</option>
    </select><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="radio" id="encrypt" name="operation" value="encrypt" checked>
    <label for="encrypt">Encrypt</label><br>
    <input type="radio" id="decrypt" name="operation" value="decrypt">
    <label for="decrypt">Decrypt</label><br>
    <input type="submit" value="Process">
</form>

<?php

    class CryptoManager
    {
        private string $method;
        private string $password;

        public function __construct(string $method, string $password)
        {
            $this->method = $method;
            $this->password = $password;
        }

        public function process(string $text, string $operation): string
        {
            if ($operation === "encrypt") {
                return $this->encrypt($text);
            } elseif ($operation === "decrypt") {
                return $this->decrypt($text);
            } else {
                return "Invalid operation";
            }
        }

        private function encrypt(string $text): string
        {
            $ivSize = openssl_cipher_iv_length($this->method);
            $iv = openssl_random_pseudo_bytes($ivSize);
            $encrypted = openssl_encrypt($text, $this->method, $this->password, 0, $iv);
            return base64_encode($iv . $encrypted);
        }

        private function decrypt(string $text): string
        {
            $text = base64_decode($text);
            $ivSize = openssl_cipher_iv_length($this->method);
            $iv = substr($text, 0, $ivSize);
            $encrypted = substr($text, $ivSize);
            return openssl_decrypt($encrypted, $this->method, $this->password, 0, $iv);
        }
    }

    $textToProcess = $_POST['textToProcess'] ?? '';
    $encryptionMethod = $_POST['encryptionMethod'] ?? '';
    $password = $_POST['password'] ?? '';
    $operation = $_POST['operation'] ?? '';
    $cryptoManager = new CryptoManager($encryptionMethod, $password);

    if (!empty($textToProcess)) {
        $processedText = $cryptoManager->process($textToProcess, $operation);
        echo "<h3>Processed Text:</h3>";
        echo "<p>$processedText</p>";
    } else {
        echo "<p>No text to process.</p>";
    }

?>
</body>
</html>