<?php
$db_host = 'localhost';
$db_name = 'u802637580_submont';
$db_user = 'u802637580_submonthmysql';
$db_pass = 'submontH2:)';
$charset = 'utf8mb4';
$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$charset";
$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, ];
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    // Create pages table if it doesn't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `pages` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `page_slug` VARCHAR(255) NOT NULL UNIQUE,
            `content` TEXT
        );
    ");

    // Check if pages are already inserted
    $stmt = $pdo->query("SELECT COUNT(*) FROM `pages`");
    if ($stmt->fetchColumn() == 0) {
        $initial_pages = [
            'about-us' => 'Submonth হল একটি উদ্ভাবনী ডিজিটাল প্ল্যাটফর্ম, যেখানে আপনি পেতে পারেন শিক্ষনীয় এবং প্রাত্যহিক জীবনের জন্য গুরুত্বপূর্ণ বিভিন্ন ডিজিটাল পণ্য ও পরিষেবা।',
            'privacy-policy' => 'Submonth-এ আমরা আপনার গোপনীয়তাকে অত্যন্ত গুরুত্ব দিয়ে থাকি। আমাদের কাছে আপনি যেসব তথ্য প্রদান করেন, তা নিরাপদ রাখার জন্য আমরা প্রতিশ্রুতিবদ্ধ।',
            'terms-and-conditions' => 'এই শর্তাবলীতে আপনাকে স্বাগতম। Submonth পরিচালিত ওয়েবসাইট, পণ্য এবং পরিষেবাগুলোর ব্যবহার করার পূর্বে নিচের শর্তগুলো মনোযোগসহকারে পড়ে নিন।',
            'refund-policy' => 'আমরা গ্রাহক সন্তুষ্টিকে সর্বোচ্চ গুরুত্ব দিই। তবে আমাদের পণ্য ডিজিটাল হওয়ায় রিফান্ড নীতির জন্য নির্দিষ্ট নিয়ম রয়েছে:'
        ];

        $stmt = $pdo->prepare("INSERT INTO `pages` (page_slug, content) VALUES (?, ?)");
        foreach ($initial_pages as $slug => $content) {
            $stmt->execute([$slug, $content]);
        }
    }

} catch (\PDOException $e) {
    die("Database connection or setup failed: " . $e->getMessage());
}
?>