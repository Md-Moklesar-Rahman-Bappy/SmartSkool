<?php

require_once 'base_ai.php';

class GeminiAI extends BaseAI {
    private $base_url = 'https://generativelanguage.googleapis.com/v1beta/models/';
    
    public function __construct($api_key = '', $model = 'gemini-2.5-flash') {
        parent::__construct($api_key, $model, 500, 0.7);
    }

    public function generate($prompt, $system_prompt = '') {
        if (empty($this->api_key)) {
            throw new Exception("API key not configured. Please set AI_API_KEY in config.");
        }

        $url = $this->base_url . $this->model . ':generateContent?key=' . $this->api_key;
        
        $contents = [];
        if (!empty($system_prompt)) {
            $contents[] = [
                'role' => 'user',
                'parts' => [['text' => $system_prompt . "\n\n" . $prompt]]
            ];
        } else {
            $contents[] = [
                'role' => 'user',
                'parts' => [['text' => $prompt]]
            ];
        }

        $data = [
            'contents' => $contents,
            'generationConfig' => [
                'temperature' => $this->temperature,
                'maxOutputTokens' => $this->max_tokens,
                'topP' => 0.95,
                'topK' => 40
            ]
        ];

        $response = $this->makeRequest($url, $data);
        
        if (!isset($response['candidates'][0]['content']['parts'][0]['text'])) {
            throw new Exception("Invalid response format from Gemini API");
        }
        
        return $response['candidates'][0]['content']['parts'][0]['text'];
    }

    public function generateNotice($draft_notice) {
        $system_prompt = "You are a professional school administrator. Transform rough drafts into formal school circulars for parents. Keep it professional, clear, warm, and under 250 words. Use proper salutation and closing.";
        
        $prompt = "Please convert this rough draft into a formal school circular/notice:\n\n" . $draft_notice;
        
        return $this->generate($prompt, $system_prompt);
    }

    public function generateReportCardComment($student_name, $traits = [], $grades = []) {
        $system_prompt = "You are an experienced school teacher writing constructive report card comments. Write 2-3 sentence comments that are professional, positive, and helpful. Start with strengths, include one area for improvement, and end warmly.";
        
        $traits_text = !empty($traits) ? "Student traits: " . implode(', ', $traits) . "." : "";
        $grades_text = !empty($grades) ? "Subject grades: " . implode(', ', $grades) . "." : "";
        
        $prompt = "Write a report card comment for student named {$student_name}. {$traits_text} {$grades_text}";
        
        return $this->generate($prompt, $system_prompt);
    }
}

class GroqAI extends BaseAI {
    private $base_url = 'https://api.groq.com/openai/v1/chat/completions';
    
    public function __construct($api_key = '', $model = 'llama-3.3-70b-versatile') {
        parent::__construct($api_key, $model, 500, 0.7);
    }

    public function generate($prompt, $system_prompt = '') {
        if (empty($this->api_key)) {
            throw new Exception("API key not configured. Please set AI_API_KEY in config.");
        }

        $messages = [];
        if (!empty($system_prompt)) {
            $messages[] = ['role' => 'system', 'content' => $system_prompt];
        }
        $messages[] = ['role' => 'user', 'content' => $prompt];

        $data = [
            'model' => $this->model,
            'messages' => $messages,
            'temperature' => $this->temperature,
            'max_tokens' => $this->max_tokens
        ];

        $ch = curl_init($this->base_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->api_key,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        $result = json_decode($response, true);
        
        if (isset($result['error'])) {
            throw new Exception("Groq Error: " . $result['error']['message']);
        }
        
        if (!isset($result['choices'][0]['message']['content'])) {
            throw new Exception("Invalid response from Groq API");
        }
        
        return $result['choices'][0]['message']['content'];
    }

    public function generateNotice($draft_notice) {
        $system_prompt = "You are a professional school administrator. Transform rough drafts into formal school circulars for parents. Keep it professional, clear, warm, and under 250 words.";
        $prompt = "Convert this into a formal school notice: " . $draft_notice;
        return $this->generate($prompt, $system_prompt);
    }

    public function generateReportCardComment($student_name, $traits = [], $grades = []) {
        $system_prompt = "Write 2-3 sentence constructive report card comments. Start with strengths, include one area for improvement.";
        $traits_text = !empty($traits) ? "Traits: " . implode(', ', $traits) . "." : "";
        $prompt = "Comment for {$student_name}. {$traits_text}";
        return $this->generate($prompt, $system_prompt);
    }
}

class OpenRouterAI extends BaseAI {
    private $base_url = 'https://openrouter.ai/api/v1/chat/completions';
    
    public function __construct($api_key = '', $model = 'deepseek/deepseek-r1') {
        parent::__construct($api_key, $model, 500, 0.7);
    }

    public function generate($prompt, $system_prompt = '') {
        if (empty($this->api_key)) {
            throw new Exception("API key not configured. Please set AI_API_KEY in config.");
        }

        $messages = [];
        if (!empty($system_prompt)) {
            $messages[] = ['role' => 'system', 'content' => $system_prompt];
        }
        $messages[] = ['role' => 'user', 'content' => $prompt];

        $data = [
            'model' => $this->model,
            'messages' => $messages,
            'temperature' => $this->temperature,
            'max_tokens' => $this->max_tokens
        ];

        $ch = curl_init($this->base_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->api_key,
            'Content-Type: application/json',
            'HTTP-Referer: ' . (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : 'http://localhost'),
            'X-Title: SmartSkool Manager'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        $result = json_decode($response, true);
        
        if (isset($result['error'])) {
            throw new Exception("OpenRouter Error: " . $result['error']['message']);
        }
        
        if (!isset($result['choices'][0]['message']['content'])) {
            throw new Exception("Invalid response from OpenRouter API");
        }
        
        return $result['choices'][0]['message']['content'];
    }

    public function generateNotice($draft_notice) {
        $system_prompt = "You are a professional school administrator. Transform rough drafts into formal school circulars for parents. Keep it professional, clear, warm, and under 250 words.";
        $prompt = "Convert this into a formal school notice: " . $draft_notice;
        return $this->generate($prompt, $system_prompt);
    }

    public function generateReportCardComment($student_name, $traits = [], $grades = []) {
        $system_prompt = "Write 2-3 sentence constructive report card comments. Start with strengths, include one area for improvement.";
        $traits_text = !empty($traits) ? "Traits: " . implode(', ', $traits) . "." : "";
        $prompt = "Comment for {$student_name}. {$traits_text}";
        return $this->generate($prompt, $system_prompt);
    }
}

function getAIInstance($provider = 'gemini') {
    $config_file = __DIR__ . '/../controller/config.php';
    
    $api_key = defined('AI_API_KEY') ? AI_API_KEY : '';
    $model = defined('AI_MODEL') ? AI_MODEL : 'gemini-2.0-flash';
    
    switch ($provider) {
        case 'groq':
            return new GroqAI($api_key, 'llama-3.3-70b-versatile');
        case 'openrouter':
            return new OpenRouterAI($api_key, 'deepseek/deepseek-r1');
        case 'gemini':
        default:
            return new GeminiAI($api_key, $model);
    }
}
