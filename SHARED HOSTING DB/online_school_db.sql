-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2021 at 12:09 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contribution_to_course_assessment` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `course_id`, `title`, `instruction`, `created_at`, `updated_at`, `contribution_to_course_assessment`) VALUES
(1, 7, 'Test 1', '<p>Read well and do your best to ensure that there is a good internet connection</p>', '2021-02-10 19:49:30', '2021-02-10 19:49:30', 10);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activity_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `section_id`, `user_id`, `content`, `score`, `created_at`, `updated_at`, `activity_id`) VALUES
(1, 1, 1, 1, 'I program all day long, what do you do - Mr. question is it now ! you 2 de distur', 1, '2021-02-10 19:57:19', '2021-02-11 10:09:17', 1),
(2, 2, 1, 1, 'I am reading the ERM as of the moment and have not encountered such', 0, '2021-02-10 19:58:50', '2021-02-11 09:17:07', 1),
(3, 3, 1, 1, 'Well it has a good structure, doesn\'t it', 1, '2021-02-10 19:58:57', '2021-02-11 09:18:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `submission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `enrollmentKey` text COLLATE utf8mb4_unicode_ci,
  `maxNoOfStudents` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mini_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `enrollmentKey`, `maxNoOfStudents`, `created_at`, `updated_at`, `image`, `mini_image`) VALUES
