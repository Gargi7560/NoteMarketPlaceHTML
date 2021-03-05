-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 06:17 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notemarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `CountryID` int(11) NOT NULL,
  `CountryCode` varchar(100) NOT NULL,
  `CountryName` varchar(100) NOT NULL,
  `PhoneCode` int(11) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`CountryID`, `CountryCode`, `CountryName`, `PhoneCode`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'AF', 'Afghanistan', 93, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(2, 'AL', 'Albania', 355, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(3, 'DZ', 'Algeria', 213, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(4, 'AS', 'American Samoa', 1684, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(5, 'AD', 'Andorra', 376, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(6, 'AO', 'Angola', 244, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(7, 'AI', 'Anguilla', 1264, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(8, 'AQ', 'Antarctica', 0, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(9, 'AG', 'Antigua And Barbuda', 1268, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(10, 'AU', 'Australia', 61, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(11, 'AM', 'Armenia', 374, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(12, 'AT', 'Austria', 43, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(13, 'AW', 'Aruba', 297, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(14, 'AZ', 'Azerbaijan', 994, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(15, 'BS', 'Bahamas The', 1242, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(16, 'BH', 'Bahrain', 973, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(17, 'BD', 'Bangladesh', 880, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(18, 'BB', 'Barbados', 1246, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(19, 'BY', 'Belarus', 375, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(20, 'AR', 'Argentina', 54, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(21, 'BE', 'Belgium', 32, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(22, 'BZ', 'Belize', 501, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(23, 'BJ', 'Benin', 229, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(24, 'BM', 'Bermuda', 1441, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(25, 'BT', 'Bhutan', 975, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(26, 'BO', 'Bolivia', 591, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(27, 'BA', 'Bosnia and Herzegovina', 387, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(28, 'BW', 'Botswana', 267, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(29, 'BV', 'Bouvet Island', 0, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(30, 'BR', 'Brazil', 55, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(31, 'IO', 'British Indian Ocean Territory', 246, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(32, 'BN', 'Brunei', 673, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(33, 'BG', 'Bulgaria', 359, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(34, 'BF', 'Burkina Faso', 226, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(35, 'BI', 'Burundi', 257, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(36, 'KH', 'Cambodia', 855, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(37, 'CM', 'Cameroon', 237, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(38, 'CA', 'Canada', 1, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(39, 'CV', 'Cape Verde', 238, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(40, 'KY', 'Cayman Islands', 1345, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(41, 'CF', 'Central African Republic', 236, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(42, 'TD', 'Chad', 235, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(43, 'CL', 'Chile', 56, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(44, 'CN', 'China', 86, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(45, 'CX', 'Christmas Island', 61, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(46, 'CC', 'Cocos (Keeling) Islands', 672, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(47, 'CO', 'Colombia', 57, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(48, 'KM', 'Comoros', 269, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(49, 'CG', 'Congo', 242, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(50, 'CD', 'Congo The Democratic Republic Of The', 242, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(51, 'CK', 'Cook Islands', 682, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(52, 'CR', 'Costa Rica', 506, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(53, 'CI', 'Cote D Ivoire (Ivory Coast)', 225, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(54, 'HR', 'Croatia (Hrvatska)', 385, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(55, 'CU', 'Cuba', 53, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(56, 'CY', 'Cyprus', 357, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(57, 'CZ', 'Czech Republic', 420, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(58, 'DK', 'Denmark', 45, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(59, 'DJ', 'Djibouti', 253, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(60, 'DM', 'Dominica', 1767, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(61, 'DO', 'Dominican Republic', 1809, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(62, 'TP', 'East Timor', 670, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(63, 'EC', 'Ecuador', 593, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(64, 'EG', 'Egypt', 20, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(65, 'SV', 'El Salvador', 503, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(66, 'GQ', 'Equatorial Guinea', 240, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(67, 'ER', 'Eritrea', 291, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(68, 'EE', 'Estonia', 372, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(69, 'ET', 'Ethiopia', 251, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(70, 'XA', 'External Territories of Australia', 61, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(71, 'FK', 'Falkland Islands', 500, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(72, 'FO', 'Faroe Islands', 298, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(73, 'FJ', 'Fiji Islands', 679, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(74, 'FI', 'Finland', 358, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(75, 'FR', 'France', 33, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(76, 'GF', 'French Guiana', 594, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(77, 'PF', 'French Polynesia', 689, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(78, 'TF', 'French Southern Territories', 0, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(79, 'GA', 'Gabon', 241, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(80, 'GM', 'Gambia The', 220, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(81, 'GE', 'Georgia', 995, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(82, 'DE', 'Germany', 49, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(83, 'GH', 'Ghana', 233, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(84, 'GI', 'Gibraltar', 350, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(85, 'GR', 'Greece', 30, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(86, 'GL', 'Greenland', 299, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(87, 'GD', 'Grenada', 1473, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(88, 'GP', 'Guadeloupe', 590, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(89, 'GU', 'Guam', 1671, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(90, 'GT', 'Guatemala', 502, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(91, 'XU', 'Guernsey and Alderney', 44, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(92, 'GN', 'Guinea', 224, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(93, 'GW', 'Guinea-Bissau', 245, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(94, 'GY', 'Guyana', 592, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(95, 'HT', 'Haiti', 509, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(96, 'HM', 'Heard and McDonald Islands', 0, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(97, 'HN', 'Honduras', 504, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(98, 'HK', 'Hong Kong S.A.R.', 852, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(99, 'HU', 'Hungary', 36, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(100, 'IS', 'Iceland', 354, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(101, 'IN', 'India', 91, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(102, 'ID', 'Indonesia', 62, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(103, 'IR', 'Iran', 98, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(104, 'IQ', 'Iraq', 964, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(105, 'IE', 'Ireland', 353, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(106, 'IL', 'Israel', 972, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(107, 'IT', 'Italy', 39, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(108, 'JM', 'Jamaica', 1876, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(109, 'JP', 'Japan', 81, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(110, 'XJ', 'Jersey', 44, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(111, 'JO', 'Jordan', 962, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(112, 'KZ', 'Kazakhstan', 7, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(113, 'KE', 'Kenya', 254, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(114, 'KI', 'Kiribati', 686, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(115, 'KP', 'Korea North', 850, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(116, 'KR', 'Korea South', 82, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(117, 'KW', 'Kuwait', 965, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(118, 'KG', 'Kyrgyzstan', 996, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(119, 'LA', 'Laos', 856, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(120, 'LV', 'Latvia', 371, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(121, 'LB', 'Lebanon', 961, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(122, 'LS', 'Lesotho', 266, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(123, 'LR', 'Liberia', 231, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(124, 'LY', 'Libya', 218, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(125, 'LI', 'Liechtenstein', 423, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(126, 'LT', 'Lithuania', 370, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(127, 'LU', 'Luxembourg', 352, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(128, 'MO', 'Macau S.A.R.', 853, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(129, 'MK', 'Macedonia', 389, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(130, 'MG', 'Madagascar', 261, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(131, 'MW', 'Malawi', 265, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(132, 'MY', 'Malaysia', 60, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(133, 'MV', 'Maldives', 960, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(134, 'ML', 'Mali', 223, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(135, 'MT', 'Malta', 356, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(136, 'XM', 'Man (Isle of)', 44, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(137, 'MH', 'Marshall Islands', 692, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(138, 'MQ', 'Martinique', 596, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(139, 'MR', 'Mauritania', 222, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(140, 'MU', 'Mauritius', 230, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(141, 'YT', 'Mayotte', 269, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(142, 'MX', 'Mexico', 52, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(143, 'FM', 'Micronesia', 691, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(144, 'MD', 'Moldova', 373, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(145, 'MC', 'Monaco', 377, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(146, 'MN', 'Mongolia', 976, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(147, 'MS', 'Montserrat', 1664, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(148, 'MA', 'Morocco', 212, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(149, 'MZ', 'Mozambique', 258, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(150, 'MM', 'Myanmar', 95, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(151, 'NA', 'Namibia', 264, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(152, 'NR', 'Nauru', 674, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(153, 'NP', 'Nepal', 977, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(154, 'AN', 'Netherlands Antilles', 599, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(155, 'NL', 'Netherlands The', 31, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(156, 'NC', 'New Caledonia', 687, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(157, 'NZ', 'New Zealand', 64, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(158, 'NI', 'Nicaragua', 505, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(159, 'NE', 'Niger', 227, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(160, 'NG', 'Nigeria', 234, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(161, 'NU', 'Niue', 683, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(162, 'NF', 'Norfolk Island', 672, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(163, 'MP', 'Northern Mariana Islands', 1670, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(164, 'NO', 'Norway', 47, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(165, 'OM', 'Oman', 968, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(166, 'PK', 'Pakistan', 92, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(167, 'PW', 'Palau', 680, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(168, 'PS', 'Palestinian Territory Occupied', 970, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(169, 'PA', 'Panama', 507, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(170, 'PG', 'Papua new Guinea', 675, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(171, 'PY', 'Paraguay', 595, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(172, 'PE', 'Peru', 51, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(173, 'PH', 'Philippines', 63, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(174, 'PN', 'Pitcairn Island', 0, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(175, 'PL', 'Poland', 48, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(176, 'PT', 'Portugal', 351, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(177, 'PR', 'Puerto Rico', 1787, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(178, 'QA', 'Qatar', 974, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(179, 'RE', 'Reunion', 262, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(180, 'RO', 'Romania', 40, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(181, 'RU', 'Russia', 70, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(182, 'RW', 'Rwanda', 250, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(183, 'SH', 'Saint Helena', 290, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(184, 'KN', 'Saint Kitts And Nevis', 1869, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(185, 'LC', 'Saint Lucia', 1758, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(186, 'PM', 'Saint Pierre and Miquelon', 508, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(188, 'WS', 'Samoa', 684, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(189, 'SM', 'San Marino', 378, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(190, 'ST', 'Sao Tome and Principe', 239, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(191, 'SA', 'Saudi Arabia', 966, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(192, 'SN', 'Senegal', 221, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(193, 'RS', 'Serbia', 381, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(194, 'SC', 'Seychelles', 248, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(195, 'SL', 'Sierra Leone', 232, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(196, 'SG', 'Singapore', 65, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(197, 'SK', 'Slovakia', 421, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(198, 'SI', 'Slovenia', 386, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(199, 'XG', 'Smaller Territories of the UK', 44, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(200, 'SB', 'Solomon Islands', 677, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(201, 'SO', 'Somalia', 252, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(202, 'ZA', 'South Africa', 27, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(203, 'GS', 'South Georgia', 0, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(204, 'SS', 'South Sudan', 211, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(205, 'ES', 'Spain', 34, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(206, 'LK', 'Sri Lanka', 94, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(207, 'SD', 'Sudan', 249, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(208, 'SR', 'Suriname', 597, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(210, 'SZ', 'Swaziland', 268, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(211, 'SE', 'Sweden', 46, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(212, 'CH', 'Switzerland', 41, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(213, 'SY', 'Syria', 963, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(214, 'TW', 'Taiwan', 886, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(215, 'TJ', 'Tajikistan', 992, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(216, 'TZ', 'Tanzania', 255, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(217, 'TH', 'Thailand', 66, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(218, 'TG', 'Togo', 228, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(219, 'TK', 'Tokelau', 690, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(220, 'TO', 'Tonga', 676, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(221, 'TT', 'Trinidad And Tobago', 1868, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(222, 'TN', 'Tunisia', 216, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(223, 'TR', 'Turkey', 90, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(224, 'TM', 'Turkmenistan', 7370, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(225, 'TC', 'Turks And Caicos Islands', 1649, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(226, 'TV', 'Tuvalu', 688, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(227, 'UG', 'Uganda', 256, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(228, 'UA', 'Ukraine', 380, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(229, 'AE', 'United Arab Emirates', 971, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(230, 'GB', 'United Kingdom', 44, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(231, 'US', 'United States', 1, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(232, 'UM', 'United States Minor Outlying Islands', 1, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(233, 'UY', 'Uruguay', 598, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(234, 'UZ', 'Uzbekistan', 998, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(235, 'VU', 'Vanuatu', 678, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(236, 'VA', 'Vatican City State (Holy See)', 39, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(237, 'VE', 'Venezuela', 58, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(238, 'VN', 'Vietnam', 84, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(239, 'VG', 'Virgin Islands (British)', 1284, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(240, 'VI', 'Virgin Islands (US)', 1340, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(241, 'WF', 'Wallis And Futuna Islands', 681, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(242, 'EH', 'Western Sahara', 212, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(243, 'YE', 'Yemen', 967, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(244, 'YU', 'Yugoslavia', 38, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(245, 'ZM', 'Zambia', 260, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(246, 'ZW', 'Zimbabwe', 263, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `downloadnotes`
--

CREATE TABLE `downloadnotes` (
  `DownloadNoteID` int(11) NOT NULL,
  `NoteDetailID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `DownloaderID` int(11) NOT NULL,
  `IsSellerHasAllowedDownload` bit(1) NOT NULL,
  `AttachmentPath` varchar(255) DEFAULT NULL,
  `IsAttachmentDownloaded` bit(1) NOT NULL,
  `AttachmentDownloadedDate` datetime DEFAULT NULL,
  `IsPaid` int(11) NOT NULL,
  `PurchasedPrice` decimal(5,2) DEFAULT NULL,
  `NoteTitle` varchar(100) NOT NULL,
  `NoteCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downloadnotes`
--

INSERT INTO `downloadnotes` (`DownloadNoteID`, `NoteDetailID`, `SellerID`, `DownloaderID`, `IsSellerHasAllowedDownload`, `AttachmentPath`, `IsAttachmentDownloaded`, `AttachmentDownloadedDate`, `IsPaid`, `PurchasedPrice`, `NoteTitle`, `NoteCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 61, 6, 10, b'1', 'C:\\xampp\\htdocs\\PHP_NoteMarketPlace\\user\\UploadedFiles\\Members\\6\\62\\Attachments', b'0', '2021-03-04 16:33:07', 1, '12.00', '62', '1', '2021-03-04 16:04:06', 1, '2021-03-04 16:04:06', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `notecategories`
--

CREATE TABLE `notecategories` (
  `NoteCategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notecategories`
--

INSERT INTO `notecategories` (`NoteCategoryID`, `CategoryName`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'IT', 'Category 1', '2021-02-26 17:20:26', 2, '2021-02-26 17:20:26', 2, b'1'),
(2, 'CA', 'Category 2', '2021-02-26 17:23:59', 2, '2021-02-26 17:23:59', 2, b'1'),
(3, 'CS', 'Category 3', '2021-02-26 17:25:01', 2, '2021-02-26 17:25:01', 2, b'1'),
(4, 'MBA', 'Category 4', '2021-02-26 17:25:51', 2, '2021-02-26 17:25:51', 2, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `notedetails`
--

CREATE TABLE `notedetails` (
  `NoteDetailID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `ActionByID` int(11) DEFAULT NULL,
  `AdminRemarks` varchar(255) DEFAULT NULL,
  `PublishedDate` datetime DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `DisplayPicture` varchar(500) DEFAULT NULL,
  `NoteTypeID` int(11) DEFAULT NULL,
  `NumberOfPages` int(11) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `UniversityName` varchar(200) DEFAULT NULL,
  `CountryID` int(11) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `CourseCode` varchar(100) DEFAULT NULL,
  `Professor` varchar(100) DEFAULT NULL,
  `SellingModeID` int(11) NOT NULL,
  `SellingPrice` decimal(5,2) DEFAULT NULL,
  `NotesPreview` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notedetails`
--

INSERT INTO `notedetails` (`NoteDetailID`, `SellerID`, `StatusID`, `ActionByID`, `AdminRemarks`, `PublishedDate`, `Title`, `CategoryID`, `DisplayPicture`, `NoteTypeID`, `NumberOfPages`, `Description`, `UniversityName`, `CountryID`, `Course`, `CourseCode`, `Professor`, `SellingModeID`, `SellingPrice`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(30, 6, 2, 1, NULL, NULL, 'Computer Operating Systems', 1, 'DP_User_6_Note_30.png', 1, 100, 'Demo Notes', 'University of California', 231, 'CE', 'C001', 'Mr. Xyz', 1, '0.00', '', '2021-03-02 10:01:34', 6, '2021-03-02 10:01:34', 6, b'1'),
(34, 6, 2, 1, NULL, NULL, 'Computer Science', 3, 'DP_User_6_Note_34.png', 2, 112, 'Demo Note 2', 'University of London', 230, 'MS-CS', 'C002', 'Mr.Abc', 2, '150.00', '', '2021-03-02 10:46:34', 6, '2021-03-02 10:46:34', 6, b'1'),
(35, 6, 1, 1, NULL, NULL, 'commerce', 2, 'DP_User_6_Note_35.png', 3, 100, 'Demo Folder', 'University of afghan', 1, 'CA', 'C003', '', 1, '0.00', '', '2021-03-02 11:06:27', 6, '2021-03-02 11:06:27', 6, b'0'),
(36, 6, 3, 1, NULL, NULL, 'Arts', 4, 'DP_User_6_Note_36.png', 2, 120, 'Demo Folder 2', 'USA College', 12, 'Arts ', 'C004', '', 1, '0.00', '', '2021-03-02 11:24:45', 6, '2021-03-02 11:24:45', 6, b'1'),
(37, 6, 1, 1, NULL, NULL, 'www', 3, 'DP_User_6_Note_37.png', 2, 120, 'Demo Folder', 'abc def', 5, 'CA', 'C001', '', 1, '0.00', '', '2021-03-02 11:32:45', 6, '2021-03-02 11:32:45', 6, b'1'),
(38, 6, 1, 1, NULL, NULL, 'WWW', 2, 'DP_Note38.png', 2, 20, 'Demo', 'Uni of alg', 3, 'MS-CS', 'C002', '', 1, '0.00', '', '2021-03-02 11:57:06', 6, '2021-03-02 11:57:06', 6, b'1'),
(48, 6, 1, 1, NULL, NULL, '39', 2, 'DP_Note_48.png', NULL, 0, 'ddd', '', NULL, '', '', '', 1, '22.00', '', '2021-03-02 13:20:49', 6, '2021-03-02 13:20:49', 6, b'1'),
(49, 10, 4, 1, NULL, NULL, '49', 1, 'DP_Note_49.png', 1, 0, 'dddd', '', NULL, '', '', '', 1, '0.00', '', '2021-03-02 13:28:53', 6, '2021-03-02 13:28:53', 6, b'1'),
(50, 6, 1, 1, NULL, NULL, '50', 2, 'DP_Note_50.png', 2, 0, 'ddd', '', NULL, '', '', '', 1, '13.00', '', '2021-03-02 13:32:19', 6, '2021-03-02 13:32:19', 6, b'1'),
(51, 6, 4, 1, NULL, NULL, '51', 4, 'DP_Note_51.png', NULL, 0, 'dddd', '', NULL, '', '', '', 1, '0.00', '', '2021-03-02 13:35:49', 6, '2021-03-02 13:35:49', 6, b'1'),
(52, 6, 2, 1, NULL, NULL, '52', 2, 'DP_Note_52.png', NULL, 0, 'dddd', '', NULL, '', '', '', 1, '12.00', '', '2021-03-02 13:40:57', 6, '2021-03-02 13:40:57', 6, b'1'),
(53, 6, 2, 1, NULL, NULL, '53', 1, 'DP_Note_53.png', NULL, 0, 'ddd', '', NULL, '', '', '', 1, '12.00', '', '2021-03-02 13:50:08', 6, '2021-03-02 13:50:08', 6, b'1'),
(54, 6, 2, 1, NULL, NULL, '54', 1, 'DP_Note_54.png', NULL, 0, 'dddccc', '', NULL, '', '', '', 1, '0.00', '', '2021-03-02 13:55:03', 6, '2021-03-02 13:55:03', 6, b'1'),
(55, 6, 1, 1, NULL, NULL, '55', 2, 'DP_Note_55.png', NULL, 0, 'dddfff', '', NULL, '', '', '', 2, '12.00', '', '2021-03-02 13:57:42', 6, '2021-03-02 13:57:42', 6, b'1'),
(56, 6, 1, 1, NULL, NULL, 'new', 1, 'DP_Note_56.png', NULL, 0, 'gffgfgjjjj', '', NULL, '', '', '', 1, '0.00', '', '2021-03-02 14:12:30', 6, '2021-03-02 14:12:30', 6, b'1'),
(57, 6, 3, 1, NULL, NULL, 'Final', 2, 'DP_Note_57.png', NULL, 0, 'dddfff', '', NULL, '', '', '', 2, '12.00', 'NP_Note_57.png', '2021-03-02 14:24:07', 6, '2021-03-02 14:24:07', 6, b'1'),
(58, 6, 2, 1, NULL, NULL, '58', 2, 'DP_Note_58.png', NULL, 0, 'final', '', NULL, '', '', '', 1, '0.00', 'NP_Note_58.png', '2021-03-02 14:36:52', 6, '2021-03-02 14:36:52', 6, b'1'),
(59, 6, 1, 1, NULL, NULL, '59', 2, 'DP_Note_59.png', NULL, 0, 'ddfff', '', NULL, '', '', '', 1, '12.00', 'NP_Note_59.png', '2021-03-02 14:38:54', 6, '2021-03-02 14:38:54', 6, b'1'),
(60, 6, 1, 1, NULL, NULL, 'Computer', 3, 'DP_Note_60.png', NULL, 0, 'fgfg', '', NULL, '', '', '', 1, '0.00', 'NP_Note_60.png', '2021-03-02 14:41:40', 6, '2021-03-02 14:41:40', 6, b'1'),
(61, 6, 4, 1, NULL, NULL, 'Computer', 1, 'DP_Note_61.png', NULL, 0, 'ddd', '', NULL, '', '', '', 1, '12.00', 'NP_Note_61.png', '2021-03-02 14:45:34', 6, '2021-03-02 14:45:34', 6, b'1'),
(62, 6, 1, 1, NULL, NULL, '62_New', 2, 'C:/xampp/htdocs/PHP_NoteMarketPlace/user/UploadedFiles/Members/6/62/DP_Note_62.png', 2, 100, 'dddff', 'Indain institution', 101, 'MS-CS', 'C001', 'Mr. Xyz', 2, '15.00', 'C:/xampp/htdocs/PHP_NoteMarketPlace/user/UploadedFiles/Members/6/62/NP_Note_62.png', '2021-03-02 14:55:15', 6, '2021-03-02 14:55:15', 6, b'1'),
(63, 6, 1, 1, NULL, NULL, '63', 1, 'DP_Note_63.png', NULL, 0, 'ddf', '', NULL, '', '', '', 1, '12.00', 'NP_Note_63.png', '2021-03-02 14:59:47', 6, '2021-03-02 14:59:47', 6, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `notesattachments`
--

CREATE TABLE `notesattachments` (
  `NotesAttachmentID` int(11) NOT NULL,
  `NoteDetailID` int(11) NOT NULL,
  `FileName` varchar(100) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notesattachments`
--

INSERT INTO `notesattachments` (`NotesAttachmentID`, `NoteDetailID`, `FileName`, `FilePath`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(48, 62, 'UN_1_User_6_Note_62.pdf', 'C:/xampp/htdocs/PHP_NoteMarketPlace/user/UploadedFiles/Members/6/62/Attachments/UN_1_User_6_Note_62.pdf', '2021-03-05 17:58:21', 1, '2021-03-05 17:58:21', 1, b'1'),
(49, 62, 'UN_2_User_6_Note_62.pdf', 'C:/xampp/htdocs/PHP_NoteMarketPlace/user/UploadedFiles/Members/6/62/Attachments/UN_2_User_6_Note_62.pdf', '2021-03-05 17:58:21', 1, '2021-03-05 17:58:21', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `notesreportedissues`
--

CREATE TABLE `notesreportedissues` (
  `NotesReportedIssuesID` int(11) NOT NULL,
  `NoteDetailID` int(11) NOT NULL,
  `ReportedByID` int(11) NOT NULL,
  `AgainstDownloadID` int(11) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notesreviews`
--

CREATE TABLE `notesreviews` (
  `NotesReviewID` int(11) NOT NULL,
  `NoteDetailID` int(11) NOT NULL,
  `ReviewedByID` int(11) NOT NULL,
  `AgainstDownloadsID` int(11) NOT NULL,
  `Ratings` decimal(5,2) NOT NULL,
  `Comments` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notetypes`
--

CREATE TABLE `notetypes` (
  `NoteTypeID` int(11) NOT NULL,
  `TypeName` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notetypes`
--

INSERT INTO `notetypes` (`NoteTypeID`, `TypeName`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Handwritten', 'Type 1', '2021-02-26 17:35:48', 2, '2021-02-26 17:35:48', 2, b'1'),
(2, 'Story Book', 'Type 2', '2021-02-26 17:38:38', 2, '2021-02-26 17:38:38', 2, b'1'),
(3, 'University Note', 'Type 3', '2021-02-26 17:39:17', 2, '2021-02-26 17:39:17', 2, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `referencedata`
--

CREATE TABLE `referencedata` (
  `ReferenceDataID` int(11) NOT NULL,
  `Value` varchar(100) NOT NULL,
  `DataValue` varchar(100) NOT NULL,
  `ReferenceCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referencedata`
--

INSERT INTO `referencedata` (`ReferenceDataID`, `Value`, `DataValue`, `ReferenceCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Draft', '1', 'NoteStatus', '2021-02-26 18:23:36', 1, '2021-02-26 18:23:36', 1, b'1'),
(2, 'Submitted For Review', '2', 'NoteStatus', '2021-02-26 18:30:20', 1, '2021-02-26 18:30:20', 1, b'1'),
(3, 'In Review', '3', 'NoteStatus', '2021-02-26 18:30:55', 1, '2021-02-26 18:30:55', 1, b'1'),
(4, 'Published', '4', 'NoteStatus', '2021-02-26 18:31:56', 1, '2021-02-26 18:31:56', 1, b'1'),
(5, 'Rejected', '5', 'NoteStatus', '2021-02-26 18:32:22', 1, '2021-02-26 18:32:22', 1, b'1'),
(6, 'Removed', '6', 'NoteStatus', '2021-02-26 18:33:01', 1, '2021-02-26 18:33:01', 1, b'1'),
(7, 'Free', '1', 'SellingMode', '2021-02-26 18:54:22', 1, '2021-02-26 18:54:22', 1, b'1'),
(8, 'Paid', '2', 'SellingMode', '2021-02-26 18:55:23', 1, '2021-02-26 18:55:23', 1, b'1'),
(9, '1+', '1', 'Ratings', '2021-02-28 10:52:04', 1, '2021-02-28 10:52:04', 1, b'1'),
(10, '2+', '2', 'Ratings', '2021-02-28 10:55:52', 1, '2021-02-28 10:55:52', 1, b'1'),
(11, '3+', '3', 'Ratings', '2021-02-28 10:56:31', 1, '2021-02-28 10:56:31', 1, b'1'),
(12, '4+', '4', 'Ratings', '2021-02-28 10:56:54', 1, '2021-02-28 10:56:54', 1, b'1'),
(13, '5', '5', 'Ratings', '2021-02-28 10:57:19', 1, '2021-02-28 10:57:19', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `systemconfiguration`
--

CREATE TABLE `systemconfiguration` (
  `SystemConfigurationID` int(11) NOT NULL,
  `Key` varchar(100) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userpofiledetails`
--

CREATE TABLE `userpofiledetails` (
  `UserProfileDetailID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DOB` datetime DEFAULT NULL,
  `GenderID` int(11) DEFAULT NULL,
  `SecondaryEmailAddress` varchar(100) NOT NULL,
  `PhoneNumber-CountryID` int(11) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `ProfilePicture` varchar(500) DEFAULT NULL,
  `AddressLine1` varchar(100) NOT NULL,
  `AddressLine2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` varchar(50) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `University` varchar(100) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `UserRoleID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`UserRoleID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Member', 'Role of member(buyer/seller)', '2021-02-23 18:22:45', 1, '2021-02-23 18:22:45', 1, b'1'),
(2, 'Admin', 'Role of admin', '2021-02-23 18:23:10', 1, '2021-02-23 18:23:10', 1, b'1'),
(3, 'Superadmin', 'Role of superadmin', '2021-02-23 18:23:31', 1, '2021-02-23 18:23:31', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserRoleID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `IsEmailVerified` bit(1) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserRoleID`, `FirstName`, `LastName`, `Email`, `Password`, `IsEmailVerified`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 3, 'Gargi', 'Patel', 'gargipatel@gmail.com', 'Abc@1234', b'1', '2021-02-23 18:16:23', NULL, '2021-02-23 18:16:23', NULL, b'1'),
(6, 1, 'abc', 'a', 'a@a.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-24 01:06:23', 1, '2021-02-24 01:06:23', 1, b'1'),
(7, 1, 'v', 'v', 'v@v.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-24 01:07:02', 1, '2021-02-24 01:07:02', 1, b'1'),
(8, 1, 'p', 'p', 'p@p.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-24 10:14:35', 1, '2021-02-24 10:14:35', 1, b'1'),
(9, 1, 'z', 'z', 'z@z.com', '7c4cd4cb7105daa71ec26d98362cb971', b'1', '2021-02-24 15:45:07', 1, '2021-02-24 15:45:07', 1, b'1'),
(10, 1, 'UserA', 'SurnameA', 'aa@aa.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-25 13:03:52', 1, '2021-02-25 13:03:52', 1, b'1'),
(13, 2, 'c', 'c', 'c@c.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-25 14:02:55', 1, '2021-02-25 14:02:55', 1, b'1'),
(14, 1, 'e', 'e', 'e@e.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:05:45', 1, '2021-02-25 14:05:45', 1, b'1'),
(15, 1, 'f', 'f', 'f@f.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:07:10', 1, '2021-02-25 14:07:10', 1, b'1'),
(18, 1, 'y', 'y', 'y@y.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:18:07', 1, '2021-02-25 14:18:07', 1, b'1'),
(19, 1, 'g', 'g', 'g@g.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:23:07', 1, '2021-02-25 14:23:07', 1, b'1'),
(20, 1, 'j', 'j', 'j@j.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:30:24', 1, '2021-02-25 14:30:24', 1, b'1'),
(21, 1, 'i', 'i', 'i@i.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:32:43', 1, '2021-02-25 14:32:43', 1, b'1'),
(22, 1, 'ii', 'ii', 'ii@ii.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 15:55:11', 1, '2021-02-25 15:55:11', 1, b'1'),
(23, 1, 'UserB', 'SurnameB', 'patelgargi7560@gmail.com', '3629ae12c240805d5fae5217712d06e4', b'1', '2021-02-25 16:02:11', 1, '2021-02-25 16:02:11', 1, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`CountryID`);

--
-- Indexes for table `downloadnotes`
--
ALTER TABLE `downloadnotes`
  ADD PRIMARY KEY (`DownloadNoteID`),
  ADD KEY `NoteDetailID` (`NoteDetailID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `DownloaderID` (`DownloaderID`);

--
-- Indexes for table `notecategories`
--
ALTER TABLE `notecategories`
  ADD PRIMARY KEY (`NoteCategoryID`);

--
-- Indexes for table `notedetails`
--
ALTER TABLE `notedetails`
  ADD PRIMARY KEY (`NoteDetailID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `SellingModeID` (`SellingModeID`),
  ADD KEY `StatusID` (`StatusID`),
  ADD KEY `ActionByID` (`ActionByID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `NoteTypeID` (`NoteTypeID`),
  ADD KEY `CountryID` (`CountryID`);

--
-- Indexes for table `notesattachments`
--
ALTER TABLE `notesattachments`
  ADD PRIMARY KEY (`NotesAttachmentID`),
  ADD KEY `NoteDetailID` (`NoteDetailID`);

--
-- Indexes for table `notesreportedissues`
--
ALTER TABLE `notesreportedissues`
  ADD PRIMARY KEY (`NotesReportedIssuesID`),
  ADD KEY `NoteDetailID` (`NoteDetailID`),
  ADD KEY `ReportedByID` (`ReportedByID`),
  ADD KEY `AgainstDownloadID` (`AgainstDownloadID`);

--
-- Indexes for table `notesreviews`
--
ALTER TABLE `notesreviews`
  ADD PRIMARY KEY (`NotesReviewID`),
  ADD KEY `NoteDetailID` (`NoteDetailID`),
  ADD KEY `ReviewedByID` (`ReviewedByID`),
  ADD KEY `AgainstDownloadsID` (`AgainstDownloadsID`);

--
-- Indexes for table `notetypes`
--
ALTER TABLE `notetypes`
  ADD PRIMARY KEY (`NoteTypeID`);

--
-- Indexes for table `referencedata`
--
ALTER TABLE `referencedata`
  ADD PRIMARY KEY (`ReferenceDataID`);

--
-- Indexes for table `systemconfiguration`
--
ALTER TABLE `systemconfiguration`
  ADD PRIMARY KEY (`SystemConfigurationID`);

--
-- Indexes for table `userpofiledetails`
--
ALTER TABLE `userpofiledetails`
  ADD PRIMARY KEY (`UserProfileDetailID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `GenderID` (`GenderID`),
  ADD KEY `PhoneNumber-CountryID` (`PhoneNumber-CountryID`),
  ADD KEY `CountryID` (`CountryID`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`UserRoleID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `UserRoleID` (`UserRoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `downloadnotes`
--
ALTER TABLE `downloadnotes`
  MODIFY `DownloadNoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notecategories`
--
ALTER TABLE `notecategories`
  MODIFY `NoteCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notedetails`
--
ALTER TABLE `notedetails`
  MODIFY `NoteDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `notesattachments`
--
ALTER TABLE `notesattachments`
  MODIFY `NotesAttachmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `notesreportedissues`
--
ALTER TABLE `notesreportedissues`
  MODIFY `NotesReportedIssuesID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notesreviews`
--
ALTER TABLE `notesreviews`
  MODIFY `NotesReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notetypes`
--
ALTER TABLE `notetypes`
  MODIFY `NoteTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `ReferenceDataID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `systemconfiguration`
--
ALTER TABLE `systemconfiguration`
  MODIFY `SystemConfigurationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userpofiledetails`
--
ALTER TABLE `userpofiledetails`
  MODIFY `UserProfileDetailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `UserRoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloadnotes`
--
ALTER TABLE `downloadnotes`
  ADD CONSTRAINT `downloadnotes_ibfk_1` FOREIGN KEY (`NoteDetailID`) REFERENCES `notedetails` (`NoteDetailID`),
  ADD CONSTRAINT `downloadnotes_ibfk_2` FOREIGN KEY (`SellerID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `downloadnotes_ibfk_3` FOREIGN KEY (`DownloaderID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `notedetails`
--
ALTER TABLE `notedetails`
  ADD CONSTRAINT `notedetails_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `notedetails_ibfk_2` FOREIGN KEY (`SellingModeID`) REFERENCES `referencedata` (`ReferenceDataID`),
  ADD CONSTRAINT `notedetails_ibfk_3` FOREIGN KEY (`StatusID`) REFERENCES `referencedata` (`ReferenceDataID`),
  ADD CONSTRAINT `notedetails_ibfk_4` FOREIGN KEY (`ActionByID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `notedetails_ibfk_5` FOREIGN KEY (`CategoryID`) REFERENCES `notecategories` (`NoteCategoryID`),
  ADD CONSTRAINT `notedetails_ibfk_6` FOREIGN KEY (`NoteTypeID`) REFERENCES `notetypes` (`NoteTypeID`),
  ADD CONSTRAINT `notedetails_ibfk_7` FOREIGN KEY (`CountryID`) REFERENCES `countries` (`CountryID`);

--
-- Constraints for table `notesattachments`
--
ALTER TABLE `notesattachments`
  ADD CONSTRAINT `notesattachments_ibfk_1` FOREIGN KEY (`NoteDetailID`) REFERENCES `notedetails` (`NoteDetailID`);

--
-- Constraints for table `notesreportedissues`
--
ALTER TABLE `notesreportedissues`
  ADD CONSTRAINT `notesreportedissues_ibfk_1` FOREIGN KEY (`NoteDetailID`) REFERENCES `notedetails` (`NoteDetailID`),
  ADD CONSTRAINT `notesreportedissues_ibfk_2` FOREIGN KEY (`ReportedByID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `notesreportedissues_ibfk_3` FOREIGN KEY (`AgainstDownloadID`) REFERENCES `downloadnotes` (`DownloadNoteID`);

--
-- Constraints for table `notesreviews`
--
ALTER TABLE `notesreviews`
  ADD CONSTRAINT `notesreviews_ibfk_1` FOREIGN KEY (`NoteDetailID`) REFERENCES `notedetails` (`NoteDetailID`),
  ADD CONSTRAINT `notesreviews_ibfk_2` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `notesreviews_ibfk_3` FOREIGN KEY (`AgainstDownloadsID`) REFERENCES `downloadnotes` (`DownloadNoteID`);

--
-- Constraints for table `userpofiledetails`
--
ALTER TABLE `userpofiledetails`
  ADD CONSTRAINT `userpofiledetails_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `userpofiledetails_ibfk_2` FOREIGN KEY (`GenderID`) REFERENCES `referencedata` (`ReferenceDataID`),
  ADD CONSTRAINT `userpofiledetails_ibfk_4` FOREIGN KEY (`PhoneNumber-CountryID`) REFERENCES `countries` (`CountryID`),
  ADD CONSTRAINT `userpofiledetails_ibfk_5` FOREIGN KEY (`CountryID`) REFERENCES `countries` (`CountryID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`UserRoleID`) REFERENCES `userroles` (`UserRoleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
