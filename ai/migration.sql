-- SMS AI Features Database Migration
-- Run this SQL in phpMyAdmin or MySQL CLI to add the teacher_comment column

-- =============================================
-- Feature 2: Add teacher_comment column to exam_mark table
-- Note: If exam_mark table doesn't exist yet, create it first
-- =============================================

-- Option 1: If exam_mark table exists, run this ALTER statement
-- ALTER TABLE exam_mark ADD COLUMN teacher_comment TEXT AFTER eMark;

-- Option 2: Create exam_mark table with teacher_comment column
-- (Uncomment and modify if needed)
-- CREATE TABLE IF NOT EXISTS exam_mark (
--     id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
--     index_number BIGINT(11) NOT NULL,
--     exam_id INT(11) NOT NULL,
--     subject_id INT(11) NOT NULL,
--     eMark DOUBLE(11,2) NOT NULL,
--     year INT(11) NOT NULL,
--     teacher_comment TEXT,
--     PRIMARY KEY (id)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- =============================================
-- AI Settings (Save as ai_config.php or use in controller/config.php)
-- =============================================

-- SET YOUR API KEY HERE:
-- define('AI_API_KEY', 'YOUR_GEMINI_API_KEY');
-- 
-- Supported providers:
--   gemini     - Google Gemini (default, free tier)
--   groq       - Groq (free tier, fast)
--   openrouter - OpenRouter (free tier, multiple models)
--
-- To switch providers, change AI_PROVIDER:
-- define('AI_PROVIDER', 'gemini');  // Default
-- define('AI_PROVIDER', 'groq');   // Alternative
-- define('AI_PROVIDER', 'openrouter');  // Alternative