(1, 'Fashion 101', '<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>\r\n\r\n<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>', '123', NULL, '2021-02-09 21:43:11', '2021-02-12 10:05:54', 'course_images/N9avcxbqe4irpyoQkKyjT7UqPeJ8ok5Mnd9cEKlU.jpg', 'mini_images/N9avcxbqe4irpyoQkKyjT7UqPeJ8ok5Mnd9cEKlU.jpg'),
(2, 'Music 101', '<p>Thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn&rsquo;t listen. She packed her seven versalia, put her initial into the belt and made herself on the way. When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then</p>', '123', NULL, '2021-02-09 21:44:24', '2021-02-12 09:50:55', 'course_images/QLrjwmvrKdbMUvxlP5DJV0SEwXFNATVEqSdB23wu.jpg', 'mini_images/QLrjwmvrKdbMUvxlP5DJV0SEwXFNATVEqSdB23wu.jpg'),
(3, 'Web Development Basics', '<p>This well help you code like a pro!&nbsp; She packed her seven versalia, put her initial into the belt and made herself on the way. When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then</p>', '123', NULL, '2021-02-09 21:44:40', '2021-02-12 10:08:44', 'course_images/pVc1MNfadv8ZSdCUc25lPi1CRXlX3frLJOAI2D4y.jpg', 'mini_images/pVc1MNfadv8ZSdCUc25lPi1CRXlX3frLJOAI2D4y.jpg'),
(4, 'Creative Graphics', '<p>Take your creativity to the next level.But nothing the copy said could convince her and so it didn&rsquo;t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again. And if she hasn&rsquo;t been rewritten, then they are still using her.</p>', '123', NULL, '2021-02-09 21:45:07', '2021-02-12 10:00:08', 'course_images/UjfJ2D1f9wJkdsMcdg8pSAJFKum5ORDL9M8m302S.jpg', 'mini_images/UjfJ2D1f9wJkdsMcdg8pSAJFKum5ORDL9M8m302S.jpg'),
(5, 'Photography 101', '<p>Even the all-powerful Pointing&nbsp; camera has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>', '123', NULL, '2021-02-09 21:45:22', '2021-02-12 10:07:14', 'course_images/z1FnHtbxl2BZeWPvv7ULinkDVIkFFJQxNBO6guSH.jpg', 'mini_images/z1FnHtbxl2BZeWPvv7ULinkDVIkFFJQxNBO6guSH.jpg'),
(6, 'Fun 10!', '<p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter issues&nbsp;that are extremely painful.</p>\r\n\r\n<p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</p>', '123', NULL, '2021-02-09 21:45:41', '2021-02-12 10:10:16', 'course_images/mAjfaYTSrkzY04vycf1YrDkw9oNbEJahfNSCn5pn.jpg', 'mini_images/mAjfaYTSrkzY04vycf1YrDkw9oNbEJahfNSCn5pn.jpg'),
(7, 'Laravel Development', '<p>This course is intended to allow you to create virtually any type of web application that <strong>great mind </strong>of yours can think about. The outline of this course is shown in a tabular version below.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"background-color:#e6e6fa; border-style:hidden; height:81px; width:533px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Content</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Week 1</strong></td>\r\n			<td>&nbsp;Installation and file structure</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Week 2</strong></td>\r\n			<td>Eloquent Relationship Models and Migrations</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"pink_print_image\" src=\"http://inokpa.me/storage/mini_images/ZM5kZEQXYfsSaP6bMPh1I9nRVg4hfo3pUOsRgnxC.jpg\" style=\"float:left; height:150px; width:150px\" /> This is what happens when you are really annoying and paranoid. What else do you do</p>', '123', NULL, '2021-02-10 19:40:00', '2021-02-10 19:45:34', 'course_images/jQml6tedA2Wo8MiTW53YL3OFn7YYE1gwc4HjXpkp.jpg', 'mini_images/jQml6tedA2Wo8MiTW53YL3OFn7YYE1gwc4HjXpkp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `course_user`
--

CREATE TABLE `course_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_user`
--

INSERT INTO `course_user` (`id`, `user_id`, `course_id`, `created_at`, `updated_at`, `role`) VALUES
(1, 1, 1, '2021-02-09 21:43:11', '2021-02-09 21:43:11', 'teacher'),
(2, 1, 2, '2021-02-09 21:44:24', '2021-02-09 21:44:24', 'teacher'),
(3, 1, 3, '2021-02-09 21:44:40', '2021-02-09 21:44:40', 'teacher'),
(4, 1, 4, '2021-02-09 21:45:07', '2021-02-09 21:45:07', 'teacher'),
(5, 1, 5, '2021-02-09 21:45:22', '2021-02-09 21:45:22', 'teacher'),
(6, 1, 6, '2021-02-09 21:45:41', '2021-02-09 21:45:41', 'teacher'),
(7, 2, 1, '2021-02-10 08:19:21', '2021-02-10 08:19:21', 'student'),
(8, 2, 7, '2021-02-10 08:56:16', '2021-02-10 19:40:01', 'teacher'),
(9, 2, 8, '2021-02-10 08:57:09', '2021-02-10 08:57:09', 'teacher'),
(10, 2, 9, '2021-02-10 08:57:36', '2021-02-10 08:57:36', 'teacher'),
(11, 1, 7, '2021-02-10 19:56:46', '2021-02-10 19:56:46', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `dev_messages`
--

CREATE TABLE `dev_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'greeting',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 7, 'Lesson 1', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>\r\n\r\n<p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>\r\n\r\n<p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.</p>\r\n\r\n<p>Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>', '2021-02-12 09:28:05', '2021-02-12 09:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(10) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_12_31_192031_create_courses_table', 1),
(4, '2021_01_04_162959_drop_user_id_column_from_courses_table', 1),
(5, '2021_01_04_163324_create_course_user_table', 1),
(6, '2021_01_04_172512_drop_role_column_from_course_user_table', 1),
(7, '2021_01_05_153936_create_lessons_table', 1),
(8, '2021_01_05_161450_add_role_column_to_course_user_table', 1),
(9, '2021_01_05_215252_create_links_table', 1),
(10, '2021_01_07_100151_create_activities_table', 1),
(11, '2021_01_08_220322_create_articles_table', 1),
(12, '2021_01_09_201404_create_sections_table', 1),
(13, '2021_01_09_202916_add_contibution_to_course_column_to_activities_table', 1),
(14, '2021_01_10_223246_create_questions_table', 1),
(15, '2021_01_20_190038_create_files_table', 1),
(16, '2021_01_21_184807_create_answers_table', 1),
(17, '2021_01_23_002904_create_section_times_table', 1),
(18, '2021_01_24_000333_create_assessments_table', 1),
(19, '2021_01_25_081839_create_submissions_table', 1),
(20, '2021_01_25_082943_add_submission_id_to_assessments_table', 1),
(21, '2021_01_28_101120_add_image_to_courses_table', 1),
(22, '2021_01_30_100321_create_dev_messages_table', 1),
(23, '2021_01_30_140450_create_pages_table', 1),
(24, '2021_02_05_092927_add_activity_id_answers_table', 1),
(25, '2021_02_05_133023_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('3ad03655-1bf4-4f24-814d-b4532072633d', 'App\\Notifications\\LessonCreated', 'App\\User', 1, '{\"name\":\"Lesson 1\",\"url\":\"http:\\/\\/inokpa.me\\/lessons\\/1\",\"text\":\"A new lesson has been added to Laravel Development !\"}', NULL, '2021-02-12 09:28:05', '2021-02-12 09:28:05'),
('aa5c4d60-461b-46ed-bf36-315bcee22929', 'App\\Notifications\\StudentRemoved', 'App\\User', 2, '{\"name\":\"A student Left\",\"url\":\"http:\\/\\/inokpa.me\\/assessments\\/8\\/course\",\"text\":\"Isaac Odeh dropped Bible Study Apparent !\"}', NULL, '2021-02-10 09:49:13', '2021-02-10 09:49:13'),
('b16f04d0-6adb-4fd0-b9fb-59e68755900e', 'App\\Notifications\\StudentEnrolled', 'App\\User', 2, '{\"name\":\"A student Enrolled\",\"url\":\"http:\\/\\/inokpa.me\\/assessments\\/7\\/course\",\"text\":\"Isaac Odeh enrolled in Laravel Development !\"}', NULL, '2021-02-10 19:56:47', '2021-02-10 19:56:47'),
('cb67eccf-3ae5-4e5b-bc30-3d4e3a7e21e4', 'App\\Notifications\\StudentEnrolled', 'App\\User', 2, '{\"name\":\"A student Enrolled\",\"url\":\"http:\\/\\/inokpa.me\\/assessments\\/8\\/course\",\"text\":\"Isaac Odeh enrolled in Bible Study Apparent !\"}', NULL, '2021-02-10 09:48:04', '2021-02-10 09:48:04'),
('cbbb10c9-3eb2-4e68-a1f6-a869b0fe5c44', 'App\\Notifications\\StudentEnrolled', 'App\\User', 1, '{\"name\":\"A student Enrolled\",\"url\":\"http:\\/\\/inokpa.me\\/assessments\\/1\\/course\",\"text\":\"Mrs. Ramya Abubakar Osedoma enrolled in Coding 4 Absolute Beginners !\"}', NULL, '2021-02-10 08:19:22', '2021-02-10 08:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'about', '<p>This platform is for learning and teaching all day long!</p>', '2021-02-09 21:39:51', '2021-02-09 21:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_a` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_b` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_c` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_d` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_answer` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mark` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `section_id`, `content`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `mark`, `created_at`, `updated_at`) VALUES
(1, 1, 'What do you do all day long', 'program', 'make money', 'preach', 'listen to music', 'a', 1, '2021-02-10 19:51:30', '2021-02-10 19:51:30'),
(2, 1, 'Why does eloquent map so effectively', 'its just good', 'its lazy loading', 'the good software architecture', 'modularity', 'c', 1, '2021-02-10 19:53:07', '2021-02-10 19:53:07'),
(3, 1, 'What is Css', 'Cascading Style Sheets', 'Cars Steal Sim', 'Cry so so', 'Crowdy, Stylish, Student', 'd', 1, '2021-02-10 19:54:36', '2021-02-10 19:54:36'),
(4, 2, 'Why does a cat have whiskers ?', 'To oppress rats', 'To eat paw paw', 'Its a feline', 'Its genetic code', 'a', 1, '2021-02-11 09:03:43', '2021-02-11 09:03:43'),
(5, 2, 'Why are programmers always assumed to be anti-social', 'bad coding movies', 'always on the computer', 'hardly smile', 'don\'t hang out with people their age', 'b', 1, '2021-02-11 09:05:35', '2021-02-11 09:05:35'),
(6, 2, 'What do cars and coders have in common ?', 'They make life easier', 'Solve your problems', 'Better at efficacy', 'Love numbers', 'd', 1, '2021-02-11 09:07:05', '2021-02-11 09:07:05'),
(7, 3, 'Why do we eat rats ?', NULL, NULL, NULL, NULL, NULL, 11, '2021-02-11 09:10:11', '2021-02-11 09:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instruction` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_duration` int(11) NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contribution_to_activity` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `activity_id`, `title`, `instruction`, `time_duration`, `category`, `contribution_to_activity`, `created_at`, `updated_at`) VALUES
(1, 1, 'Theory Section', '<p>This is the instruction - same as b4</p>', 1200000, 'Theory', 50, '2021-02-11 08:59:30', '2021-02-11 08:59:30'),
(2, 1, 'MCQ', '<p>same as b4</p>', 1200000, 'MCQ', 50, '2021-02-11 09:02:19', '2021-02-11 09:02:19'),
(3, 1, 'Theory 2', '<p>Answer any 2 questions</p>', 1200000, 'Theory', 0, '2021-02-11 09:09:35', '2021-02-11 09:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `section_times`
--

CREATE TABLE `section_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `time_left` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_times`
--

INSERT INTO `section_times` (`id`, `user_id`, `section_id`, `time_left`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4977000, '2021-02-10 19:57:03', '2021-02-11 19:31:05'),
(2, 2, 1, 1177000, '2021-02-11 09:01:04', '2021-02-11 09:01:28'),
(3, 2, 2, 1122000, '2021-02-11 09:07:16', '2021-02-11 09:08:34'),
(4, 1, 2, 0, '2021-02-11 19:31:11', '2021-02-12 08:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `activity_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `section_id`, `user_id`, `activity_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2021-02-10 19:57:03', '2021-02-10 19:57:03'),
(2, 1, 2, 1, '2021-02-11 09:01:05', '2021-02-11 09:01:05'),
(3, 2, 2, 1, '2021-02-11 09:07:16', '2021-02-11 09:07:16'),
(4, 2, 1, 1, '2021-02-11 19:31:11', '2021-02-11 19:31:11'),
(5, 2, 1, 1, '2021-02-12 08:51:13', '2021-02-12 08:51:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Isaac Odeh', 'caasithecreator@gmail.com', '$2y$10$od2Q/.4MwH0Ci8DorkSike2jxoCSaWHXbO4hyqe6HuL.YFfo2qGSe', 'T30G0ZzORcS2yFC5T7A08x3zc0GyFiHgvjWljVr43ez8lg058OrNvdKYTTVP', '2021-02-09 21:38:53', '2021-02-09 21:38:53'),
(2, 'Mrs. Ramya Abubakar Osedoma', 'test@test.com', '$2y$10$mohjAFaxKHYNPMG2nT3dQuSsJaaTw0lSE.2WuN8rVKiLdjnu7ZW2q', '8Q3j5nrL0m2LRbvwqMRBcYcB2j7fMJ9qx2ZAXvIwyzNoTAQgMzeMy1AxOP5V', '2021-02-10 08:18:38', '2021-02-10 08:18:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_user`
--
ALTER TABLE `course_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dev_messages`
--
ALTER TABLE `dev_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_times`
--
ALTER TABLE `section_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_user`
--
ALTER TABLE `course_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dev_messages`
--
ALTER TABLE `dev_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `section_times`
--
ALTER TABLE `section_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
