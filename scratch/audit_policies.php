<?php
$policyDir = __DIR__ . '/../app/Policies';
$files = glob($policyDir . '/*.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    preg_match_all('/public function (\w+)\([^)]*\)(?:: bool)?[^{]*\{([^}]+)\}/s', $content, $matches, PREG_SET_ORDER);
    echo "=== " . basename($file) . " ===\n";
    foreach ($matches as $m) {
        $method = $m[1];
        $body = trim(preg_replace('/\s+/', ' ', $m[2]));
        echo "  - {$method}: {$body}\n";
    }
}
