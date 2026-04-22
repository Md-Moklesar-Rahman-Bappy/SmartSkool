<?php

if (isset($_POST["do"]) && ($_POST["do"] == "generate_comment")) {
    
    header('Content-Type: application/json');
    
    $student_name = isset($_POST['student_name']) ? trim($_POST['student_name']) : '';
    $traits = isset($_POST['traits']) ? $_POST['traits'] : [];
    $subjects = isset($_POST['subjects']) ? $_POST['subjects'] : [];
    
    if (empty($student_name)) {
        echo json_encode([
            'success' => false,
            'error' => 'Student name is required.'
        ]);
        exit;
    }
    
    if (empty($traits) && empty($subjects)) {
        echo json_encode([
            'success' => false,
            'error' => 'Please select at least one trait or subject.'
        ]);
        exit;
    }
    
    try {
        include_once __DIR__ . '/../controller/config.php';
        include_once __DIR__ . '/../ai/gemini_ai.php';
        
        $ai = getAIInstance(AI_PROVIDER);
        $result = $ai->generateReportCardComment($student_name, $traits, $subjects);
        
        echo json_encode([
            'success' => true,
            'comment' => $result
        ]);
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
    
    exit;
}