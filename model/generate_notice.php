<?php

if (isset($_POST["do"]) && ($_POST["do"] == "generate_notice")) {
    
    header('Content-Type: application/json');
    
    $draft = isset($_POST['draft']) ? trim($_POST['draft']) : '';
    
    if (empty($draft)) {
        echo json_encode([
            'success' => false,
            'error' => 'Please enter a draft notice or message to generate.'
        ]);
        exit;
    }
    
    if (strlen($draft) < 10) {
        echo json_encode([
            'success' => false,
            'error' => 'Draft is too short. Please provide more details.'
        ]);
        exit;
    }
    
    try {
        include_once __DIR__ . '/../controller/config.php';
        include_once __DIR__ . '/../ai/gemini_ai.php';
        
        $ai = getAIInstance(AI_PROVIDER);
        $result = $ai->generateNotice($draft);
        
        echo json_encode([
            'success' => true,
            'notice' => $result
        ]);
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
    
    exit;
}