/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 50742 (5.7.42)
 Source Host           : localhost:3306
 Source Schema         : smartschool7

 Target Server Type    : MySQL
 Target Server Version : 50742 (5.7.42)
 File Encoding         : 65001

 Date: 30/05/2025 20:17:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for alumni_events
-- ----------------------------
DROP TABLE IF EXISTS `alumni_events`;
CREATE TABLE `alumni_events`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `event_for` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `session_id` int(11) NULL DEFAULT NULL,
  `class_id` int(11) NULL DEFAULT NULL,
  `section` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `event_notification_message` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `show_onwebsite` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  CONSTRAINT `alumni_events_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `alumni_events_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for alumni_students
-- ----------------------------
DROP TABLE IF EXISTS `alumni_students`;
CREATE TABLE `alumni_students`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `current_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `current_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `occupation` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  CONSTRAINT `alumni_students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for attendence_type
-- ----------------------------
DROP TABLE IF EXISTS `attendence_type`;
CREATE TABLE `attendence_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `key_value` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `long_lang_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `long_name_style` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `for_qr_attendance` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for behaviour_settings
-- ----------------------------
DROP TABLE IF EXISTS `behaviour_settings`;
CREATE TABLE `behaviour_settings`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_option` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for book_issues
-- ----------------------------
DROP TABLE IF EXISTS `book_issues`;
CREATE TABLE `book_issues`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `member_id` int(11) NULL DEFAULT NULL,
  `duereturn_date` date NULL DEFAULT NULL,
  `return_date` date NULL DEFAULT NULL,
  `issue_date` date NULL DEFAULT NULL,
  `is_returned` int(11) NULL DEFAULT 0,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `book_id`(`book_id`) USING BTREE,
  INDEX `member_id`(`member_id`) USING BTREE,
  CONSTRAINT `book_issues_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `book_issues_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `libarary_members` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `book_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `isbn_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rack_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `publish` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `author` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qty` int(11) NULL DEFAULT NULL,
  `perunitcost` float(10, 2) NULL DEFAULT NULL,
  `postdate` date NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `available` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'yes',
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for captcha
-- ----------------------------
DROP TABLE IF EXISTS `captcha`;
CREATE TABLE `captcha`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exam_assessment_types
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exam_assessment_types`;
CREATE TABLE `cbse_exam_assessment_types`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_assessment_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `maximum_marks` float NOT NULL,
  `pass_percentage` float NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_exam_assessment_id`(`cbse_exam_assessment_id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE,
  INDEX `idx_code`(`code`) USING BTREE,
  CONSTRAINT `cbse_exam_assessment_types_ibfk_1` FOREIGN KEY (`cbse_exam_assessment_id`) REFERENCES `cbse_exam_assessments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exam_assessments
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exam_assessments`;
CREATE TABLE `cbse_exam_assessments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exam_class_sections
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exam_class_sections`;
CREATE TABLE `cbse_exam_class_sections`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `class_section_id`(`class_section_id`) USING BTREE,
  INDEX `cbse_exam_id`(`cbse_exam_id`) USING BTREE,
  CONSTRAINT `cbse_exam_class_sections_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_exam_class_sections_ibfk_2` FOREIGN KEY (`cbse_exam_id`) REFERENCES `cbse_exams` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exam_grades
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exam_grades`;
CREATE TABLE `cbse_exam_grades`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exam_grades_range
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exam_grades_range`;
CREATE TABLE `cbse_exam_grades_range`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_grade_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `minimum_percentage` float NOT NULL,
  `maximum_percentage` float NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_exam_grade_id`(`cbse_exam_grade_id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE,
  CONSTRAINT `cbse_exam_grades_range_ibfk_1` FOREIGN KEY (`cbse_exam_grade_id`) REFERENCES `cbse_exam_grades` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exam_observations
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exam_observations`;
CREATE TABLE `cbse_exam_observations`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exam_student_subject_rank
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exam_student_subject_rank`;
CREATE TABLE `cbse_exam_student_subject_rank`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_template_id` int(11) NULL DEFAULT NULL,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `subject_id` int(11) NULL DEFAULT NULL,
  `rank` int(11) NULL DEFAULT NULL,
  `rank_percentage` float(10, 2) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_template_id`(`cbse_template_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  INDEX `subject_id`(`subject_id`) USING BTREE,
  INDEX `idx_rank`(`rank`) USING BTREE,
  CONSTRAINT `cbse_exam_student_subject_rank_ibfk_1` FOREIGN KEY (`cbse_template_id`) REFERENCES `cbse_template` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_exam_student_subject_rank_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_exam_student_subject_rank_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exam_students
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exam_students`;
CREATE TABLE `cbse_exam_students`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_id` int(11) NOT NULL,
  `student_session_id` int(11) NOT NULL,
  `staff_id` int(11) NULL DEFAULT NULL,
  `roll_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `total_present_days` int(11) NULL DEFAULT NULL,
  `delete_student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_exam_id`(`cbse_exam_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  CONSTRAINT `cbse_exam_students_ibfk_1` FOREIGN KEY (`cbse_exam_id`) REFERENCES `cbse_exams` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_exam_students_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exam_timetable
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exam_timetable`;
CREATE TABLE `cbse_exam_timetable`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_id` int(11) NULL DEFAULT NULL,
  `subject_id` int(11) NULL DEFAULT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `duration` int(11) NOT NULL,
  `room_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_written` int(1) NOT NULL DEFAULT 1,
  `written_maximum_marks` float NOT NULL,
  `is_practical` int(1) NOT NULL,
  `practical_maximum_mark` float NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_exam_id`(`cbse_exam_id`) USING BTREE,
  INDEX `subject_id`(`subject_id`) USING BTREE,
  CONSTRAINT `cbse_exam_timetable_ibfk_1` FOREIGN KEY (`cbse_exam_id`) REFERENCES `cbse_exams` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_exam_timetable_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exam_timetable_assessment_types
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exam_timetable_assessment_types`;
CREATE TABLE `cbse_exam_timetable_assessment_types`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_timetable_id` int(11) NULL DEFAULT NULL,
  `cbse_exam_assessment_type_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_exam_timetable_id`(`cbse_exam_timetable_id`) USING BTREE,
  INDEX `cbse_exam_assessment_type_id`(`cbse_exam_assessment_type_id`) USING BTREE,
  CONSTRAINT `cbse_exam_timetable_assessment_types_ibfk_1` FOREIGN KEY (`cbse_exam_timetable_id`) REFERENCES `cbse_exam_timetable` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_exam_timetable_assessment_types_ibfk_2` FOREIGN KEY (`cbse_exam_assessment_type_id`) REFERENCES `cbse_exam_assessment_types` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_exams
-- ----------------------------
DROP TABLE IF EXISTS `cbse_exams`;
CREATE TABLE `cbse_exams`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_working_days` int(11) NULL DEFAULT 0,
  `cbse_term_id` int(11) NULL DEFAULT NULL,
  `cbse_exam_assessment_id` int(11) NULL DEFAULT NULL,
  `cbse_exam_grade_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `exam_code` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `session_id` int(11) NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_publish` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `use_exam_roll_no` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_term_id`(`cbse_term_id`) USING BTREE,
  INDEX `cbse_exam_grade_id`(`cbse_exam_grade_id`) USING BTREE,
  INDEX `cbse_exam_assessment_id`(`cbse_exam_assessment_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE,
  INDEX `idx_exam_code`(`exam_code`) USING BTREE,
  CONSTRAINT `cbse_exams_ibfk_1` FOREIGN KEY (`cbse_term_id`) REFERENCES `cbse_terms` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_exams_ibfk_2` FOREIGN KEY (`cbse_exam_grade_id`) REFERENCES `cbse_exam_grades` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_exams_ibfk_3` FOREIGN KEY (`cbse_exam_assessment_id`) REFERENCES `cbse_exam_assessments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_exams_ibfk_4` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_marksheet_type
-- ----------------------------
DROP TABLE IF EXISTS `cbse_marksheet_type`;
CREATE TABLE `cbse_marksheet_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `short_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE,
  INDEX `idx_short_code`(`short_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_observation_class_section
-- ----------------------------
DROP TABLE IF EXISTS `cbse_observation_class_section`;
CREATE TABLE `cbse_observation_class_section`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_observation_parameter_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_observation_parameters
-- ----------------------------
DROP TABLE IF EXISTS `cbse_observation_parameters`;
CREATE TABLE `cbse_observation_parameters`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_observation_subparameter
-- ----------------------------
DROP TABLE IF EXISTS `cbse_observation_subparameter`;
CREATE TABLE `cbse_observation_subparameter`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_observation_id` int(11) NOT NULL,
  `cbse_observation_parameter_id` int(11) NOT NULL,
  `maximum_marks` float NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_observation_parameter_id_ibfk_1`(`cbse_observation_parameter_id`) USING BTREE,
  INDEX `cbse_exam_observation_id_ibfk_1`(`cbse_exam_observation_id`) USING BTREE,
  CONSTRAINT `cbse_exam_observation_id_ibfk_1` FOREIGN KEY (`cbse_exam_observation_id`) REFERENCES `cbse_exam_observations` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_observation_parameter_id_ibfk_1` FOREIGN KEY (`cbse_observation_parameter_id`) REFERENCES `cbse_observation_parameters` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_observation_term_student_subparameter
-- ----------------------------
DROP TABLE IF EXISTS `cbse_observation_term_student_subparameter`;
CREATE TABLE `cbse_observation_term_student_subparameter`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_ovservation_term_id` int(11) NULL DEFAULT NULL,
  `cbse_observation_subparameter_id` int(11) NULL DEFAULT NULL,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `obtain_marks` float(10, 2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_observation_term_student_subparameter_ibfk_1`(`cbse_ovservation_term_id`) USING BTREE,
  INDEX `cbse_observation_subparameter_id`(`cbse_observation_subparameter_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  CONSTRAINT `cbse_observation_term_student_subparameter_ibfk_1` FOREIGN KEY (`cbse_ovservation_term_id`) REFERENCES `cbse_observation_terms` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_observation_term_student_subparameter_ibfk_2` FOREIGN KEY (`cbse_observation_subparameter_id`) REFERENCES `cbse_observation_subparameter` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_observation_term_student_subparameter_ibfk_3` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_observation_terms
-- ----------------------------
DROP TABLE IF EXISTS `cbse_observation_terms`;
CREATE TABLE `cbse_observation_terms`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_observation_id` int(11) NOT NULL,
  `cbse_term_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_term_id`(`cbse_term_id`) USING BTREE,
  INDEX `cbse_ovservation_terms_ibfk_3`(`session_id`) USING BTREE,
  INDEX `cbse_exam_observations_ibfk_1`(`cbse_exam_observation_id`) USING BTREE,
  CONSTRAINT `cbse_exam_observations_ibfk_1` FOREIGN KEY (`cbse_exam_observation_id`) REFERENCES `cbse_exam_observations` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_observation_terms_ibfk_2` FOREIGN KEY (`cbse_term_id`) REFERENCES `cbse_terms` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_observation_terms_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_student_exam_ranks
-- ----------------------------
DROP TABLE IF EXISTS `cbse_student_exam_ranks`;
CREATE TABLE `cbse_student_exam_ranks`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_id` int(11) NOT NULL,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `rank` int(11) NULL DEFAULT NULL,
  `rank_percentage` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_exam_id`(`cbse_exam_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  INDEX `idx_rank`(`rank`) USING BTREE,
  INDEX `idx_rank_percentage`(`rank_percentage`) USING BTREE,
  CONSTRAINT `cbse_student_exam_ranks_ibfk_1` FOREIGN KEY (`cbse_exam_id`) REFERENCES `cbse_exams` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_student_exam_ranks_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_student_subject_marks
-- ----------------------------
DROP TABLE IF EXISTS `cbse_student_subject_marks`;
CREATE TABLE `cbse_student_subject_marks`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_timetable_assessment_type_id` int(11) NOT NULL,
  `cbse_exam_timetable_id` int(11) NULL DEFAULT NULL,
  `cbse_exam_student_id` int(11) NULL DEFAULT NULL,
  `cbse_exam_assessment_type_id` int(11) NULL DEFAULT NULL,
  `is_absent` int(1) NOT NULL DEFAULT 0,
  `marks` float(10, 2) NULL DEFAULT 0.00,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_exam_timetable_id`(`cbse_exam_timetable_id`) USING BTREE,
  INDEX `cbse_exam_student_id`(`cbse_exam_student_id`) USING BTREE,
  INDEX `cbse_exam_assessment_type_id`(`cbse_exam_assessment_type_id`) USING BTREE,
  INDEX `cbse_exam_timetable_assessment_type_ibfk_4`(`cbse_exam_timetable_assessment_type_id`) USING BTREE,
  CONSTRAINT `cbse_exam_timetable_assessment_type_ibfk_4` FOREIGN KEY (`cbse_exam_timetable_assessment_type_id`) REFERENCES `cbse_exam_timetable_assessment_types` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_student_subject_marks_ibfk_1` FOREIGN KEY (`cbse_exam_timetable_id`) REFERENCES `cbse_exam_timetable` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_student_subject_marks_ibfk_2` FOREIGN KEY (`cbse_exam_student_id`) REFERENCES `cbse_exam_students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_student_subject_marks_ibfk_3` FOREIGN KEY (`cbse_exam_assessment_type_id`) REFERENCES `cbse_exam_assessment_types` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_student_subject_result
-- ----------------------------
DROP TABLE IF EXISTS `cbse_student_subject_result`;
CREATE TABLE `cbse_student_subject_result`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_exam_timetable_id` int(11) NULL DEFAULT NULL,
  `cbse_exam_student_id` int(11) NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_student_template_rank
-- ----------------------------
DROP TABLE IF EXISTS `cbse_student_template_rank`;
CREATE TABLE `cbse_student_template_rank`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_template_id` int(11) NULL DEFAULT NULL,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `rank` int(20) NULL DEFAULT NULL,
  `rank_percentage` float(10, 2) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  INDEX `cbse_template_id`(`cbse_template_id`) USING BTREE,
  INDEX `idx_rank`(`rank`) USING BTREE,
  INDEX `idx_rank_percentage`(`rank_percentage`) USING BTREE,
  CONSTRAINT `cbse_student_template_rank_ibfk_1` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_student_template_rank_ibfk_2` FOREIGN KEY (`cbse_template_id`) REFERENCES `cbse_template` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_template
-- ----------------------------
DROP TABLE IF EXISTS `cbse_template`;
CREATE TABLE `cbse_template`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `orientation` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'P',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gradeexam_id` int(11) NULL DEFAULT NULL,
  `remarkexam_id` int(11) NULL DEFAULT NULL,
  `is_weightage` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `marksheet_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `header_image` varbinary(500) NULL DEFAULT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `left_logo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `right_logo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `exam_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `school_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `exam_center` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `session_id` int(11) NOT NULL,
  `left_sign` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `middle_sign` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `right_sign` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `background_img` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `content_footer` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `date` date NULL DEFAULT NULL,
  `is_name` int(1) NULL DEFAULT 1,
  `is_father_name` int(1) NULL DEFAULT 1,
  `is_mother_name` int(1) NULL DEFAULT 1,
  `exam_session` int(1) NULL DEFAULT 1,
  `is_admission_no` int(1) NULL DEFAULT 1,
  `is_division` int(1) NOT NULL DEFAULT 1,
  `is_roll_no` int(1) NULL DEFAULT 1,
  `is_photo` int(1) NULL DEFAULT 1,
  `is_class` int(1) NOT NULL DEFAULT 0,
  `is_section` int(1) NOT NULL DEFAULT 0,
  `is_dob` int(1) NULL DEFAULT 1,
  `is_remark` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_template_ibfk_3`(`session_id`) USING BTREE,
  INDEX `cbse_template_ibfk_1`(`gradeexam_id`) USING BTREE,
  INDEX `cbse_template_ibfk_2`(`remarkexam_id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE,
  INDEX `idx_marksheet_type`(`marksheet_type`) USING BTREE,
  INDEX `idx_exam_name`(`exam_name`) USING BTREE,
  INDEX `idx_school_name`(`school_name`) USING BTREE,
  CONSTRAINT `cbse_template_ibfk_1` FOREIGN KEY (`gradeexam_id`) REFERENCES `cbse_exams` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `cbse_template_ibfk_2` FOREIGN KEY (`remarkexam_id`) REFERENCES `cbse_exams` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `cbse_template_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_template_class_sections
-- ----------------------------
DROP TABLE IF EXISTS `cbse_template_class_sections`;
CREATE TABLE `cbse_template_class_sections`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_template_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_template_id`(`cbse_template_id`) USING BTREE,
  INDEX `class_section_id`(`class_section_id`) USING BTREE,
  CONSTRAINT `cbse_template_class_sections_ibfk_1` FOREIGN KEY (`cbse_template_id`) REFERENCES `cbse_template` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_template_class_sections_ibfk_2` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_template_term_exams
-- ----------------------------
DROP TABLE IF EXISTS `cbse_template_term_exams`;
CREATE TABLE `cbse_template_term_exams`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_template_term_id` int(11) NULL DEFAULT NULL,
  `cbse_exam_id` int(11) NOT NULL,
  `cbse_template_id` int(11) NOT NULL,
  `weightage` float NOT NULL DEFAULT 100,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_template_term_id`(`cbse_template_term_id`) USING BTREE,
  INDEX `cbse_template_term_exams_ibfk_3`(`cbse_exam_id`) USING BTREE,
  INDEX `cbse_template_term_exams_ibfk_4`(`cbse_template_id`) USING BTREE,
  INDEX `idx_weightage`(`weightage`) USING BTREE,
  CONSTRAINT `cbse_template_term_exams_ibfk_1` FOREIGN KEY (`cbse_exam_id`) REFERENCES `cbse_exams` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_template_term_exams_ibfk_2` FOREIGN KEY (`cbse_template_term_id`) REFERENCES `cbse_template_terms` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_template_term_exams_ibfk_4` FOREIGN KEY (`cbse_template_id`) REFERENCES `cbse_template` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_template_terms
-- ----------------------------
DROP TABLE IF EXISTS `cbse_template_terms`;
CREATE TABLE `cbse_template_terms`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cbse_template_id` int(11) NOT NULL,
  `cbse_term_id` int(11) NOT NULL,
  `weightage` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cbse_template_id`(`cbse_template_id`) USING BTREE,
  INDEX `cbse_term_id`(`cbse_term_id`) USING BTREE,
  INDEX `idx_weightage`(`weightage`) USING BTREE,
  CONSTRAINT `cbse_template_terms_ibfk_1` FOREIGN KEY (`cbse_template_id`) REFERENCES `cbse_template` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cbse_template_terms_ibfk_2` FOREIGN KEY (`cbse_term_id`) REFERENCES `cbse_terms` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cbse_terms
-- ----------------------------
DROP TABLE IF EXISTS `cbse_terms`;
CREATE TABLE `cbse_terms`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `term_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE,
  INDEX `idx_term_code`(`term_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for certificates
-- ----------------------------
DROP TABLE IF EXISTS `certificates`;
CREATE TABLE `certificates`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `certificate_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `certificate_text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `left_header` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `center_header` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `right_header` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `left_footer` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `right_footer` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `center_footer` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `background_image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_for` tinyint(1) NOT NULL COMMENT '1 = staff, 2 = students',
  `status` tinyint(1) NOT NULL,
  `header_height` int(11) NOT NULL,
  `content_height` int(11) NOT NULL,
  `footer_height` int(11) NOT NULL,
  `content_width` int(11) NOT NULL,
  `enable_student_image` tinyint(1) NOT NULL COMMENT '0=no,1=yes',
  `enable_image_height` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for chat_connections
-- ----------------------------
DROP TABLE IF EXISTS `chat_connections`;
CREATE TABLE `chat_connections`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_user_one` int(11) NOT NULL,
  `chat_user_two` int(11) NOT NULL,
  `ip` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `time` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `chat_user_one`(`chat_user_one`) USING BTREE,
  INDEX `chat_user_two`(`chat_user_two`) USING BTREE,
  CONSTRAINT `chat_connections_ibfk_1` FOREIGN KEY (`chat_user_one`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `chat_connections_ibfk_2` FOREIGN KEY (`chat_user_two`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for chat_messages
-- ----------------------------
DROP TABLE IF EXISTS `chat_messages`;
CREATE TABLE `chat_messages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `chat_user_id` int(11) NOT NULL,
  `ip` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `is_first` int(1) NULL DEFAULT 0,
  `is_read` int(1) NOT NULL DEFAULT 0,
  `chat_connection_id` int(11) NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `chat_user_id`(`chat_user_id`) USING BTREE,
  INDEX `chat_connection_id`(`chat_connection_id`) USING BTREE,
  CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`chat_user_id`) REFERENCES `chat_users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `chat_messages_ibfk_2` FOREIGN KEY (`chat_connection_id`) REFERENCES `chat_connections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for chat_users
-- ----------------------------
DROP TABLE IF EXISTS `chat_users`;
CREATE TABLE `chat_users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `staff_id` int(11) NULL DEFAULT NULL,
  `student_id` int(11) NULL DEFAULT NULL,
  `create_staff_id` int(11) NULL DEFAULT NULL,
  `create_student_id` int(11) NULL DEFAULT NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `create_staff_id`(`create_staff_id`) USING BTREE,
  INDEX `create_student_id`(`create_student_id`) USING BTREE,
  CONSTRAINT `chat_users_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `chat_users_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `chat_users_ibfk_3` FOREIGN KEY (`create_staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `chat_users_ibfk_4` FOREIGN KEY (`create_student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for class_section_times
-- ----------------------------
DROP TABLE IF EXISTS `class_section_times`;
CREATE TABLE `class_section_times`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_section_id` int(11) NULL DEFAULT NULL,
  `time` time NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `class_section_id`(`class_section_id`) USING BTREE,
  CONSTRAINT `class_section_times_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for class_sections
-- ----------------------------
DROP TABLE IF EXISTS `class_sections`;
CREATE TABLE `class_sections`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NULL DEFAULT NULL,
  `section_id` int(11) NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  INDEX `section_id`(`section_id`) USING BTREE,
  CONSTRAINT `class_sections_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `class_sections_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for class_teacher
-- ----------------------------
DROP TABLE IF EXISTS `class_teacher`;
CREATE TABLE `class_teacher`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  INDEX `section_id`(`section_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  CONSTRAINT `class_teacher_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `class_teacher_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `class_teacher_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `class_teacher_ibfk_4` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for classes
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for complaint
-- ----------------------------
DROP TABLE IF EXISTS `complaint`;
CREATE TABLE `complaint`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `source` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` date NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `action_taken` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `assigned` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for complaint_type
-- ----------------------------
DROP TABLE IF EXISTS `complaint_type`;
CREATE TABLE `complaint_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for content_for
-- ----------------------------
DROP TABLE IF EXISTS `content_for`;
CREATE TABLE `content_for`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content_id` int(11) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `content_id`(`content_id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `content_for_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `content_for_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for content_types
-- ----------------------------
DROP TABLE IF EXISTS `content_types`;
CREATE TABLE `content_types`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` int(1) NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for contents
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_public` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'No',
  `class_id` int(11) NULL DEFAULT NULL,
  `cls_sec_id` int(10) NULL DEFAULT NULL,
  `file` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date` date NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  INDEX `cls_sec_id`(`cls_sec_id`) USING BTREE,
  CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `contents_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `contents_ibfk_3` FOREIGN KEY (`cls_sec_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for currencies
-- ----------------------------
DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `short_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `symbol` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `base_price` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
  `is_active` int(1) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 180 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for custom_field_values
-- ----------------------------
DROP TABLE IF EXISTS `custom_field_values`;
CREATE TABLE `custom_field_values`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `belong_table_id` int(11) NULL DEFAULT NULL,
  `custom_field_id` int(11) NULL DEFAULT NULL,
  `field_value` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `custom_field_id`(`custom_field_id`) USING BTREE,
  INDEX `idx_belong_table_id`(`belong_table_id`) USING BTREE,
  INDEX `idx_field_value`(`field_value`) USING BTREE,
  CONSTRAINT `custom_field_values_ibfk_1` FOREIGN KEY (`custom_field_id`) REFERENCES `custom_fields` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for custom_fields
-- ----------------------------
DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE `custom_fields`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `belong_to` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bs_column` int(10) NULL DEFAULT NULL,
  `validation` int(11) NULL DEFAULT 0,
  `field_values` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `show_table` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `visible_on_table` int(11) NOT NULL,
  `weight` int(11) NULL DEFAULT NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE,
  INDEX `idx_belong_to`(`belong_to`) USING BTREE,
  INDEX `idx_type`(`type`) USING BTREE,
  INDEX `idx_visible_on_table`(`visible_on_table`) USING BTREE,
  INDEX `idx_weight`(`weight`) USING BTREE,
  FULLTEXT INDEX `idx_field_values`(`field_values`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for daily_assignment
-- ----------------------------
DROP TABLE IF EXISTS `daily_assignment`;
CREATE TABLE `daily_assignment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) NOT NULL,
  `subject_group_subject_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `attachment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `evaluated_by` int(11) NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `evaluation_date` date NULL DEFAULT NULL,
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  INDEX `evaluated_by`(`evaluated_by`) USING BTREE,
  INDEX `subject_group_subject_id`(`subject_group_subject_id`) USING BTREE,
  CONSTRAINT `daily_assignment_ibfk_1` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `daily_assignment_ibfk_2` FOREIGN KEY (`evaluated_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `daily_assignment_ibfk_3` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for disable_reason
-- ----------------------------
DROP TABLE IF EXISTS `disable_reason`;
CREATE TABLE `disable_reason`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for dispatch_receive
-- ----------------------------
DROP TABLE IF EXISTS `dispatch_receive`;
CREATE TABLE `dispatch_receive`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `to_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `note` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `from_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` date NULL DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for email_attachments
-- ----------------------------
DROP TABLE IF EXISTS `email_attachments`;
CREATE TABLE `email_attachments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `directory` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `attachment_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `message_id`(`message_id`) USING BTREE,
  CONSTRAINT `email_attachments_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for email_config
-- ----------------------------
DROP TABLE IF EXISTS `email_config`;
CREATE TABLE `email_config`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `smtp_server` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `smtp_port` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `smtp_username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `smtp_password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ssl_tls` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `smtp_auth` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `api_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `api_secret` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for email_template
-- ----------------------------
DROP TABLE IF EXISTS `email_template`;
CREATE TABLE `email_template`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for email_template_attachment
-- ----------------------------
DROP TABLE IF EXISTS `email_template_attachment`;
CREATE TABLE `email_template_attachment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_template_id` int(11) NOT NULL,
  `attachment` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `attachment_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for enquiry
-- ----------------------------
DROP TABLE IF EXISTS `enquiry`;
CREATE TABLE `enquiry`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `reference` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `follow_up_date` date NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `source` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `assigned` int(11) NULL DEFAULT NULL,
  `class_id` int(11) NULL DEFAULT NULL,
  `no_of_child` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `assigned`(`assigned`) USING BTREE,
  INDEX `enquiry_ibfk_4`(`class_id`) USING BTREE,
  CONSTRAINT `enquiry_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `enquiry_ibfk_3` FOREIGN KEY (`assigned`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `enquiry_ibfk_4` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for enquiry_type
-- ----------------------------
DROP TABLE IF EXISTS `enquiry_type`;
CREATE TABLE `enquiry_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `event_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `event_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `event_color` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `event_for` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  `is_active` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exam_group_class_batch_exam_students
-- ----------------------------
DROP TABLE IF EXISTS `exam_group_class_batch_exam_students`;
CREATE TABLE `exam_group_class_batch_exam_students`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_group_class_batch_exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_session_id` int(11) NOT NULL,
  `roll_no` int(6) NULL DEFAULT NULL,
  `teacher_remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `rank` int(20) NOT NULL DEFAULT 0,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_group_class_batch_exam_id`(`exam_group_class_batch_exam_id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  CONSTRAINT `exam_group_class_batch_exam_students_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exam_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exam_group_class_batch_exam_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exam_group_class_batch_exam_students_ibfk_3` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exam_group_class_batch_exam_subjects
-- ----------------------------
DROP TABLE IF EXISTS `exam_group_class_batch_exam_subjects`;
CREATE TABLE `exam_group_class_batch_exam_subjects`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_group_class_batch_exams_id` int(11) NULL DEFAULT NULL,
  `subject_id` int(10) NOT NULL,
  `date_from` date NOT NULL,
  `time_from` time NOT NULL,
  `duration` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `room_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `max_marks` float(10, 2) NULL DEFAULT NULL,
  `min_marks` float(10, 2) NULL DEFAULT NULL,
  `credit_hours` float(10, 2) NULL DEFAULT 0.00,
  `date_to` datetime NULL DEFAULT NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_group_class_batch_exams_id`(`exam_group_class_batch_exams_id`) USING BTREE,
  INDEX `subject_id`(`subject_id`) USING BTREE,
  CONSTRAINT `exam_group_class_batch_exam_subjects_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exams_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exam_group_class_batch_exam_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exam_group_class_batch_exams
-- ----------------------------
DROP TABLE IF EXISTS `exam_group_class_batch_exams`;
CREATE TABLE `exam_group_class_batch_exams`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `passing_percentage` float(10, 2) NULL DEFAULT NULL,
  `session_id` int(10) NOT NULL,
  `date_from` date NULL DEFAULT NULL,
  `date_to` date NULL DEFAULT NULL,
  `exam_group_id` int(11) NULL DEFAULT NULL,
  `use_exam_roll_no` int(1) NOT NULL DEFAULT 1,
  `is_publish` int(1) NULL DEFAULT 0,
  `is_rank_generated` int(1) NOT NULL DEFAULT 0,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_group_id`(`exam_group_id`) USING BTREE,
  INDEX `exam_group_class_batch_exams_ibfk_2`(`session_id`) USING BTREE,
  CONSTRAINT `exam_group_class_batch_exams_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exam_group_class_batch_exams_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exam_group_exam_connections
-- ----------------------------
DROP TABLE IF EXISTS `exam_group_exam_connections`;
CREATE TABLE `exam_group_exam_connections`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_group_id` int(11) NULL DEFAULT NULL,
  `exam_group_class_batch_exams_id` int(11) NULL DEFAULT NULL,
  `exam_weightage` float(10, 2) NULL DEFAULT 0.00,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_group_id`(`exam_group_id`) USING BTREE,
  INDEX `exam_group_class_batch_exams_id`(`exam_group_class_batch_exams_id`) USING BTREE,
  CONSTRAINT `exam_group_exam_connections_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exam_group_exam_connections_ibfk_2` FOREIGN KEY (`exam_group_class_batch_exams_id`) REFERENCES `exam_group_class_batch_exams` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exam_group_exam_results
-- ----------------------------
DROP TABLE IF EXISTS `exam_group_exam_results`;
CREATE TABLE `exam_group_exam_results`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_group_class_batch_exam_student_id` int(11) NOT NULL,
  `exam_group_class_batch_exam_subject_id` int(11) NULL DEFAULT NULL,
  `exam_group_student_id` int(11) NULL DEFAULT NULL,
  `attendence` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `get_marks` float(10, 2) NULL DEFAULT 0.00,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_group_class_batch_exam_subject_id`(`exam_group_class_batch_exam_subject_id`) USING BTREE,
  INDEX `exam_group_student_id`(`exam_group_student_id`) USING BTREE,
  INDEX `exam_group_class_batch_exam_student_id`(`exam_group_class_batch_exam_student_id`) USING BTREE,
  CONSTRAINT `exam_group_exam_results_ibfk_1` FOREIGN KEY (`exam_group_class_batch_exam_subject_id`) REFERENCES `exam_group_class_batch_exam_subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exam_group_exam_results_ibfk_2` FOREIGN KEY (`exam_group_student_id`) REFERENCES `exam_group_students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exam_group_exam_results_ibfk_3` FOREIGN KEY (`exam_group_class_batch_exam_student_id`) REFERENCES `exam_group_class_batch_exam_students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exam_group_students
-- ----------------------------
DROP TABLE IF EXISTS `exam_group_students`;
CREATE TABLE `exam_group_students`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_group_id` int(11) NULL DEFAULT NULL,
  `student_id` int(11) NULL DEFAULT NULL,
  `student_session_id` int(10) NULL DEFAULT NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exam_group_id`(`exam_group_id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  CONSTRAINT `exam_group_students_ibfk_1` FOREIGN KEY (`exam_group_id`) REFERENCES `exam_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exam_group_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exam_group_students_ibfk_3` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exam_groups
-- ----------------------------
DROP TABLE IF EXISTS `exam_groups`;
CREATE TABLE `exam_groups`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `exam_type` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` int(11) NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exam_schedules
-- ----------------------------
DROP TABLE IF EXISTS `exam_schedules`;
CREATE TABLE `exam_schedules`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `exam_id` int(11) NULL DEFAULT NULL,
  `teacher_subject_id` int(11) NULL DEFAULT NULL,
  `date_of_exam` date NULL DEFAULT NULL,
  `start_to` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `end_from` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `room_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `full_marks` int(11) NULL DEFAULT NULL,
  `passing_marks` int(11) NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `teacher_subject_id`(`teacher_subject_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `exam_id`(`exam_id`) USING BTREE,
  CONSTRAINT `exam_schedules_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exam_schedules_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for exams
-- ----------------------------
DROP TABLE IF EXISTS `exams`;
CREATE TABLE `exams`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sesion_id` int(11) NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sesion_id`(`sesion_id`) USING BTREE,
  CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`sesion_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for expense_head
-- ----------------------------
DROP TABLE IF EXISTS `expense_head`;
CREATE TABLE `expense_head`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_category` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'yes',
  `is_deleted` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for expenses
-- ----------------------------
DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_head_id` int(11) NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `invoice_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `amount` float(10, 2) NULL DEFAULT NULL,
  `documents` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'yes',
  `is_deleted` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exp_head_id`(`exp_head_id`) USING BTREE,
  CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`exp_head_id`) REFERENCES `expense_head` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fee_groups
-- ----------------------------
DROP TABLE IF EXISTS `fee_groups`;
CREATE TABLE `fee_groups`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fee_groups_feetype
-- ----------------------------
DROP TABLE IF EXISTS `fee_groups_feetype`;
CREATE TABLE `fee_groups_feetype`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_session_group_id` int(11) NULL DEFAULT NULL,
  `fee_groups_id` int(11) NULL DEFAULT NULL,
  `feetype_id` int(11) NULL DEFAULT NULL,
  `session_id` int(11) NULL DEFAULT NULL,
  `amount` decimal(10, 2) NULL DEFAULT NULL,
  `fine_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'none',
  `due_date` date NULL DEFAULT NULL,
  `fine_percentage` float(10, 2) NOT NULL DEFAULT 0.00,
  `fine_amount` float(10, 2) NOT NULL DEFAULT 0.00,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fee_session_group_id`(`fee_session_group_id`) USING BTREE,
  INDEX `fee_groups_id`(`fee_groups_id`) USING BTREE,
  INDEX `feetype_id`(`feetype_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  CONSTRAINT `fee_groups_feetype_ibfk_1` FOREIGN KEY (`fee_session_group_id`) REFERENCES `fee_session_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fee_groups_feetype_ibfk_2` FOREIGN KEY (`fee_groups_id`) REFERENCES `fee_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fee_groups_feetype_ibfk_3` FOREIGN KEY (`feetype_id`) REFERENCES `feetype` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fee_groups_feetype_ibfk_4` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fee_receipt_no
-- ----------------------------
DROP TABLE IF EXISTS `fee_receipt_no`;
CREATE TABLE `fee_receipt_no`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fee_session_groups
-- ----------------------------
DROP TABLE IF EXISTS `fee_session_groups`;
CREATE TABLE `fee_session_groups`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_groups_id` int(11) NULL DEFAULT NULL,
  `session_id` int(11) NULL DEFAULT NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fee_groups_id`(`fee_groups_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  CONSTRAINT `fee_session_groups_ibfk_1` FOREIGN KEY (`fee_groups_id`) REFERENCES `fee_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fee_session_groups_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for feemasters
-- ----------------------------
DROP TABLE IF EXISTS `feemasters`;
CREATE TABLE `feemasters`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NULL DEFAULT NULL,
  `feetype_id` int(11) NOT NULL,
  `class_id` int(11) NULL DEFAULT NULL,
  `amount` float(10, 2) NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `feetype_id`(`feetype_id`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  CONSTRAINT `feemasters_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `feemasters_ibfk_2` FOREIGN KEY (`feetype_id`) REFERENCES `feetype` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `feemasters_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fees_discounts
-- ----------------------------
DROP TABLE IF EXISTS `fees_discounts`;
CREATE TABLE `fees_discounts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `percentage` float(10, 2) NULL DEFAULT NULL,
  `amount` decimal(10, 2) NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  CONSTRAINT `fees_discounts_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for fees_reminder
-- ----------------------------
DROP TABLE IF EXISTS `fees_reminder`;
CREATE TABLE `fees_reminder`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reminder_type` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `day` int(2) NULL DEFAULT NULL,
  `is_active` int(1) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for feetype
-- ----------------------------
DROP TABLE IF EXISTS `feetype`;
CREATE TABLE `feetype`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `feecategory_id` int(11) NULL DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for filetypes
-- ----------------------------
DROP TABLE IF EXISTS `filetypes`;
CREATE TABLE `filetypes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_extension` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `file_mime` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `file_size` int(11) NOT NULL,
  `image_extension` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `image_mime` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `image_size` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for follow_up
-- ----------------------------
DROP TABLE IF EXISTS `follow_up`;
CREATE TABLE `follow_up`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `next_date` date NOT NULL,
  `response` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `followup_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `enquiry_id`(`enquiry_id`) USING BTREE,
  INDEX `followup_by`(`followup_by`) USING BTREE,
  CONSTRAINT `follow_up_ibfk_1` FOREIGN KEY (`enquiry_id`) REFERENCES `enquiry` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `follow_up_ibfk_2` FOREIGN KEY (`followup_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for front_cms_media_gallery
-- ----------------------------
DROP TABLE IF EXISTS `front_cms_media_gallery`;
CREATE TABLE `front_cms_media_gallery`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thumb_path` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dir_path` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `img_name` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thumb_name` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `file_size` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `vid_url` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `vid_title` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for front_cms_menu_items
-- ----------------------------
DROP TABLE IF EXISTS `front_cms_menu_items`;
CREATE TABLE `front_cms_menu_items`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `menu` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `ext_url` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `open_new_tab` int(11) NULL DEFAULT 0,
  `ext_url_link` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `weight` int(11) NULL DEFAULT NULL,
  `publish` int(11) NOT NULL DEFAULT 0,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `menu_id`(`menu_id`) USING BTREE,
  CONSTRAINT `front_cms_menu_items_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `front_cms_menus` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for front_cms_menus
-- ----------------------------
DROP TABLE IF EXISTS `front_cms_menus`;
CREATE TABLE `front_cms_menus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `open_new_tab` int(10) NOT NULL DEFAULT 0,
  `ext_url` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ext_url_link` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `publish` int(11) NOT NULL DEFAULT 0,
  `content_type` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'manual',
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for front_cms_page_contents
-- ----------------------------
DROP TABLE IF EXISTS `front_cms_page_contents`;
CREATE TABLE `front_cms_page_contents`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NULL DEFAULT NULL,
  `content_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `page_id`(`page_id`) USING BTREE,
  CONSTRAINT `front_cms_page_contents_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `front_cms_pages` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for front_cms_pages
-- ----------------------------
DROP TABLE IF EXISTS `front_cms_pages`;
CREATE TABLE `front_cms_pages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_type` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'manual',
  `is_homepage` int(1) NULL DEFAULT 0,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `meta_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_keyword` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `feature_image` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `publish_date` date NULL DEFAULT NULL,
  `publish` int(10) NULL DEFAULT 0,
  `sidebar` int(10) NULL DEFAULT 0,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for front_cms_program_photos
-- ----------------------------
DROP TABLE IF EXISTS `front_cms_program_photos`;
CREATE TABLE `front_cms_program_photos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NULL DEFAULT NULL,
  `media_gallery_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `program_id`(`program_id`) USING BTREE,
  CONSTRAINT `front_cms_program_photos_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `front_cms_programs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for front_cms_programs
-- ----------------------------
DROP TABLE IF EXISTS `front_cms_programs`;
CREATE TABLE `front_cms_programs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `event_start` date NULL DEFAULT NULL,
  `event_end` date NULL DEFAULT NULL,
  `event_venue` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `meta_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `meta_keyword` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `feature_image` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `publish_date` date NULL DEFAULT NULL,
  `publish` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `sidebar` int(10) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for front_cms_settings
-- ----------------------------
DROP TABLE IF EXISTS `front_cms_settings`;
CREATE TABLE `front_cms_settings`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active_rtl` int(10) NULL DEFAULT 0,
  `is_active_front_cms` int(11) NULL DEFAULT 0,
  `is_active_sidebar` int(1) NULL DEFAULT 0,
  `logo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_us_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `complain_form_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sidebar_options` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `whatsapp_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fb_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `twitter_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `youtube_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `google_plus` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `instagram_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pinterest_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `linkedin_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `google_analytics` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `footer_text` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cookie_consent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fav_icon` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for gateway_ins
-- ----------------------------
DROP TABLE IF EXISTS `gateway_ins`;
CREATE TABLE `gateway_ins`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `online_admission_id` int(11) NULL DEFAULT NULL,
  `gateway_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `module_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unique_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parameter_details` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `online_admission_id`(`online_admission_id`) USING BTREE,
  CONSTRAINT `gateway_ins_ibfk_1` FOREIGN KEY (`online_admission_id`) REFERENCES `online_admissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for gateway_ins_response
-- ----------------------------
DROP TABLE IF EXISTS `gateway_ins_response`;
CREATE TABLE `gateway_ins_response`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_ins_id` int(11) NULL DEFAULT NULL,
  `posted_data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `response` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `gateway_ins_id`(`gateway_ins_id`) USING BTREE,
  CONSTRAINT `gateway_ins_response_ibfk_1` FOREIGN KEY (`gateway_ins_id`) REFERENCES `gateway_ins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for general_calls
-- ----------------------------
DROP TABLE IF EXISTS `general_calls`;
CREATE TABLE `general_calls`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `follow_up_date` date NOT NULL,
  `call_duration` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `call_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for grades
-- ----------------------------
DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_type` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `point` float(10, 1) NULL DEFAULT NULL,
  `mark_from` float(10, 2) NULL DEFAULT NULL,
  `mark_upto` float(10, 2) NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for homework
-- ----------------------------
DROP TABLE IF EXISTS `homework`;
CREATE TABLE `homework`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `session_id` int(10) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `subject_group_subject_id` int(11) NULL DEFAULT NULL,
  `subject_id` int(11) NULL DEFAULT NULL,
  `homework_date` date NOT NULL,
  `submit_date` date NOT NULL,
  `marks` float(10, 2) NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `create_date` date NOT NULL,
  `evaluation_date` date NULL DEFAULT NULL,
  `document` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `evaluated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `subject_group_subject_id`(`subject_group_subject_id`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  INDEX `section_id`(`section_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  INDEX `subject_id`(`subject_id`) USING BTREE,
  INDEX `evaluated_by`(`evaluated_by`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  CONSTRAINT `homework_ibfk_1` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `homework_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `homework_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `homework_ibfk_4` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `homework_ibfk_5` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `homework_ibfk_6` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `homework_ibfk_7` FOREIGN KEY (`evaluated_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `homework_ibfk_8` FOREIGN KEY (`created_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for homework_evaluation
-- ----------------------------
DROP TABLE IF EXISTS `homework_evaluation`;
CREATE TABLE `homework_evaluation`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `marks` float(10, 2) NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `homework_id`(`homework_id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  CONSTRAINT `homework_evaluation_ibfk_1` FOREIGN KEY (`homework_id`) REFERENCES `homework` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `homework_evaluation_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `homework_evaluation_ibfk_3` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hostel
-- ----------------------------
DROP TABLE IF EXISTS `hostel`;
CREATE TABLE `hostel`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostel_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `intake` int(11) NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for hostel_rooms
-- ----------------------------
DROP TABLE IF EXISTS `hostel_rooms`;
CREATE TABLE `hostel_rooms`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostel_id` int(11) NULL DEFAULT NULL,
  `room_type_id` int(11) NULL DEFAULT NULL,
  `room_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_of_bed` int(11) NULL DEFAULT NULL,
  `cost_per_bed` float(10, 2) NULL DEFAULT 0.00,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `hostel_id`(`hostel_id`) USING BTREE,
  INDEX `room_type_id`(`room_type_id`) USING BTREE,
  CONSTRAINT `hostel_rooms_ibfk_1` FOREIGN KEY (`hostel_id`) REFERENCES `hostel` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `hostel_rooms_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for id_card
-- ----------------------------
DROP TABLE IF EXISTS `id_card`;
CREATE TABLE `id_card`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `school_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `school_address` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `background` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `logo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sign_image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `enable_vertical_card` int(11) NOT NULL DEFAULT 0,
  `header_color` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `enable_admission_no` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_student_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_class` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_fathers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_mothers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_address` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_phone` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_dob` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_blood_group` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_student_barcode` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=disable,1=enable',
  `status` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for income
-- ----------------------------
DROP TABLE IF EXISTS `income`;
CREATE TABLE `income`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `income_head_id` int(11) NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `invoice_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `amount` float(10, 2) NULL DEFAULT 0.00,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'yes',
  `documents` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_deleted` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `income_head_id`(`income_head_id`) USING BTREE,
  CONSTRAINT `income_ibfk_1` FOREIGN KEY (`income_head_id`) REFERENCES `income_head` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for income_head
-- ----------------------------
DROP TABLE IF EXISTS `income_head`;
CREATE TABLE `income_head`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `income_category` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'yes',
  `is_deleted` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_category_id` int(11) NULL DEFAULT NULL,
  `item_store_id` int(11) NULL DEFAULT NULL,
  `item_supplier_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unit` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `item_photo` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quantity` int(100) NOT NULL,
  `date` date NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `item_category_id`(`item_category_id`) USING BTREE,
  INDEX `item_store_id`(`item_store_id`) USING BTREE,
  INDEX `item_supplier_id`(`item_supplier_id`) USING BTREE,
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `item_ibfk_2` FOREIGN KEY (`item_store_id`) REFERENCES `item_store` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `item_ibfk_3` FOREIGN KEY (`item_supplier_id`) REFERENCES `item_supplier` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for item_category
-- ----------------------------
DROP TABLE IF EXISTS `item_category`;
CREATE TABLE `item_category`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `item_category` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'yes',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for item_issue
-- ----------------------------
DROP TABLE IF EXISTS `item_issue`;
CREATE TABLE `item_issue`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_type` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `issue_to` int(11) NOT NULL,
  `issue_by` int(11) NULL DEFAULT NULL,
  `issue_date` date NULL DEFAULT NULL,
  `return_date` date NULL DEFAULT NULL,
  `item_category_id` int(11) NULL DEFAULT NULL,
  `item_id` int(11) NULL DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_returned` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `item_id`(`item_id`) USING BTREE,
  INDEX `item_category_id`(`item_category_id`) USING BTREE,
  INDEX `issue_to`(`issue_to`) USING BTREE,
  INDEX `issue_by`(`issue_by`) USING BTREE,
  CONSTRAINT `item_issue_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `item_issue_ibfk_2` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `item_issue_ibfk_3` FOREIGN KEY (`issue_to`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `item_issue_ibfk_4` FOREIGN KEY (`issue_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for item_stock
-- ----------------------------
DROP TABLE IF EXISTS `item_stock`;
CREATE TABLE `item_stock`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NULL DEFAULT NULL,
  `supplier_id` int(11) NULL DEFAULT NULL,
  `store_id` int(11) NULL DEFAULT NULL,
  `symbol` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '+',
  `quantity` int(11) NULL DEFAULT NULL,
  `purchase_price` float(10, 2) NOT NULL,
  `date` date NOT NULL,
  `attachment` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `item_id`(`item_id`) USING BTREE,
  INDEX `supplier_id`(`supplier_id`) USING BTREE,
  INDEX `store_id`(`store_id`) USING BTREE,
  CONSTRAINT `item_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `item_stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `item_supplier` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `item_stock_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `item_store` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for item_store
-- ----------------------------
DROP TABLE IF EXISTS `item_store`;
CREATE TABLE `item_store`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `item_store` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for item_supplier
-- ----------------------------
DROP TABLE IF EXISTS `item_supplier`;
CREATE TABLE `item_supplier`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `item_supplier` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact_person_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact_person_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact_person_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for languages
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `short_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `country_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_rtl` int(1) NOT NULL,
  `is_deleted` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'yes',
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 95 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for leave_types
-- ----------------------------
DROP TABLE IF EXISTS `leave_types`;
CREATE TABLE `leave_types`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `type`(`type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lesson
-- ----------------------------
DROP TABLE IF EXISTS `lesson`;
CREATE TABLE `lesson`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `subject_group_subject_id` int(11) NOT NULL,
  `subject_group_class_sections_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `subject_group_subject_id`(`subject_group_subject_id`) USING BTREE,
  INDEX `subject_group_class_sections_id`(`subject_group_class_sections_id`) USING BTREE,
  CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `lesson_ibfk_2` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `lesson_ibfk_3` FOREIGN KEY (`subject_group_class_sections_id`) REFERENCES `subject_group_class_sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for lesson_plan_forum
-- ----------------------------
DROP TABLE IF EXISTS `lesson_plan_forum`;
CREATE TABLE `lesson_plan_forum`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_syllabus_id` int(11) NOT NULL,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'staff,student',
  `staff_id` int(11) NULL DEFAULT NULL,
  `student_id` int(11) NULL DEFAULT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `subject_syllabus_id`(`subject_syllabus_id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  CONSTRAINT `lesson_plan_forum_ibfk_1` FOREIGN KEY (`subject_syllabus_id`) REFERENCES `subject_syllabus` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `lesson_plan_forum_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `lesson_plan_forum_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for libarary_members
-- ----------------------------
DROP TABLE IF EXISTS `libarary_members`;
CREATE TABLE `libarary_members`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `library_card_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `member_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `member_id` int(11) NULL DEFAULT NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `record_id` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `action` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ip_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `platform` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `agent` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 111 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for mark_divisions
-- ----------------------------
DROP TABLE IF EXISTS `mark_divisions`;
CREATE TABLE `mark_divisions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `percentage_from` float(10, 2) NULL DEFAULT NULL,
  `percentage_to` float(10, 2) NULL DEFAULT NULL,
  `is_active` int(10) NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `template_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email_template_id` int(11) NULL DEFAULT NULL,
  `sms_template_id` int(11) NULL DEFAULT NULL,
  `send_through` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `send_mail` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `send_sms` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `is_group` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `is_individual` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `is_class` int(10) NOT NULL DEFAULT 0,
  `is_schedule` int(1) NOT NULL,
  `sent` int(11) NULL DEFAULT NULL,
  `schedule_date_time` datetime NULL DEFAULT NULL,
  `group_list` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `user_list` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `schedule_class` int(11) NULL DEFAULT NULL,
  `schedule_section` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `version` bigint(20) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for notification_roles
-- ----------------------------
DROP TABLE IF EXISTS `notification_roles`;
CREATE TABLE `notification_roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_notification_id` int(11) NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `send_notification_id`(`send_notification_id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  CONSTRAINT `notification_roles_ibfk_1` FOREIGN KEY (`send_notification_id`) REFERENCES `send_notification` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `notification_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for notification_setting
-- ----------------------------
DROP TABLE IF EXISTS `notification_setting`;
CREATE TABLE `notification_setting`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_mail` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `is_sms` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `is_notification` int(11) NOT NULL DEFAULT 0,
  `display_notification` int(11) NOT NULL DEFAULT 0,
  `display_sms` int(11) NOT NULL DEFAULT 1,
  `is_student_recipient` int(1) NULL DEFAULT NULL,
  `is_guardian_recipient` int(1) NULL DEFAULT NULL,
  `is_staff_recipient` int(1) NULL DEFAULT NULL,
  `display_student_recipient` int(1) NULL DEFAULT NULL,
  `display_guardian_recipient` int(1) NULL DEFAULT NULL,
  `display_staff_recipient` int(1) NULL DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `template_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `template` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `variables` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for offline_fees_payments
-- ----------------------------
DROP TABLE IF EXISTS `offline_fees_payments`;
CREATE TABLE `offline_fees_payments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `student_fees_master_id` int(11) NULL DEFAULT NULL,
  `fee_groups_feetype_id` int(11) NULL DEFAULT NULL,
  `student_transport_fee_id` int(11) NULL DEFAULT NULL,
  `payment_date` date NULL DEFAULT NULL,
  `bank_from` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bank_account_transferred` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `reference` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `amount` float(10, 2) NULL DEFAULT NULL,
  `submit_date` datetime NULL DEFAULT NULL,
  `approve_date` datetime NULL DEFAULT NULL,
  `attachment` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `reply` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `approved_by` int(11) NULL DEFAULT NULL,
  `is_active` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_fees_master_id`(`student_fees_master_id`) USING BTREE,
  INDEX `fee_groups_feetype_id`(`fee_groups_feetype_id`) USING BTREE,
  INDEX `student_transport_fee_id`(`student_transport_fee_id`) USING BTREE,
  INDEX `offline_fees_payments_ibfk_4`(`approved_by`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  CONSTRAINT `offline_fees_payments_ibfk_1` FOREIGN KEY (`student_fees_master_id`) REFERENCES `student_fees_master` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `offline_fees_payments_ibfk_2` FOREIGN KEY (`fee_groups_feetype_id`) REFERENCES `fee_groups_feetype` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `offline_fees_payments_ibfk_3` FOREIGN KEY (`student_transport_fee_id`) REFERENCES `student_transport_fees` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `offline_fees_payments_ibfk_4` FOREIGN KEY (`approved_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `offline_fees_payments_ibfk_5` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for online_admission_custom_field_value
-- ----------------------------
DROP TABLE IF EXISTS `online_admission_custom_field_value`;
CREATE TABLE `online_admission_custom_field_value`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `belong_table_id` int(11) NULL DEFAULT NULL,
  `custom_field_id` int(11) NULL DEFAULT NULL,
  `field_value` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `custom_field_id`(`custom_field_id`) USING BTREE,
  INDEX `idx_belong_table_id`(`belong_table_id`) USING BTREE,
  INDEX `idx_field_value`(`field_value`(200)) USING BTREE,
  CONSTRAINT `online_admission_custom_field_value_ibfk_1` FOREIGN KEY (`custom_field_id`) REFERENCES `custom_fields` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for online_admission_fields
-- ----------------------------
DROP TABLE IF EXISTS `online_admission_fields`;
CREATE TABLE `online_admission_fields`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for online_admission_payment
-- ----------------------------
DROP TABLE IF EXISTS `online_admission_payment`;
CREATE TABLE `online_admission_payment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `online_admission_id` int(11) NOT NULL,
  `paid_amount` float(10, 2) NOT NULL,
  `payment_mode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `transaction_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `note` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `online_admission_id`(`online_admission_id`) USING BTREE,
  CONSTRAINT `online_admission_payment_ibfk_1` FOREIGN KEY (`online_admission_id`) REFERENCES `online_admissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for online_admissions
-- ----------------------------
DROP TABLE IF EXISTS `online_admissions`;
CREATE TABLE `online_admissions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admission_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `roll_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `reference_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admission_date` date NULL DEFAULT NULL,
  `firstname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `middlename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rte` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mobileno` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pincode` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cast` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dob` date NULL DEFAULT NULL,
  `gender` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `current_address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `permanent_address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  `class_section_id` int(11) NULL DEFAULT NULL,
  `route_id` int(11) NOT NULL,
  `school_house_id` int(11) NULL DEFAULT NULL,
  `blood_group` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `vehroute_id` int(11) NOT NULL,
  `hostel_room_id` int(11) NULL DEFAULT NULL,
  `adhar_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `samagra_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bank_account_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bank_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ifsc_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guardian_is` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `father_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `father_phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `father_occupation` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mother_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mother_phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mother_occupation` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guardian_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guardian_relation` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guardian_phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guardian_occupation` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `guardian_address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `guardian_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `father_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mother_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `guardian_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_enroll` int(255) NULL DEFAULT 0,
  `previous_school` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `height` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `weight` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `form_status` int(11) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `measurement_date` date NULL DEFAULT NULL,
  `app_key` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `document` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `submit_date` date NULL DEFAULT NULL,
  `disable_at` date NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `class_section_id`(`class_section_id`) USING BTREE,
  INDEX `category_id`(`category_id`) USING BTREE,
  INDEX `hostel_room_id`(`hostel_room_id`) USING BTREE,
  INDEX `school_house_id`(`school_house_id`) USING BTREE,
  INDEX `idx_reference_no`(`reference_no`) USING BTREE,
  INDEX `idx_mobileno`(`mobileno`) USING BTREE,
  CONSTRAINT `online_admissions_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `online_admissions_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `online_admissions_ibfk_3` FOREIGN KEY (`hostel_room_id`) REFERENCES `hostel_rooms` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `online_admissions_ibfk_4` FOREIGN KEY (`school_house_id`) REFERENCES `school_houses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for onlineexam
-- ----------------------------
DROP TABLE IF EXISTS `onlineexam`;
CREATE TABLE `onlineexam`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NULL DEFAULT NULL,
  `exam` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `attempt` int(11) NOT NULL,
  `exam_from` datetime NULL DEFAULT NULL,
  `exam_to` datetime NULL DEFAULT NULL,
  `is_quiz` int(11) NOT NULL DEFAULT 0,
  `auto_publish_date` datetime NULL DEFAULT NULL,
  `time_from` time NULL DEFAULT NULL,
  `time_to` time NULL DEFAULT NULL,
  `duration` time NOT NULL,
  `passing_percentage` float NOT NULL DEFAULT 0,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `publish_result` int(11) NOT NULL DEFAULT 0,
  `answer_word_count` int(11) NOT NULL DEFAULT -1,
  `is_active` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `is_marks_display` int(11) NOT NULL DEFAULT 0,
  `is_neg_marking` int(11) NOT NULL DEFAULT 0,
  `is_random_question` int(11) NOT NULL DEFAULT 0,
  `is_rank_generated` int(1) NOT NULL DEFAULT 0,
  `publish_exam_notification` int(1) NOT NULL,
  `publish_result_notification` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  CONSTRAINT `onlineexam_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for onlineexam_attempts
-- ----------------------------
DROP TABLE IF EXISTS `onlineexam_attempts`;
CREATE TABLE `onlineexam_attempts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onlineexam_student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `onlineexam_student_id`(`onlineexam_student_id`) USING BTREE,
  CONSTRAINT `onlineexam_attempts_ibfk_1` FOREIGN KEY (`onlineexam_student_id`) REFERENCES `onlineexam_students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for onlineexam_questions
-- ----------------------------
DROP TABLE IF EXISTS `onlineexam_questions`;
CREATE TABLE `onlineexam_questions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NULL DEFAULT NULL,
  `onlineexam_id` int(11) NULL DEFAULT NULL,
  `session_id` int(11) NULL DEFAULT NULL,
  `marks` float(10, 2) NOT NULL DEFAULT 0.00,
  `neg_marks` float(10, 2) NULL DEFAULT 0.00,
  `is_active` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `onlineexam_id`(`onlineexam_id`) USING BTREE,
  INDEX `question_id`(`question_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  CONSTRAINT `onlineexam_questions_ibfk_1` FOREIGN KEY (`onlineexam_id`) REFERENCES `onlineexam` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `onlineexam_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `onlineexam_questions_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for onlineexam_student_results
-- ----------------------------
DROP TABLE IF EXISTS `onlineexam_student_results`;
CREATE TABLE `onlineexam_student_results`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onlineexam_student_id` int(11) NOT NULL,
  `onlineexam_question_id` int(11) NOT NULL,
  `select_option` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `marks` float(10, 2) NOT NULL DEFAULT 0.00,
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `attachment_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `attachment_upload_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `onlineexam_student_id`(`onlineexam_student_id`) USING BTREE,
  INDEX `onlineexam_question_id`(`onlineexam_question_id`) USING BTREE,
  CONSTRAINT `onlineexam_student_results_ibfk_1` FOREIGN KEY (`onlineexam_student_id`) REFERENCES `onlineexam_students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `onlineexam_student_results_ibfk_2` FOREIGN KEY (`onlineexam_question_id`) REFERENCES `onlineexam_questions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for onlineexam_students
-- ----------------------------
DROP TABLE IF EXISTS `onlineexam_students`;
CREATE TABLE `onlineexam_students`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onlineexam_id` int(11) NULL DEFAULT NULL,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `is_attempted` int(1) NOT NULL DEFAULT 0,
  `rank` int(1) NULL DEFAULT 0,
  `quiz_attempted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `onlineexam_id`(`onlineexam_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  CONSTRAINT `onlineexam_students_ibfk_1` FOREIGN KEY (`onlineexam_id`) REFERENCES `onlineexam` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `onlineexam_students_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for payment_settings
-- ----------------------------
DROP TABLE IF EXISTS `payment_settings`;
CREATE TABLE `payment_settings`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `api_username` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `api_secret_key` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `salt` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `api_publishable_key` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `api_password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `api_signature` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `api_email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `paypal_demo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `account_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `gateway_mode` int(11) NOT NULL COMMENT '0 Testing, 1 live',
  `paytm_website` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `paytm_industrytype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for payslip_allowance
-- ----------------------------
DROP TABLE IF EXISTS `payslip_allowance`;
CREATE TABLE `payslip_allowance`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payslip_id` int(11) NOT NULL,
  `allowance_type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `amount` float NOT NULL,
  `staff_id` int(11) NOT NULL,
  `cal_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  INDEX `payslip_id`(`payslip_id`) USING BTREE,
  CONSTRAINT `payslip_allowance_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `payslip_allowance_ibfk_2` FOREIGN KEY (`payslip_id`) REFERENCES `staff_payslip` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permission_category
-- ----------------------------
DROP TABLE IF EXISTS `permission_category`;
CREATE TABLE `permission_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perm_group_id` int(11) NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `short_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `enable_view` int(11) NULL DEFAULT 0,
  `enable_add` int(11) NULL DEFAULT 0,
  `enable_edit` int(11) NULL DEFAULT 0,
  `enable_delete` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_short_code`(`short_code`) USING BTREE,
  INDEX `perm_group_id`(`perm_group_id`) USING BTREE,
  CONSTRAINT `permission_category_ibfk_1` FOREIGN KEY (`perm_group_id`) REFERENCES `permission_group` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13003 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permission_group
-- ----------------------------
DROP TABLE IF EXISTS `permission_group`;
CREATE TABLE `permission_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `short_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `system` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1301 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permission_student
-- ----------------------------
DROP TABLE IF EXISTS `permission_student`;
CREATE TABLE `permission_student`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `short_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `system` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `group_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `group_id`(`group_id`) USING BTREE,
  CONSTRAINT `permission_student_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `permission_group` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 901 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pickup_point
-- ----------------------------
DROP TABLE IF EXISTS `pickup_point`;
CREATE TABLE `pickup_point`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `latitude` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `longitude` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for print_headerfooter
-- ----------------------------
DROP TABLE IF EXISTS `print_headerfooter`;
CREATE TABLE `print_headerfooter`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `print_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `header_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `footer_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for qr_code_settings
-- ----------------------------
DROP TABLE IF EXISTS `qr_code_settings`;
CREATE TABLE `qr_code_settings`  (
  `id` int(11) NOT NULL,
  `camera_type` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `auto_attendance` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NULL DEFAULT NULL,
  `subject_id` int(11) NULL DEFAULT NULL,
  `question_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `level` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NULL DEFAULT NULL,
  `class_section_id` int(11) NULL DEFAULT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `opt_a` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `opt_b` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `opt_c` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `opt_d` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `opt_e` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `correct` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `descriptive_word_limit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `subject_id`(`subject_id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  INDEX `section_id`(`section_id`) USING BTREE,
  INDEX `class_section_id`(`class_section_id`) USING BTREE,
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `questions_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `questions_ibfk_4` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `questions_ibfk_5` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `questions_ibfk_6` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for read_notification
-- ----------------------------
DROP TABLE IF EXISTS `read_notification`;
CREATE TABLE `read_notification`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NULL DEFAULT NULL,
  `parent_id` int(10) NULL DEFAULT NULL,
  `staff_id` int(11) NULL DEFAULT NULL,
  `notification_id` int(11) NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `notification_id`(`notification_id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  CONSTRAINT `read_notification_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `send_notification` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `read_notification_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `read_notification_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for reference
-- ----------------------------
DROP TABLE IF EXISTS `reference`;
CREATE TABLE `reference`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `slug` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `is_superadmin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for roles_permissions
-- ----------------------------
DROP TABLE IF EXISTS `roles_permissions`;
CREATE TABLE `roles_permissions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NULL DEFAULT NULL,
  `perm_cat_id` int(11) NULL DEFAULT NULL,
  `can_view` int(11) NULL DEFAULT NULL,
  `can_add` int(11) NULL DEFAULT NULL,
  `can_edit` int(11) NULL DEFAULT NULL,
  `can_delete` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  INDEX `perm_cat_id`(`perm_cat_id`) USING BTREE,
  CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`perm_cat_id`) REFERENCES `permission_category` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1522 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for room_types
-- ----------------------------
DROP TABLE IF EXISTS `room_types`;
CREATE TABLE `room_types`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for route_pickup_point
-- ----------------------------
DROP TABLE IF EXISTS `route_pickup_point`;
CREATE TABLE `route_pickup_point`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transport_route_id` int(11) NOT NULL,
  `pickup_point_id` int(11) NOT NULL,
  `fees` float(10, 2) NULL DEFAULT 0.00,
  `destination_distance` float(10, 1) NULL DEFAULT 0.0,
  `pickup_time` time NULL DEFAULT NULL,
  `order_number` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `transport_route_id`(`transport_route_id`) USING BTREE,
  INDEX `pickup_point_id`(`pickup_point_id`) USING BTREE,
  CONSTRAINT `route_pickup_point_ibfk_1` FOREIGN KEY (`transport_route_id`) REFERENCES `transport_route` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `route_pickup_point_ibfk_2` FOREIGN KEY (`pickup_point_id`) REFERENCES `pickup_point` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sch_settings
-- ----------------------------
DROP TABLE IF EXISTS `sch_settings`;
CREATE TABLE `sch_settings`  (
  `id` int(11) NOT NULL,
  `base_url` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `folder_path` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `biometric` int(11) NULL DEFAULT 0,
  `biometric_device` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `lang_id` int(11) NULL DEFAULT NULL,
  `languages` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dise_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date_format` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time_format` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `currency` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `currency_symbol` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_rtl` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'disabled',
  `is_duplicate_fees_invoice` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `collect_back_date_fees` int(11) NOT NULL,
  `single_page_print` int(1) NULL DEFAULT 0,
  `timezone` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'UTC',
  `session_id` int(11) NULL DEFAULT NULL,
  `cron_secret_key` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `currency_place` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'before_number',
  `currency_format` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `class_teacher` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `start_month` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `attendence_type` int(10) NOT NULL DEFAULT 0,
  `low_attendance_limit` float(10, 2) NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin_small_logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin_login_page_background` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_login_page_background` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `theme` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'default.jpg',
  `fee_due_days` int(3) NULL DEFAULT 0,
  `adm_auto_insert` int(1) NOT NULL DEFAULT 1,
  `adm_prefix` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'ssadm19/20',
  `adm_start_from` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `adm_no_digit` int(10) NOT NULL DEFAULT 6,
  `adm_update_status` int(11) NOT NULL DEFAULT 0,
  `staffid_auto_insert` int(11) NOT NULL DEFAULT 1,
  `staffid_prefix` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'staffss/19/20',
  `staffid_start_from` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `staffid_no_digit` int(11) NOT NULL DEFAULT 6,
  `staffid_update_status` int(11) NOT NULL DEFAULT 0,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `online_admission` int(1) NULL DEFAULT 0,
  `online_admission_payment` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `online_admission_amount` float NOT NULL,
  `online_admission_instruction` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `online_admission_conditions` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `online_admission_application_form` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `exam_result` int(11) NOT NULL,
  `is_blood_group` int(10) NOT NULL DEFAULT 1,
  `is_student_house` int(10) NOT NULL DEFAULT 1,
  `roll_no` int(11) NOT NULL DEFAULT 1,
  `category` int(11) NOT NULL,
  `religion` int(11) NOT NULL DEFAULT 1,
  `cast` int(11) NOT NULL DEFAULT 1,
  `mobile_no` int(11) NOT NULL DEFAULT 1,
  `student_email` int(11) NOT NULL DEFAULT 1,
  `admission_date` int(11) NOT NULL DEFAULT 1,
  `lastname` int(11) NOT NULL,
  `middlename` int(11) NOT NULL DEFAULT 1,
  `student_photo` int(11) NOT NULL DEFAULT 1,
  `student_height` int(11) NOT NULL DEFAULT 1,
  `student_weight` int(11) NOT NULL DEFAULT 1,
  `measurement_date` int(11) NOT NULL DEFAULT 1,
  `father_name` int(11) NOT NULL DEFAULT 1,
  `father_phone` int(11) NOT NULL DEFAULT 1,
  `father_occupation` int(11) NOT NULL DEFAULT 1,
  `father_pic` int(11) NOT NULL DEFAULT 1,
  `mother_name` int(11) NOT NULL DEFAULT 1,
  `mother_phone` int(11) NOT NULL DEFAULT 1,
  `mother_occupation` int(11) NOT NULL DEFAULT 1,
  `mother_pic` int(11) NOT NULL DEFAULT 1,
  `guardian_name` int(1) NOT NULL,
  `guardian_relation` int(11) NOT NULL DEFAULT 1,
  `guardian_phone` int(1) NOT NULL,
  `guardian_email` int(11) NOT NULL DEFAULT 1,
  `guardian_pic` int(11) NOT NULL DEFAULT 1,
  `guardian_occupation` int(1) NOT NULL,
  `guardian_address` int(11) NOT NULL DEFAULT 1,
  `current_address` int(11) NOT NULL DEFAULT 1,
  `permanent_address` int(11) NOT NULL DEFAULT 1,
  `route_list` int(11) NOT NULL DEFAULT 1,
  `hostel_id` int(11) NOT NULL DEFAULT 1,
  `bank_account_no` int(11) NOT NULL DEFAULT 1,
  `ifsc_code` int(1) NOT NULL,
  `bank_name` int(1) NOT NULL,
  `national_identification_no` int(11) NOT NULL DEFAULT 1,
  `local_identification_no` int(11) NOT NULL DEFAULT 1,
  `rte` int(11) NOT NULL DEFAULT 1,
  `previous_school_details` int(11) NOT NULL DEFAULT 1,
  `student_note` int(11) NOT NULL DEFAULT 1,
  `upload_documents` int(11) NOT NULL DEFAULT 1,
  `student_barcode` int(11) NOT NULL DEFAULT 1,
  `staff_designation` int(11) NOT NULL DEFAULT 1,
  `staff_department` int(11) NOT NULL DEFAULT 1,
  `staff_last_name` int(11) NOT NULL DEFAULT 1,
  `staff_father_name` int(11) NOT NULL DEFAULT 1,
  `staff_mother_name` int(11) NOT NULL DEFAULT 1,
  `staff_date_of_joining` int(11) NOT NULL DEFAULT 1,
  `staff_phone` int(11) NOT NULL DEFAULT 1,
  `staff_emergency_contact` int(11) NOT NULL DEFAULT 1,
  `staff_marital_status` int(11) NOT NULL DEFAULT 1,
  `staff_photo` int(11) NOT NULL DEFAULT 1,
  `staff_current_address` int(11) NOT NULL DEFAULT 1,
  `staff_permanent_address` int(11) NOT NULL DEFAULT 1,
  `staff_qualification` int(11) NOT NULL DEFAULT 1,
  `staff_work_experience` int(11) NOT NULL DEFAULT 1,
  `staff_note` int(11) NOT NULL DEFAULT 1,
  `staff_epf_no` int(11) NOT NULL DEFAULT 1,
  `staff_basic_salary` int(11) NOT NULL DEFAULT 1,
  `staff_contract_type` int(11) NOT NULL DEFAULT 1,
  `staff_work_shift` int(11) NOT NULL DEFAULT 1,
  `staff_work_location` int(11) NOT NULL DEFAULT 1,
  `staff_leaves` int(11) NOT NULL DEFAULT 1,
  `staff_account_details` int(11) NOT NULL DEFAULT 1,
  `staff_social_media` int(11) NOT NULL DEFAULT 1,
  `staff_upload_documents` int(11) NOT NULL DEFAULT 1,
  `staff_barcode` int(11) NOT NULL DEFAULT 1,
  `staff_notification_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mobile_api_url` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `app_primary_color_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `app_secondary_color_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admin_mobile_api_url` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin_app_primary_color_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin_app_secondary_color_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `app_logo` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `student_profile_edit` int(1) NOT NULL DEFAULT 0,
  `start_week` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `my_question` int(1) NOT NULL,
  `superadmin_restriction` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `student_timeline` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `calendar_event_reminder` int(2) NULL DEFAULT NULL,
  `event_reminder` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `student_login` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `parent_login` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `student_panel_login` int(1) NOT NULL DEFAULT 1,
  `parent_panel_login` int(1) NOT NULL DEFAULT 1,
  `is_student_feature_lock` int(1) NOT NULL DEFAULT 0,
  `maintenance_mode` int(1) NOT NULL DEFAULT 0,
  `lock_grace_period` int(10) NOT NULL DEFAULT 0,
  `is_offline_fee_payment` int(1) NOT NULL DEFAULT 0,
  `offline_bank_payment_instruction` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `scan_code_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'barcode',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `lang_id`(`lang_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for school_houses
-- ----------------------------
DROP TABLE IF EXISTS `school_houses`;
CREATE TABLE `school_houses`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(400) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sections
-- ----------------------------
DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for send_notification
-- ----------------------------
DROP TABLE IF EXISTS `send_notification`;
CREATE TABLE `send_notification`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `publish_date` date NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `attachment` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `visible_student` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `visible_staff` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `visible_parent` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_by` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_id` int(11) NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_id`(`created_id`) USING BTREE,
  CONSTRAINT `send_notification_ibfk_1` FOREIGN KEY (`created_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for share_content_for
-- ----------------------------
DROP TABLE IF EXISTS `share_content_for`;
CREATE TABLE `share_content_for`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `student_id` int(11) NULL DEFAULT NULL,
  `user_parent_id` int(11) NULL DEFAULT NULL,
  `staff_id` int(11) NULL DEFAULT NULL,
  `class_section_id` int(11) NULL DEFAULT NULL,
  `share_content_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `upload_content_id`(`share_content_id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  INDEX `class_section_id`(`class_section_id`) USING BTREE,
  INDEX `user_parent_id`(`user_parent_id`) USING BTREE,
  CONSTRAINT `share_content_for_ibfk_1` FOREIGN KEY (`share_content_id`) REFERENCES `share_contents` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `share_content_for_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `share_content_for_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `share_content_for_ibfk_4` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `share_content_for_ibfk_5` FOREIGN KEY (`user_parent_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for share_contents
-- ----------------------------
DROP TABLE IF EXISTS `share_contents`;
CREATE TABLE `share_contents`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_to` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `share_date` date NULL DEFAULT NULL,
  `valid_upto` date NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_by` int(10) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  CONSTRAINT `share_contents_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for share_upload_contents
-- ----------------------------
DROP TABLE IF EXISTS `share_upload_contents`;
CREATE TABLE `share_upload_contents`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_content_id` int(11) NULL DEFAULT NULL,
  `share_content_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `upload_content_id`(`upload_content_id`) USING BTREE,
  INDEX `share_content_id`(`share_content_id`) USING BTREE,
  CONSTRAINT `share_upload_contents_ibfk_1` FOREIGN KEY (`upload_content_id`) REFERENCES `upload_contents` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `share_upload_contents_ibfk_2` FOREIGN KEY (`share_content_id`) REFERENCES `share_contents` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sidebar_menus
-- ----------------------------
DROP TABLE IF EXISTS `sidebar_menus`;
CREATE TABLE `sidebar_menus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_group_id` int(10) NULL DEFAULT NULL,
  `icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `menu` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `activate_menu` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lang_key` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `system_level` int(3) NULL DEFAULT 0,
  `level` int(5) NULL DEFAULT NULL,
  `sidebar_display` int(1) NULL DEFAULT 0,
  `access_permissions` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `permission_group_id`(`permission_group_id`) USING BTREE,
  CONSTRAINT `sidebar_menus_ibfk_1` FOREIGN KEY (`permission_group_id`) REFERENCES `permission_group` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sidebar_sub_menus
-- ----------------------------
DROP TABLE IF EXISTS `sidebar_sub_menus`;
CREATE TABLE `sidebar_sub_menus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sidebar_menu_id` int(10) NULL DEFAULT NULL,
  `menu` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `key` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lang_key` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `level` int(5) NULL DEFAULT NULL,
  `access_permissions` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `permission_group_id` int(11) NULL DEFAULT NULL,
  `activate_controller` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'income',
  `activate_methods` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'index,edit',
  `addon_permission` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` int(1) NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sidebar_menu_id`(`sidebar_menu_id`) USING BTREE,
  INDEX `permission_group_id`(`permission_group_id`) USING BTREE,
  CONSTRAINT `sidebar_sub_menus_ibfk_1` FOREIGN KEY (`sidebar_menu_id`) REFERENCES `sidebar_menus` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `sidebar_sub_menus_ibfk_2` FOREIGN KEY (`permission_group_id`) REFERENCES `permission_group` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 403 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sms_config
-- ----------------------------
DROP TABLE IF EXISTS `sms_config`;
CREATE TABLE `sms_config`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `api_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `authkey` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `senderid` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `username` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'disabled',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sms_template
-- ----------------------------
DROP TABLE IF EXISTS `sms_template`;
CREATE TABLE `sms_template`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for source
-- ----------------------------
DROP TABLE IF EXISTS `source`;
CREATE TABLE `source`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lang_id` int(11) NOT NULL,
  `currency_id` int(11) NULL DEFAULT 0,
  `department` int(11) NULL DEFAULT NULL,
  `designation` int(11) NULL DEFAULT NULL,
  `qualification` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `work_exp` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `surname` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `father_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mother_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `emergency_contact_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dob` date NOT NULL,
  `marital_status` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date_of_joining` date NULL DEFAULT NULL,
  `date_of_leaving` date NULL DEFAULT NULL,
  `local_address` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `permanent_address` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `note` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `account_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bank_account_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bank_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ifsc_code` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bank_branch` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payscale` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `basic_salary` int(11) NULL DEFAULT NULL,
  `epf_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contract_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `shift` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `facebook` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `twitter` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `linkedin` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `instagram` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `resume` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `joining_letter` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `resignation_letter` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `other_document_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `other_document_file` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `verification_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `disable_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `employee_id`(`employee_id`) USING BTREE,
  INDEX `designation`(`designation`) USING BTREE,
  INDEX `department`(`department`) USING BTREE,
  CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`designation`) REFERENCES `staff_designation` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`department`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_attendance
-- ----------------------------
DROP TABLE IF EXISTS `staff_attendance`;
CREATE TABLE `staff_attendance`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `staff_attendance_type_id` int(11) NOT NULL,
  `biometric_attendence` int(11) NULL DEFAULT 0,
  `qrcode_attendance` int(11) NOT NULL DEFAULT 0,
  `biometric_device_data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `user_agent` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_staff_attendance_staff`(`staff_id`) USING BTREE,
  INDEX `FK_staff_attendance_staff_attendance_type`(`staff_attendance_type_id`) USING BTREE,
  CONSTRAINT `FK_staff_attendance_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `FK_staff_attendance_staff_attendance_type` FOREIGN KEY (`staff_attendance_type_id`) REFERENCES `staff_attendance_type` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_attendance_type
-- ----------------------------
DROP TABLE IF EXISTS `staff_attendance_type`;
CREATE TABLE `staff_attendance_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `key_value` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `for_qr_attendance` int(11) NOT NULL DEFAULT 1,
  `long_lang_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `long_name_style` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_designation
-- ----------------------------
DROP TABLE IF EXISTS `staff_designation`;
CREATE TABLE `staff_designation`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_id_card
-- ----------------------------
DROP TABLE IF EXISTS `staff_id_card`;
CREATE TABLE `staff_id_card`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `school_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `school_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `background` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `logo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sign_image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `header_color` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `enable_vertical_card` int(11) NOT NULL DEFAULT 0,
  `enable_staff_role` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_id` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_department` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_designation` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_fathers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_mothers_name` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_date_of_joining` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_permanent_address` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_dob` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_phone` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `enable_staff_barcode` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  `status` tinyint(1) NOT NULL COMMENT '0=disable,1=enable',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_leave_details
-- ----------------------------
DROP TABLE IF EXISTS `staff_leave_details`;
CREATE TABLE `staff_leave_details`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `alloted_leave` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_staff_leave_details_staff`(`staff_id`) USING BTREE,
  INDEX `FK_staff_leave_details_leave_types`(`leave_type_id`) USING BTREE,
  CONSTRAINT `FK_staff_leave_details_leave_types` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `FK_staff_leave_details_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_leave_request
-- ----------------------------
DROP TABLE IF EXISTS `staff_leave_request`;
CREATE TABLE `staff_leave_request`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `leave_days` int(11) NOT NULL,
  `employee_remark` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin_remark` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `applied_by` int(11) NULL DEFAULT NULL,
  `document_file` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_staff_leave_request_staff`(`staff_id`) USING BTREE,
  INDEX `FK_staff_leave_request_leave_types`(`leave_type_id`) USING BTREE,
  INDEX `applied_by`(`applied_by`) USING BTREE,
  CONSTRAINT `FK_staff_leave_request_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `staff_leave_request_ibfk_1` FOREIGN KEY (`applied_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `staff_leave_request_ibfk_2` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_payroll
-- ----------------------------
DROP TABLE IF EXISTS `staff_payroll`;
CREATE TABLE `staff_payroll`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `basic_salary` int(11) NOT NULL,
  `pay_scale` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `grade` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_payslip
-- ----------------------------
DROP TABLE IF EXISTS `staff_payslip`;
CREATE TABLE `staff_payslip`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `basic` float(10, 2) NOT NULL,
  `total_allowance` float(10, 2) NOT NULL,
  `total_deduction` float(10, 2) NOT NULL,
  `leave_deduction` int(11) NOT NULL,
  `tax` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `net_salary` float(10, 2) NOT NULL,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `month` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `year` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_mode` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `payment_date` date NOT NULL,
  `remark` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `generated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_staff_payslip_staff`(`staff_id`) USING BTREE,
  CONSTRAINT `FK_staff_payslip_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_rating
-- ----------------------------
DROP TABLE IF EXISTS `staff_rating`;
CREATE TABLE `staff_rating`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 decline, 1 Approve',
  `entrydt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_staff_rating_staff`(`staff_id`) USING BTREE,
  CONSTRAINT `FK_staff_rating_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_roles
-- ----------------------------
DROP TABLE IF EXISTS `staff_roles`;
CREATE TABLE `staff_roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NULL DEFAULT NULL,
  `staff_id` int(11) NULL DEFAULT NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  CONSTRAINT `FK_staff_roles_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `FK_staff_roles_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for staff_timeline
-- ----------------------------
DROP TABLE IF EXISTS `staff_timeline`;
CREATE TABLE `staff_timeline`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timeline_date` date NOT NULL,
  `description` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `document` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_staff_timeline_staff`(`staff_id`) USING BTREE,
  CONSTRAINT `FK_staff_timeline_staff` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_applyleave
-- ----------------------------
DROP TABLE IF EXISTS `student_applyleave`;
CREATE TABLE `student_applyleave`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `apply_date` date NOT NULL,
  `status` int(1) NOT NULL,
  `docs` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `reason` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `approve_by` int(11) NULL DEFAULT NULL,
  `approve_date` date NULL DEFAULT NULL,
  `request_type` int(11) NOT NULL COMMENT '0 student,1 staff',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  INDEX `approve_by`(`approve_by`) USING BTREE,
  CONSTRAINT `student_applyleave_ibfk_1` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_applyleave_ibfk_2` FOREIGN KEY (`approve_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_attendences
-- ----------------------------
DROP TABLE IF EXISTS `student_attendences`;
CREATE TABLE `student_attendences`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `biometric_attendence` int(11) NOT NULL DEFAULT 0,
  `qrcode_attendance` int(11) NOT NULL DEFAULT 0,
  `date` date NULL DEFAULT NULL,
  `attendence_type_id` int(11) NULL DEFAULT NULL,
  `remark` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `biometric_device_data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `user_agent` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  INDEX `attendence_type_id`(`attendence_type_id`) USING BTREE,
  CONSTRAINT `student_attendences_ibfk_1` FOREIGN KEY (`attendence_type_id`) REFERENCES `attendence_type` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_attendences_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_behaviour
-- ----------------------------
DROP TABLE IF EXISTS `student_behaviour`;
CREATE TABLE `student_behaviour`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_doc
-- ----------------------------
DROP TABLE IF EXISTS `student_doc`;
CREATE TABLE `student_doc`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NULL DEFAULT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `doc` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_student_id`(`student_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_edit_fields
-- ----------------------------
DROP TABLE IF EXISTS `student_edit_fields`;
CREATE TABLE `student_edit_fields`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_fees
-- ----------------------------
DROP TABLE IF EXISTS `student_fees`;
CREATE TABLE `student_fees`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `feemaster_id` int(11) NULL DEFAULT NULL,
  `amount` float(10, 2) NULL DEFAULT NULL,
  `amount_discount` float(10, 2) NOT NULL,
  `amount_fine` float(10, 2) NOT NULL DEFAULT 0.00,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `date` date NULL DEFAULT NULL,
  `payment_mode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `feemaster_id`(`feemaster_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  CONSTRAINT `student_fees_ibfk_1` FOREIGN KEY (`feemaster_id`) REFERENCES `feemasters` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_fees_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_fees_deposite
-- ----------------------------
DROP TABLE IF EXISTS `student_fees_deposite`;
CREATE TABLE `student_fees_deposite`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_fees_master_id` int(11) NULL DEFAULT NULL,
  `fee_groups_feetype_id` int(11) NULL DEFAULT NULL,
  `student_transport_fee_id` int(11) NULL DEFAULT NULL,
  `amount_detail` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_fees_master_id`(`student_fees_master_id`) USING BTREE,
  INDEX `fee_groups_feetype_id`(`fee_groups_feetype_id`) USING BTREE,
  INDEX `student_transport_fee_id`(`student_transport_fee_id`) USING BTREE,
  CONSTRAINT `student_fees_deposite_ibfk_1` FOREIGN KEY (`student_transport_fee_id`) REFERENCES `student_transport_fees` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_fees_deposite_ibfk_2` FOREIGN KEY (`student_fees_master_id`) REFERENCES `student_fees_master` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_fees_deposite_ibfk_3` FOREIGN KEY (`fee_groups_feetype_id`) REFERENCES `fee_groups_feetype` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_fees_discounts
-- ----------------------------
DROP TABLE IF EXISTS `student_fees_discounts`;
CREATE TABLE `student_fees_discounts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `fees_discount_id` int(11) NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'assigned',
  `payment_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  INDEX `fees_discount_id`(`fees_discount_id`) USING BTREE,
  CONSTRAINT `student_fees_discounts_ibfk_1` FOREIGN KEY (`fees_discount_id`) REFERENCES `fees_discounts` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_fees_discounts_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_fees_master
-- ----------------------------
DROP TABLE IF EXISTS `student_fees_master`;
CREATE TABLE `student_fees_master`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_system` int(1) NOT NULL DEFAULT 0,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `fee_session_group_id` int(11) NULL DEFAULT NULL,
  `amount` float(10, 2) NULL DEFAULT 0.00,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  INDEX `fee_session_group_id`(`fee_session_group_id`) USING BTREE,
  CONSTRAINT `student_fees_master_ibfk_1` FOREIGN KEY (`fee_session_group_id`) REFERENCES `fee_session_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_fees_master_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_fees_processing
-- ----------------------------
DROP TABLE IF EXISTS `student_fees_processing`;
CREATE TABLE `student_fees_processing`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_ins_id` int(11) NOT NULL,
  `fee_category` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `student_fees_master_id` int(11) NULL DEFAULT NULL,
  `fee_groups_feetype_id` int(11) NULL DEFAULT NULL,
  `student_transport_fee_id` int(11) NULL DEFAULT NULL,
  `amount_detail` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_fees_master_id`(`student_fees_master_id`) USING BTREE,
  INDEX `fee_groups_feetype_id`(`fee_groups_feetype_id`) USING BTREE,
  INDEX `student_transport_fee_id`(`student_transport_fee_id`) USING BTREE,
  INDEX `gateway_ins_id`(`gateway_ins_id`) USING BTREE,
  CONSTRAINT `student_fees_processing_ibfk_1` FOREIGN KEY (`student_fees_master_id`) REFERENCES `student_fees_master` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_fees_processing_ibfk_2` FOREIGN KEY (`student_transport_fee_id`) REFERENCES `student_transport_fees` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_fees_processing_ibfk_3` FOREIGN KEY (`fee_groups_feetype_id`) REFERENCES `fee_groups_feetype` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_fees_processing_ibfk_4` FOREIGN KEY (`gateway_ins_id`) REFERENCES `gateway_ins` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_incident_comments
-- ----------------------------
DROP TABLE IF EXISTS `student_incident_comments`;
CREATE TABLE `student_incident_comments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_incident_id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `staff_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_incident_comments_ibfk_1`(`student_incident_id`) USING BTREE,
  CONSTRAINT `student_incident_comments_ibfk_1` FOREIGN KEY (`student_incident_id`) REFERENCES `student_incidents` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_incidents
-- ----------------------------
DROP TABLE IF EXISTS `student_incidents`;
CREATE TABLE `student_incidents`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `incident_id` int(11) NOT NULL,
  `assign_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_incidents_ibfk_1`(`student_id`) USING BTREE,
  INDEX `student_incidents_ibfk_2`(`incident_id`) USING BTREE,
  CONSTRAINT `student_incidents_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_incidents_ibfk_2` FOREIGN KEY (`incident_id`) REFERENCES `student_behaviour` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_session
-- ----------------------------
DROP TABLE IF EXISTS `student_session`;
CREATE TABLE `student_session`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NULL DEFAULT NULL,
  `student_id` int(11) NULL DEFAULT NULL,
  `class_id` int(11) NULL DEFAULT NULL,
  `section_id` int(11) NULL DEFAULT NULL,
  `hostel_room_id` int(11) NULL DEFAULT NULL,
  `vehroute_id` int(10) NULL DEFAULT NULL,
  `route_pickup_point_id` int(11) NULL DEFAULT NULL,
  `transport_fees` float(10, 2) NOT NULL DEFAULT 0.00,
  `fees_discount` float(10, 2) NOT NULL DEFAULT 0.00,
  `is_leave` int(1) NOT NULL DEFAULT 0,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `is_alumni` int(11) NOT NULL,
  `default_login` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  INDEX `section_id`(`section_id`) USING BTREE,
  INDEX `student_session_ibfk_5`(`vehroute_id`) USING BTREE,
  INDEX `hostel_room_id`(`hostel_room_id`) USING BTREE,
  INDEX `student_session_ibfk_6`(`route_pickup_point_id`) USING BTREE,
  CONSTRAINT `student_session_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_session_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_session_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_session_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_session_ibfk_5` FOREIGN KEY (`vehroute_id`) REFERENCES `vehicle_routes` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `student_session_ibfk_6` FOREIGN KEY (`route_pickup_point_id`) REFERENCES `route_pickup_point` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `student_session_ibfk_7` FOREIGN KEY (`hostel_room_id`) REFERENCES `hostel_rooms` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_subject_attendances
-- ----------------------------
DROP TABLE IF EXISTS `student_subject_attendances`;
CREATE TABLE `student_subject_attendances`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `subject_timetable_id` int(11) NULL DEFAULT NULL,
  `attendence_type_id` int(11) NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `attendence_type_id`(`attendence_type_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  INDEX `subject_timetable_id`(`subject_timetable_id`) USING BTREE,
  CONSTRAINT `student_subject_attendances_ibfk_1` FOREIGN KEY (`attendence_type_id`) REFERENCES `attendence_type` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_subject_attendances_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_subject_attendances_ibfk_3` FOREIGN KEY (`subject_timetable_id`) REFERENCES `subject_timetable` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_timeline
-- ----------------------------
DROP TABLE IF EXISTS `student_timeline`;
CREATE TABLE `student_timeline`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timeline_date` date NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `document` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  CONSTRAINT `student_timeline_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for student_transport_fees
-- ----------------------------
DROP TABLE IF EXISTS `student_transport_fees`;
CREATE TABLE `student_transport_fees`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transport_feemaster_id` int(10) NOT NULL,
  `student_session_id` int(11) NOT NULL,
  `route_pickup_point_id` int(11) NOT NULL,
  `generated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  INDEX `route_pickup_point_id`(`route_pickup_point_id`) USING BTREE,
  INDEX `transport_feemaster_id`(`transport_feemaster_id`) USING BTREE,
  CONSTRAINT `student_transport_fees_ibfk_1` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_transport_fees_ibfk_2` FOREIGN KEY (`route_pickup_point_id`) REFERENCES `route_pickup_point` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `student_transport_fees_ibfk_3` FOREIGN KEY (`transport_feemaster_id`) REFERENCES `transport_feemaster` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `admission_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `roll_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `admission_date` date NULL DEFAULT NULL,
  `firstname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `middlename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rte` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mobileno` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pincode` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cast` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dob` date NULL DEFAULT NULL,
  `gender` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `current_address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `permanent_address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `category_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `school_house_id` int(11) NULL DEFAULT NULL,
  `blood_group` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hostel_room_id` int(11) NULL DEFAULT NULL,
  `adhar_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `samagra_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bank_account_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bank_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ifsc_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guardian_is` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `father_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `father_phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `father_occupation` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mother_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mother_phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mother_occupation` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guardian_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guardian_relation` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guardian_phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `guardian_occupation` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `guardian_address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `guardian_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `father_pic` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mother_pic` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `guardian_pic` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'yes',
  `previous_school` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `height` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `weight` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `measurement_date` date NULL DEFAULT NULL,
  `dis_reason` int(11) NOT NULL,
  `note` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dis_note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `app_key` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `parent_app_key` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `disable_at` date NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_admission_no`(`admission_no`) USING BTREE,
  INDEX `idx_roll_no`(`roll_no`) USING BTREE,
  INDEX `idx_mobileno`(`mobileno`) USING BTREE,
  INDEX `idx_email`(`email`) USING BTREE,
  INDEX `idx_firstname`(`firstname`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for subject_group_class_sections
-- ----------------------------
DROP TABLE IF EXISTS `subject_group_class_sections`;
CREATE TABLE `subject_group_class_sections`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_group_id` int(11) NULL DEFAULT NULL,
  `class_section_id` int(11) NULL DEFAULT NULL,
  `session_id` int(11) NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` int(11) NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `class_section_id`(`class_section_id`) USING BTREE,
  INDEX `subject_group_id`(`subject_group_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  CONSTRAINT `subject_group_class_sections_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_group_class_sections_ibfk_2` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_group_class_sections_ibfk_3` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for subject_group_subjects
-- ----------------------------
DROP TABLE IF EXISTS `subject_group_subjects`;
CREATE TABLE `subject_group_subjects`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_group_id` int(11) NULL DEFAULT NULL,
  `session_id` int(11) NULL DEFAULT NULL,
  `subject_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `subject_group_id`(`subject_group_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `subject_id`(`subject_id`) USING BTREE,
  CONSTRAINT `subject_group_subjects_ibfk_1` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_group_subjects_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_group_subjects_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for subject_groups
-- ----------------------------
DROP TABLE IF EXISTS `subject_groups`;
CREATE TABLE `subject_groups`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `session_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  CONSTRAINT `subject_groups_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for subject_syllabus
-- ----------------------------
DROP TABLE IF EXISTS `subject_syllabus`;
CREATE TABLE `subject_syllabus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_for` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_from` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time_to` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `presentation` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `attachment` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lacture_youtube_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lacture_video` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sub_topic` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `teaching_method` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `general_objectives` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `previous_knowledge` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `comprehensive_questions` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `topic_id`(`topic_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `created_for`(`created_for`) USING BTREE,
  CONSTRAINT `subject_syllabus_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_syllabus_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_syllabus_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_syllabus_ibfk_4` FOREIGN KEY (`created_for`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for subject_timetable
-- ----------------------------
DROP TABLE IF EXISTS `subject_timetable`;
CREATE TABLE `subject_timetable`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NULL DEFAULT NULL,
  `class_id` int(11) NULL DEFAULT NULL,
  `section_id` int(11) NULL DEFAULT NULL,
  `subject_group_id` int(11) NULL DEFAULT NULL,
  `subject_group_subject_id` int(11) NULL DEFAULT NULL,
  `staff_id` int(11) NULL DEFAULT NULL,
  `day` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `time_from` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `time_to` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `start_time` time NULL DEFAULT NULL,
  `end_time` time NULL DEFAULT NULL,
  `room_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `class_id`(`class_id`) USING BTREE,
  INDEX `section_id`(`section_id`) USING BTREE,
  INDEX `subject_group_id`(`subject_group_id`) USING BTREE,
  INDEX `subject_group_subject_id`(`subject_group_subject_id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  CONSTRAINT `subject_timetable_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_timetable_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_timetable_ibfk_3` FOREIGN KEY (`subject_group_id`) REFERENCES `subject_groups` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_timetable_ibfk_4` FOREIGN KEY (`subject_group_subject_id`) REFERENCES `subject_group_subjects` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_timetable_ibfk_5` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subject_timetable_ibfk_6` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for subjects
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_name`(`name`) USING BTREE,
  INDEX `idx_code`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for submit_assignment
-- ----------------------------
DROP TABLE IF EXISTS `submit_assignment`;
CREATE TABLE `submit_assignment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `homework_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `docs` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `file_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `student_id`(`student_id`) USING BTREE,
  INDEX `homework_id`(`homework_id`) USING BTREE,
  CONSTRAINT `submit_assignment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `submit_assignment_ibfk_2` FOREIGN KEY (`homework_id`) REFERENCES `homework` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for template_admitcards
-- ----------------------------
DROP TABLE IF EXISTS `template_admitcards`;
CREATE TABLE `template_admitcards`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `heading` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `left_logo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `right_logo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `exam_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `school_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `exam_center` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sign` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `background_img` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_name` int(1) NOT NULL DEFAULT 1,
  `is_father_name` int(1) NOT NULL DEFAULT 1,
  `is_mother_name` int(1) NOT NULL DEFAULT 1,
  `is_dob` int(1) NOT NULL DEFAULT 1,
  `is_admission_no` int(1) NOT NULL DEFAULT 1,
  `is_roll_no` int(1) NOT NULL DEFAULT 1,
  `is_address` int(1) NOT NULL DEFAULT 1,
  `is_gender` int(1) NOT NULL DEFAULT 1,
  `is_photo` int(11) NOT NULL,
  `is_class` int(11) NOT NULL DEFAULT 0,
  `is_section` int(11) NOT NULL DEFAULT 0,
  `content_footer` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for template_marksheets
-- ----------------------------
DROP TABLE IF EXISTS `template_marksheets`;
CREATE TABLE `template_marksheets`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `header_image` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `template` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `heading` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `left_logo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `right_logo` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `exam_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `school_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `exam_center` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `left_sign` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `middle_sign` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `right_sign` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `exam_session` int(1) NULL DEFAULT 1,
  `is_name` int(1) NULL DEFAULT 1,
  `is_father_name` int(1) NULL DEFAULT 1,
  `is_mother_name` int(1) NULL DEFAULT 1,
  `is_dob` int(1) NULL DEFAULT 1,
  `is_admission_no` int(1) NULL DEFAULT 1,
  `is_roll_no` int(1) NULL DEFAULT 1,
  `is_photo` int(11) NULL DEFAULT 1,
  `is_division` int(1) NOT NULL DEFAULT 1,
  `is_rank` int(1) NOT NULL DEFAULT 0,
  `is_customfield` int(1) NOT NULL,
  `background_img` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_class` int(11) NOT NULL DEFAULT 0,
  `is_teacher_remark` int(11) NOT NULL DEFAULT 1,
  `is_section` int(11) NOT NULL DEFAULT 0,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `content_footer` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for topic
-- ----------------------------
DROP TABLE IF EXISTS `topic`;
CREATE TABLE `topic`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(11) NOT NULL,
  `complete_date` date NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  INDEX `lesson_id`(`lesson_id`) USING BTREE,
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for transport_feemaster
-- ----------------------------
DROP TABLE IF EXISTS `transport_feemaster`;
CREATE TABLE `transport_feemaster`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `month` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `due_date` date NULL DEFAULT NULL,
  `fine_amount` float(10, 2) NULL DEFAULT 0.00,
  `fine_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fine_percentage` float(10, 2) NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `session_id`(`session_id`) USING BTREE,
  CONSTRAINT `transport_feemaster_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for transport_route
-- ----------------------------
DROP TABLE IF EXISTS `transport_route`;
CREATE TABLE `transport_route`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_of_vehicle` int(11) NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for upload_contents
-- ----------------------------
DROP TABLE IF EXISTS `upload_contents`;
CREATE TABLE `upload_contents`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_type_id` int(10) NOT NULL,
  `image` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thumb_path` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dir_path` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `real_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `img_name` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thumb_name` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `file_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mime_type` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `file_size` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `vid_url` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `vid_title` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `upload_by` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `upload_by`(`upload_by`) USING BTREE,
  INDEX `upload_contents_ibfk_2`(`content_type_id`) USING BTREE,
  INDEX `idx_file_type`(`file_type`) USING BTREE,
  CONSTRAINT `upload_contents_ibfk_1` FOREIGN KEY (`upload_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `upload_contents_ibfk_2` FOREIGN KEY (`content_type_id`) REFERENCES `content_types` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for userlog
-- ----------------------------
DROP TABLE IF EXISTS `userlog`;
CREATE TABLE `userlog`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `role` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `class_section_id` int(11) NULL DEFAULT NULL,
  `ipaddress` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_agent` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `login_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `class_section_id`(`class_section_id`) USING BTREE,
  CONSTRAINT `userlog_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `childs` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lang_id` int(11) NOT NULL,
  `currency_id` int(1) NULL DEFAULT 0,
  `verification_code` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users_authentication
-- ----------------------------
DROP TABLE IF EXISTS `users_authentication`;
CREATE TABLE `users_authentication`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `staff_id` int(11) NULL DEFAULT NULL,
  `expired_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` date NULL DEFAULT NULL,
  `updated_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for vehicle_routes
-- ----------------------------
DROP TABLE IF EXISTS `vehicle_routes`;
CREATE TABLE `vehicle_routes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_id` int(11) NULL DEFAULT NULL,
  `vehicle_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `route_id`(`route_id`) USING BTREE,
  INDEX `vehicle_id`(`vehicle_id`) USING BTREE,
  CONSTRAINT `vehicle_routes_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `transport_route` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `vehicle_routes_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for vehicles
-- ----------------------------
DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `vehicle_model` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'None',
  `vehicle_photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `manufacture_year` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `registration_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `chasis_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `max_seating_capacity` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `driver_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `driver_licence` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'None',
  `driver_contact` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_vehicle_no`(`vehicle_no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for video_tutorial
-- ----------------------------
DROP TABLE IF EXISTS `video_tutorial`;
CREATE TABLE `video_tutorial`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `vid_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `thumb_path` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dir_path` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `img_name` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `thumb_name` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `video_link` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `created_by`(`created_by`) USING BTREE,
  INDEX `idx_title`(`title`) USING BTREE,
  CONSTRAINT `video_tutorial_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for video_tutorial_class_sections
-- ----------------------------
DROP TABLE IF EXISTS `video_tutorial_class_sections`;
CREATE TABLE `video_tutorial_class_sections`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_tutorial_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `class_section_id`(`class_section_id`) USING BTREE,
  INDEX `video_tutorial_id`(`video_tutorial_id`) USING BTREE,
  CONSTRAINT `video_tutorial_class_sections_ibfk_1` FOREIGN KEY (`class_section_id`) REFERENCES `class_sections` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `video_tutorial_class_sections_ibfk_2` FOREIGN KEY (`video_tutorial_id`) REFERENCES `video_tutorial` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for visitors_book
-- ----------------------------
DROP TABLE IF EXISTS `visitors_book`;
CREATE TABLE `visitors_book`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NULL DEFAULT NULL,
  `student_session_id` int(11) NULL DEFAULT NULL,
  `source` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `purpose` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_proof` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `no_of_people` int(11) NOT NULL,
  `date` date NOT NULL,
  `in_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `out_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `meeting_with` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `staff_id`(`staff_id`) USING BTREE,
  INDEX `student_session_id`(`student_session_id`) USING BTREE,
  CONSTRAINT `visitors_book_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `visitors_book_ibfk_2` FOREIGN KEY (`student_session_id`) REFERENCES `student_session` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for visitors_purpose
-- ----------------------------
DROP TABLE IF EXISTS `visitors_purpose`;
CREATE TABLE `visitors_purpose`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visitors_purpose` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wa_contacts
-- ----------------------------
DROP TABLE IF EXISTS `wa_contacts`;
CREATE TABLE `wa_contacts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wa_logs
-- ----------------------------
DROP TABLE IF EXISTS `wa_logs`;
CREATE TABLE `wa_logs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `request` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `message_type` enum('text','media') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `receiver_count` int(11) NOT NULL DEFAULT 0,
  `status_code` int(11) NOT NULL,
  `created_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wa_messages
-- ----------------------------
DROP TABLE IF EXISTS `wa_messages`;
CREATE TABLE `wa_messages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('pending','sent','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'pending',
  `created_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  `sent_at` datetime NULL DEFAULT NULL,
  `response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wa_settings
-- ----------------------------
DROP TABLE IF EXISTS `wa_settings`;
CREATE TABLE `wa_settings`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wa_templates
-- ----------------------------
DROP TABLE IF EXISTS `wa_templates`;
CREATE TABLE `wa_templates`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `template_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
