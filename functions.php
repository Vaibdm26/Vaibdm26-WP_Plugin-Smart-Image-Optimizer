<?php
// Optimize uploaded images
function optimize_uploaded_image($file) {
    // Check if optimization is enabled
    if (!get_option('smart_image_optimizer_enabled', 1)) {
        return $file;
    }

    $filePath = $file['file'];
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    
    if (!in_array(mime_content_type($filePath), $allowed_types)) {
        return $file;
    }

    // Get API key from settings
    $apiKey = get_option('smart_image_optimizer_api_key', ''); //place your tinyphg API Key inside ''
    if (empty($apiKey)) {
        return $file;
    }

    // Compress image using TinyPNG API
    $url = "https://api.tinify.com/shrink";
    $data = file_get_contents($filePath);
    
    $options = [
        "http" => [
            "header" => "Authorization: Basic " . base64_encode("api:$apiKey") . "\r\nContent-Type: application/json\r\n",
            "method" => "POST",
            "content" => $data
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);

    if (isset($result["output"]["url"])) {
        file_put_contents($filePath, file_get_contents($result["output"]["url"]));
    }

    return $file;
}
add_filter('wp_handle_upload', 'optimize_uploaded_image', 10, 1);



?>
