-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 03:40 PM
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
(246, 'ZW', 'Zimbabwe', 263, '2021-02-25 18:48:47', 1, '2021-02-25 18:48:47', 1, b'1'),
(247, '', 'ABCDE', 1212, '2021-03-31 10:55:50', 13, '2021-04-06 17:00:33', 1, b'0');

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
  `IsPaid` bit(1) NOT NULL,
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
(2, 64, 10, 6, b'1', '../user/UploadedFiles/Members/6/64/Attachments', b'1', '2021-03-16 21:42:32', b'0', '0.00', 'Cyber Security And Networking', '1', '2021-03-16 21:42:32', 1, '2021-03-16 21:42:32', 1, b'1'),
(3, 61, 6, 6, b'0', NULL, b'0', '2021-03-04 21:04:34', b'1', '50.00', 'Software - Computer', '1', '2021-03-18 10:54:25', 1, '2021-03-18 10:54:25', 1, b'1'),
(11, 61, 6, 10, b'1', '../user/UploadedFiles/Members//11/Attachments', b'1', '2021-03-20 10:47:28', b'1', '50.00', 'Software - Computer', '1', '2021-03-19 11:29:10', 1, '2021-03-20 10:47:28', 1, b'1'),
(13, 61, 6, 10, b'0', NULL, b'0', NULL, b'1', '50.00', 'Hardware - Computer', '1', '2021-03-23 18:50:49', 1, '2021-03-23 18:50:49', 1, b'1'),
(23, 66, 7, 9, b'1', '../user/UploadedFiles/Members/7/66/Attachments', b'1', '2021-03-27 14:58:00', b'0', '0.00', 'U7 commerce', '4', '2021-03-27 14:48:48', 1, '2021-03-27 14:58:00', 1, b'1'),
(24, 67, 9, 7, b'1', '../user/UploadedFiles/Members/9/67/Attachments', b'1', '2021-03-27 15:04:01', b'1', '50.00', 'U9 Arts', '3', '2021-03-27 15:02:00', 1, '2021-03-27 15:04:01', 1, b'1'),
(25, 66, 7, 6, b'1', '../user/UploadedFiles/Members/7/66/Attachments', b'1', '2021-03-27 17:08:19', b'0', '0.00', 'U7 commerce', '4', '2021-03-27 17:08:19', 1, '2021-03-27 17:08:19', 1, b'1'),
(26, 67, 9, 6, b'1', NULL, b'0', NULL, b'1', '50.00', 'U9 Arts', '3', '2021-03-27 17:08:44', 1, '2021-03-27 17:08:44', 1, b'1'),
(27, 55, 6, 9, b'1', NULL, b'0', NULL, b'1', '100.00', 'Computer Seventh Edition', '2', '2021-03-27 17:13:17', 1, '2021-03-27 17:13:17', 1, b'1'),
(28, 58, 6, 9, b'1', '../user/UploadedFiles/Members/6/58/Attachments', b'1', '2021-03-27 17:13:34', b'0', '0.00', 'Artificial Intelligence', '2', '2021-03-27 17:13:34', 1, '2021-03-27 17:13:34', 1, b'1'),
(29, 64, 10, 9, b'1', '../user/UploadedFiles/Members/10/64/Attachments', b'1', '2021-03-27 17:14:50', b'0', '0.00', 'Cyber Security And Networking', '1', '2021-03-27 17:14:50', 1, '2021-03-27 17:14:50', 1, b'1'),
(30, 56, 6, 6, b'1', '../user/UploadedFiles/Members/6/56/Attachments', b'1', '2021-04-10 13:03:43', b'0', '0.00', 'The Principle of Computer Hardware', '1', '2021-04-10 13:03:43', 1, '2021-04-10 13:03:43', 1, b'1'),
(31, 58, 6, 6, b'1', '../user/UploadedFiles/Members/6/58/Attachments', b'1', '2021-04-10 18:06:17', b'0', '0.00', 'Artificial Intelligence', '2', '2021-04-10 18:06:17', 1, '2021-04-10 18:06:17', 1, b'1'),
(32, 70, 6, 6, b'1', '../user/UploadedFiles/Members/6/70/Attachments', b'1', '2021-04-16 13:09:03', b'1', '12.00', 'Final note', '7', '2021-04-10 18:52:28', 1, '2021-04-16 13:09:03', 1, b'1');

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
(1, 'IT', 'Category 1', '2021-02-26 17:20:26', 1, '2021-02-26 17:20:26', 1, b'1'),
(2, 'CA', 'Category 2', '2021-02-26 17:23:59', 1, '2021-02-26 17:23:59', 1, b'1'),
(3, 'CS', 'Category 3', '2021-02-26 17:25:01', 1, '2021-02-26 17:25:01', 1, b'1'),
(4, 'MBA', 'Category 4', '2021-02-26 17:25:51', 1, '2021-02-26 17:25:51', 1, b'1'),
(5, 'Arts', 'Category 5', '2021-03-31 11:48:34', 13, '2021-03-31 11:48:34', 13, b'1'),
(6, 'BA', 'Category 6', '2021-03-31 11:52:13', 13, '2021-03-31 11:52:13', 13, b'1'),
(7, 'Skills', 'Category 7  ', '2021-04-06 10:53:41', 24, '2021-04-06 16:31:41', 1, b'0');

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
(38, 6, 5, 24, 'bad content', NULL, 'Computer Operating System', 2, '../user/UploadedFiles/Members/6/38/DP_Note_38.png', 2, 20, 'Demo', 'University Of Afgan', 3, 'MS-CS', 'C002', 'Mr.Abc', 1, '0.00', '../user/UploadedFiles/Members/6/38/NP_Note_38.pdf', '2021-03-02 11:57:06', 6, '2021-04-03 22:35:59', 24, b'1'),
(53, 6, 4, 1, NULL, NULL, 'Computer Science', 1, '../user/UploadedFiles/Members/6/53/DP_Note_53.png', 3, 100, 'It is great.', 'University Of California', 245, 'Science', 'C003', 'Mr.Xyz', 2, '12.00', '../user/UploadedFiles/Members/6/53/NP_Note_53.pdf', '2021-03-02 13:50:08', 6, '2021-04-10 13:16:40', 1, b'1'),
(54, 6, 2, 1, NULL, NULL, 'Basic Tech India Publication', 4, '../user/UploadedFiles/Members/6/54/DP_Note_54.png', 1, 120, 'It is awesome', 'University Of California', 245, 'Science', 'C004', 'Mr.Abc', 1, '0.00', '../user/UploadedFiles/Members/6/54/NP_Note_54.pdf', '2021-03-02 13:55:03', 6, '2021-02-01 13:55:03', 6, b'1'),
(55, 6, 4, 1, NULL, '2021-01-04 22:01:38', 'Computer Seventh Edition', 2, '../user/UploadedFiles/Members/6/55/DP_Note_55.png', 2, 204, 'It is good', 'Indain institution', 101, 'Computer', 'C001', 'Mr.Xyz', 2, '100.00', '../user/UploadedFiles/Members/6/55/NP_Note_55.pdf', '2021-03-02 13:57:42', 6, '2021-03-02 13:57:42', 6, b'1'),
(56, 6, 4, 1, NULL, '2021-03-01 22:01:50', 'The Principle of Computer Hardware', 1, '../user/UploadedFiles/Members/6/56/DP_Note_56.png', 1, 50, 'It is awesome', 'University Of California', 245, 'MS-CE', 'C002', 'Mr.Abc', 1, '0.00', '../user/UploadedFiles/Members/6/56/NP_Note_56.pdf', '2021-03-02 14:12:30', 6, '2021-03-02 14:12:30', 6, b'1'),
(58, 6, 4, 1, NULL, '2021-03-17 22:02:00', 'Artificial Intelligence', 2, '../user/UploadedFiles/Members/6/58/DP_Note_58.png', 3, 111, 'Final Edition', 'Indain institution', 101, 'Master', 'C003', 'Mr.Xyz', 1, '0.00', '../user/UploadedFiles/Members/6/58/NP_Note_58.pdf', '2021-03-02 14:36:52', 6, '2021-03-02 14:36:52', 6, b'1'),
(59, 6, 4, 1, NULL, '2021-03-02 22:02:07', 'Machine Learning', 2, '../user/UploadedFiles/Members/6/59/DP_Note_59.png', 3, 40, 'Important for exams', 'University Of California', 245, 'Science', 'C004', 'Mr.Abc', 2, '51.00', '../user/UploadedFiles/Members/6/59/NP_Note_59.pdf', '2021-03-02 14:38:54', 6, '2021-03-02 14:38:54', 6, b'1'),
(60, 6, 4, 1, NULL, '2020-12-02 22:02:19', 'Hardware - Computer', 3, '../user/UploadedFiles/Members/6/60/DP_Note_60.png', 1, 180, 'It is great', 'University Of Afgan', 101, 'com', 'C001', 'Mr.Xyz', 1, '0.00', '../user/UploadedFiles/Members/6/60/NP_Note_60.pdf', '2021-03-02 14:41:40', 6, '2021-04-10 10:43:20', 1, b'1'),
(61, 6, 4, 1, NULL, '2021-03-15 14:50:31', 'Software - Computer', 1, '../user/UploadedFiles/Members/6/61/DP_Note_61.png', 2, 230, 'It is an imp.', 'University Of Afgan', 101, 'Networking', 'C002', 'Mr.Abc', 2, '50.00', '../user/UploadedFiles/Members/6/61/NP_Note_61.pdf', '2021-03-02 14:45:34', 6, '2021-03-02 14:45:34', 6, b'1'),
(62, 10, 5, 1, 'not proper data', NULL, 'Computer Network ', 2, '../user/UploadedFiles/Members/10/62/DP_Note_62.png', 2, 100, 'It is very good.', 'Indain institution', 101, 'MS-CS', 'C001', 'Mr. Xyz', 2, '15.00', '../user/UploadedFiles/Members/10/62/NP_Note_62.pdf', '2021-03-02 14:55:15', 10, '2021-04-03 22:33:26', 24, b'1'),
(63, 10, 4, 1, NULL, '2021-03-15 14:51:12', 'The Principle of Deep Learning', 4, '../user/UploadedFiles/Members/10/63/DP_Note_63.png', 1, 450, 'It is awesome.', 'Oxford', 240, 'Science', 'C003', 'Mr.Xyz', 2, '12.00', '../user/UploadedFiles/Members/10/63/NP_Note_63.pdf', '2021-03-02 14:59:47', 10, '2021-03-02 14:59:47', 10, b'1'),
(64, 10, 6, 1, 'not proper data', '2021-03-01 21:04:34', 'Cyber Security And Networking', 1, '../user/UploadedFiles/Members/10/64/DP_Note_64.png', 3, 300, 'It is helpful.', 'Indain institution', 101, 'Commerce', 'C004', '', 1, '0.00', '../user/UploadedFiles/Members/10/64/NP_Note_64.pdf', '2021-03-11 20:09:42', 10, '2021-03-11 20:09:42', 10, b'1'),
(65, 7, 3, 1, NULL, NULL, 'U7 com', 4, '../user/UploadedFiles/Members/7/65/DP_Note_65.png', 2, 170, 'Relating to COM', 'Indain institution', 101, 'MA', 'C007', 'Mr. Xyz', 1, '0.00', '../user/UploadedFiles/Members/7/65/NP_Note_65.pdf', '2021-03-27 14:01:44', 7, '2021-04-05 13:08:14', 24, b'1'),
(66, 7, 4, 1, NULL, '2021-03-27 14:47:09', 'U7 commerce', 4, '../user/UploadedFiles/Members/7/66/DP_Note_66.png', 2, 70, 'Relating to CA', 'Indain institution', 101, 'MBA', 'C007', 'Mr. Xyz', 1, '0.00', '../user/UploadedFiles/Members/7/66/NP_Note_66.pdf', '2021-03-27 14:02:20', 7, '2021-04-05 13:08:14', 24, b'1'),
(67, 9, 4, 1, NULL, '2021-03-26 14:47:47', 'U9 Arts', 3, '../user/UploadedFiles/Members/9/67/DP_Note_67.jpg', 3, 150, 'Arts related', 'USA College', 228, 'Arts ', 'C009', 'Mr.Abc', 2, '50.00', '../user/UploadedFiles/Members/9/67/NP_Note_67.pdf', '2021-03-27 14:31:54', 9, '2021-03-27 14:31:54', 9, b'1'),
(68, 9, 1, 1, NULL, NULL, 'U9 Information Technology', 1, '../user/UploadedFiles/Members/9/68/DP_Note_68.png', 1, 100, 'Useful in IT', 'London university', 210, 'CE', 'C009', 'Mr. Xyz', 1, '0.00', '../user/UploadedFiles/Members/9/68/NP_Note_68.pdf', '2021-03-27 14:34:35', 9, '2021-03-27 14:34:35', 9, b'1'),
(69, 6, 4, 1, NULL, NULL, 'Path Checking', 2, '../user/UploadedFiles/Members/6/69/DP_Note_69.png', 1, 100, '                   path                 ', '', NULL, '', '', '', 1, '0.00', '../user/UploadedFiles/Members/6/69/NP_Note_69.pdf', '2021-04-10 16:46:19', 6, '2021-04-10 16:46:19', 6, b'1'),
(70, 6, 4, 1, NULL, NULL, 'Final note', 7, '../user/UploadedFiles/Members/6/70/DP_Note_70.png', 1, 200, 'Final note for desc', 'Indain institution', 101, 'MS-CS', 'C002', 'Mr. Xyz', 2, '12.00', '../user/UploadedFiles/Members/6/70/NP_Note_70.pdf', '2021-04-10 18:46:27', 6, '2021-04-10 18:46:27', 6, b'1');

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
(48, 62, 'UN_1_User_10_Note_62.pdf', '../user/UploadedFiles/Members/10/62/Attachments/UN_1_User_10_Note_62.pdf', '2021-03-05 17:58:21', 10, '2021-03-05 17:58:21', 10, b'1'),
(49, 62, 'UN_2_User_10_Note_62.pdf', '../user/UploadedFiles/Members/10/62/Attachments/UN_2_User_10_Note_62.pdf', '2021-03-05 17:58:21', 10, '2021-03-05 17:58:21', 10, b'1'),
(50, 64, 'UN_1_User_10_Note_64.pdf', '../user/UploadedFiles/Members/10/64/Attachments/UN_1_User_10_Note_64.pdf', '2021-03-11 20:09:42', 1, '2021-03-11 20:09:42', 1, b'1'),
(51, 61, 'UN_1_User_6_Note_61.pdf', '../user/UploadedFiles/Members/6/61/Attachments/UN_1_User_6_Note_61.pdf', '2021-03-14 11:34:05', 1, '2021-03-14 11:34:05', 1, b'1'),
(52, 38, 'UN_1_User_6_Note_38.pdf', '../user/UploadedFiles/Members/6/38/Attachments/UN_1_User_6_Note_38.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(53, 38, 'UN_2_User_6_Note_38.pdf', '../user/UploadedFiles/Members/6/38/Attachments/UN_2_User_6_Note_38.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(54, 53, 'UN_1_User_6_Note_53.pdf', '../user/UploadedFiles/Members/6/53/Attachments/UN_1_User_6_Note_53.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(55, 53, 'UN_2_User_6_Note_53.pdf', '../user/UploadedFiles/Members/6/53/Attachments/UN_2_User_6_Note_53.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(56, 54, 'UN_1_User_6_Note_54.pdf', '../user/UploadedFiles/Members/6/54/Attachments/UN_1_User_6_Note_54.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(57, 54, 'UN_2_User_6_Note_54.pdf', '../user/UploadedFiles/Members/6/54/Attachments/UN_2_User_6_Note_54.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(58, 55, 'UN_1_User_6_Note_55.pdf', '../user/UploadedFiles/Members/6/55/Attachments/UN_1_User_6_Note_55.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(59, 55, 'UN_2_User_6_Note_55.pdf', '../user/UploadedFiles/Members/6/55/Attachments/UN_2_User_6_Note_55.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(60, 56, 'UN_1_User_6_Note_56.pdf', '../user/UploadedFiles/Members/6/56/Attachments/UN_1_User_6_Note_56.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(61, 56, 'UN_2_User_6_Note_56.pdf', '../user/UploadedFiles/Members/6/56/Attachments/UN_2_User_6_Note_56.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(62, 58, 'UN_1_User_6_Note_58.pdf', '../user/UploadedFiles/Members/6/58/Attachments/UN_1_User_6_Note_58.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(63, 58, 'UN_2_User_6_Note_58.pdf', '../user/UploadedFiles/Members/6/58/Attachments/UN_2_User_6_Note_58.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(64, 59, 'UN_1_User_6_Note_59.pdf', '../user/UploadedFiles/Members/6/59/Attachments/UN_1_User_6_Note_59.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(65, 60, 'UN_1_User_6_Note_60.pdf', '../user/UploadedFiles/Members/6/60/Attachments/UN_1_User_6_Note_60.pdf', '2021-03-10 22:49:16', 6, '2021-03-08 22:49:16', 6, b'1'),
(66, 63, 'UN_1_User_10_Note_63.pdf', '../user/UploadedFiles/Members/10/63/Attachments/UN_1_User_10_Note_63.pdf', '2021-03-09 23:07:24', 10, '2021-03-09 23:07:24', 10, b'1'),
(67, 63, 'UN_2_User_10_Note_63.pdf', '../user/UploadedFiles/Members/10/63/Attachments/UN_2_User_10_Note_63.pdf', '2021-03-09 23:07:24', 10, '2021-03-09 23:07:24', 10, b'1'),
(68, 65, 'UN_1_User_7_Note_65.pdf', '../user/UploadedFiles/Members/7/65/Attachments/UN_1_User_7_Note_65.pdf', '2021-03-27 14:01:44', 1, '2021-03-27 14:01:44', 1, b'1'),
(69, 65, 'UN_2_User_7_Note_65.pdf', '../user/UploadedFiles/Members/7/65/Attachments/UN_2_User_7_Note_65.pdf', '2021-03-27 14:01:45', 1, '2021-03-27 14:01:45', 1, b'1'),
(70, 65, 'UN_3_User_7_Note_65.pdf', '../user/UploadedFiles/Members/7/65/Attachments/UN_3_User_7_Note_65.pdf', '2021-03-27 14:01:45', 1, '2021-03-27 14:01:45', 1, b'1'),
(71, 66, 'UN_1_User_7_Note_66.pdf', '../user/UploadedFiles/Members/7/66/Attachments/UN_1_User_7_Note_66.pdf', '2021-03-27 14:02:21', 1, '2021-03-27 14:02:21', 1, b'1'),
(72, 66, 'UN_2_User_7_Note_66.pdf', '../user/UploadedFiles/Members/7/66/Attachments/UN_2_User_7_Note_66.pdf', '2021-03-27 14:02:21', 1, '2021-03-27 14:02:21', 1, b'1'),
(73, 66, 'UN_3_User_7_Note_66.pdf', '../user/UploadedFiles/Members/7/66/Attachments/UN_3_User_7_Note_66.pdf', '2021-03-27 14:02:21', 1, '2021-03-27 14:02:21', 1, b'1'),
(74, 67, 'UN_1_User_9_Note_67.pdf', '../user/UploadedFiles/Members/9/67/Attachments/UN_1_User_9_Note_67.pdf', '2021-03-27 14:31:55', 1, '2021-03-27 14:31:55', 1, b'1'),
(75, 67, 'UN_2_User_9_Note_67.pdf', '../user/UploadedFiles/Members/9/67/Attachments/UN_2_User_9_Note_67.pdf', '2021-03-27 14:31:55', 1, '2021-03-27 14:31:55', 1, b'1'),
(76, 68, 'UN_1_User_9_Note_68.pdf', '../user/UploadedFiles/Members/9/68/Attachments/UN_1_User_9_Note_68.pdf', '2021-03-27 14:34:35', 1, '2021-03-27 14:34:35', 1, b'1'),
(77, 69, 'UN_1_User_6_Note_69.pdf', '../user/UploadedFiles/Members/6/69/Attachments/UN_1_User_6_Note_69.pdf', '2021-04-10 16:46:19', 1, '2021-04-10 16:46:19', 1, b'1'),
(78, 70, 'UN_1_User_6_Note_70.pdf', '../user/UploadedFiles/Members/6/70/Attachments/UN_1_User_6_Note_70.pdf', '2021-04-10 18:46:28', 1, '2021-04-10 18:46:28', 1, b'1'),
(79, 70, 'UN_2_User_6_Note_70.pdf', '../user/UploadedFiles/Members/6/70/Attachments/UN_2_User_6_Note_70.pdf', '2021-04-10 18:46:28', 1, '2021-04-10 18:46:28', 1, b'1');

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

--
-- Dumping data for table `notesreportedissues`
--

INSERT INTO `notesreportedissues` (`NotesReportedIssuesID`, `NoteDetailID`, `ReportedByID`, `AgainstDownloadID`, `Remarks`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 61, 10, 3, 'not good', '2021-03-21 00:03:08', 1, '2021-03-21 00:03:08', 1, b'1'),
(6, 67, 7, 24, 'Not Good', '2021-03-27 15:05:01', 1, '2021-03-27 15:05:01', 1, b'1'),
(7, 64, 9, 2, 'bad', '2021-03-27 17:15:14', 1, '2021-03-27 17:15:14', 1, b'1');

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

--
-- Dumping data for table `notesreviews`
--

INSERT INTO `notesreviews` (`NotesReviewID`, `NoteDetailID`, `ReviewedByID`, `AgainstDownloadsID`, `Ratings`, `Comments`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(2, 61, 10, 3, '3.48', 'it is great.', '2021-03-20 22:31:59', 1, '2021-03-20 22:31:59', 1, b'1'),
(3, 61, 6, 3, '1.93', 'important', '2021-03-22 22:36:18', 1, '2021-03-22 22:36:18', 1, b'1'),
(7, 66, 9, 23, '3.60', 'Very Good', '2021-03-27 14:56:14', 1, '2021-03-27 14:56:14', 1, b'1'),
(8, 58, 9, 28, '2.81', 'Great', '2021-03-27 17:14:11', 1, '2021-03-27 17:14:11', 1, b'1'),
(9, 70, 6, 32, '3.46', 'good', '2021-04-10 18:53:43', 1, '2021-04-10 18:53:43', 1, b'1');

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
(1, 'Handwritten', 'Type 1', '2021-02-26 17:35:48', 1, '2021-02-26 17:35:48', 1, b'1'),
(2, 'Story Book', 'Type 2', '2021-02-26 17:38:38', 1, '2021-02-26 17:38:38', 1, b'1'),
(3, 'University Note', 'Type 3', '2021-02-26 17:39:17', 1, '2021-02-26 17:39:17', 1, b'1'),
(4, 'Novel', 'Type 4', '2021-03-31 11:14:21', 13, '2021-03-31 11:14:21', 13, b'1'),
(5, 'Dairy', 'Type 5', '2021-04-06 21:43:39', 0, '2021-04-06 21:43:39', 0, b'1'),
(6, 'DairyBook', ' Type 51', '2021-04-06 21:46:22', 24, '2021-04-06 22:02:32', 24, b'0');

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
(13, '5', '5', 'Ratings', '2021-02-28 10:57:19', 1, '2021-02-28 10:57:19', 1, b'1'),
(14, 'Male', '1', 'Gender', '2021-03-09 11:21:16', 1, '2021-03-09 11:21:16', 1, b'1'),
(15, 'Female', '2', 'Gender', '2021-03-09 11:22:23', 1, '2021-03-09 11:22:23', 1, b'1');

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

--
-- Dumping data for table `systemconfiguration`
--

INSERT INTO `systemconfiguration` (`SystemConfigurationID`, `Key`, `Value`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'DefaultDisplayPicture', '../common/Default/DefaultDisplayPic.png', '2021-03-15 11:33:42', 1, '2021-04-07 19:38:15', 1, b'1'),
(2, 'SupportEmail', 'gargi.notemarketplace@gmail.com', '2021-04-07 16:43:24', 1, '2021-04-07 18:41:11', 1, b'1'),
(3, 'SupportPhoneNo', '+91 90xxx 51xxx', '2021-04-07 17:29:31', 1, '2021-04-07 17:29:31', 1, b'1'),
(4, 'EmailForNotification', 'gargi.notemarketplace@gmail.com', '2021-04-07 17:29:31', 1, '2021-04-07 18:41:11', 1, b'1'),
(5, 'FacebookUrl', 'http://www.facebook.com', '2021-04-07 17:38:36', 1, '2021-04-08 15:47:40', 1, b'1'),
(6, 'TwitterUrl', 'http://www.twitter.com', '2021-04-07 17:38:36', 1, '2021-04-08 15:47:40', 1, b'1'),
(7, 'LinkdinUrl', 'https://in.linkedin.com', '2021-04-07 17:38:36', 1, '2021-04-08 15:47:40', 1, b'1'),
(8, 'DefaultProfilePicture', '../common/Default/DefaultProfilePic.png', '2021-04-07 18:46:04', 1, '2021-04-07 19:38:15', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `userprofiledetails`
--

CREATE TABLE `userprofiledetails` (
  `UserProfileDetailID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DOB` date DEFAULT NULL,
  `GenderID` int(11) DEFAULT NULL,
  `SecondaryEmailAddress` varchar(100) DEFAULT NULL,
  `PhoneNumber_CountryID` int(11) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `ProfilePicture` varchar(500) DEFAULT NULL,
  `AddressLine1` varchar(100) DEFAULT NULL,
  `AddressLine2` varchar(100) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `ZipCode` varchar(50) DEFAULT NULL,
  `CountryID` int(11) DEFAULT NULL,
  `University` varchar(100) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprofiledetails`
--

INSERT INTO `userprofiledetails` (`UserProfileDetailID`, `UserID`, `DOB`, `GenderID`, `SecondaryEmailAddress`, `PhoneNumber_CountryID`, `PhoneNumber`, `ProfilePicture`, `AddressLine1`, `AddressLine2`, `City`, `State`, `ZipCode`, `CountryID`, `University`, `College`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(9, 10, '0000-00-00', 0, NULL, 1, '9876543210', '../user/UploadedFiles/Members/10/PP_9.png', '15, bunglows', 'road', 'ahm', 'guj', '3800', 101, NULL, 'coll', '2021-03-11 22:04:00', 10, '2021-04-05 18:35:33', 1, b'1'),
(16, 6, '2021-03-01', 2, NULL, 2, '7654321890', '../user/UploadedFiles/Members/6/PP_16.png', '13,Apart', 'Highway', 'vado', 'Mumbai', '830098', 18, 'univer', 'colleg', '2021-03-12 11:41:59', 6, '2021-04-05 18:35:33', 1, b'1'),
(21, 7, '2019-07-01', 1, NULL, 3, '1234567890', '../user/UploadedFiles/Members/7/PP_21.png', 'B-14', 'Bunglows', 'Surat', 'Guj', '3898', 101, 'Uni of ISC', 'Coll of ISC', '2021-03-27 13:32:09', 7, '2021-04-05 18:35:33', 1, b'1'),
(24, 9, '2018-06-05', 2, NULL, 4, '4532167891', '../user/UploadedFiles/Members/9/PP_24.png', 'A-14', 'Bunglows', 'Surat', 'Guj', '3898', 101, 'uni', 'coll', '2021-03-27 14:18:09', 9, '2021-04-05 18:35:33', 1, b'1'),
(25, 13, NULL, NULL, 'ga@ga.com', 6, '5432167890', '../admin/UploadedFiles/Admin/13/PP_25.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-30 18:33:13', 1, '2021-04-05 19:42:00', 1, b'1'),
(27, 24, NULL, NULL, '', 1, '8345671901', '../admin/UploadedFiles/Admin/24/PP_27.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 14:22:35', 1, '2021-04-05 18:35:33', 1, b'1'),
(28, 25, NULL, NULL, 'qq@qq.com', 3, '3532167891', '../admin/UploadedFiles/Admin/25/PP_28.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 14:25:29', 1, '2021-04-06 16:14:21', 1, b'0'),
(29, 8, '2017-05-24', 1, NULL, 14, '3214567890', '../user/UploadedFiles/Members/8/PP_29.png', 'C-13,', 'Bunglows', 'ahmedabad', 'guj', '98765', 85, 'nirma', '', '2021-04-08 13:02:20', 8, '2021-04-08 13:02:20', 8, b'1'),
(30, 1, NULL, NULL, '', 1, '8345671901', '../admin/UploadedFiles/Admin/1/PP_30.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-31 14:22:35', 1, '2021-04-05 18:35:33', 1, b'1'),
(38, 23, '2020-08-05', NULL, NULL, 8, '9876567890', '../user/UploadedFiles/Members/23/PP_38.png', 'C-13,', 'Bunglows', 'ahmedabad', 'guj', '98765', 85, '', '', '2021-04-16 19:47:48', 23, '2021-04-16 19:47:48', 23, b'1');

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
(1, 3, 'SuperAdminA', 'SurNameA', 'gargipatel@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-23 18:16:23', 1, '2021-04-05 18:35:32', 1, b'1'),
(6, 1, 'UserB', 'SurNameB', 'gargipatel2309@gmail.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-24 01:06:23', 1, '2021-04-05 18:35:32', 1, b'1'),
(7, 1, 'UserC', 'SurNameC', 'c@c.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-24 01:07:02', 1, '2021-04-05 18:35:32', 1, b'1'),
(8, 1, 'UserD', 'SurNameD', 'd@d.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-24 10:14:35', 1, '2021-04-05 18:35:32', 1, b'1'),
(9, 1, 'UserE', 'SurNameE', 'e@e.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-24 15:45:07', 1, '2021-04-05 18:35:32', 1, b'1'),
(10, 1, 'UserF', 'SurNameF', 'f@f.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-25 13:03:52', 1, '2021-04-05 18:35:32', 1, b'1'),
(13, 2, 'UserG', 'SurNameG', 'aa@aa.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-25 14:02:55', 1, '2021-04-05 19:42:00', 1, b'1'),
(14, 1, 'UserH', 'SurNameH', 'h@h.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:05:45', 1, '2021-04-05 18:35:32', 1, b'1'),
(15, 1, 'UserI', 'SurNameI', 'i@i.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:07:10', 1, '2021-04-05 18:35:32', 1, b'1'),
(18, 1, 'UserJ', 'SurNameJ', 'j@j.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:18:07', 1, '2021-04-05 18:35:32', 1, b'1'),
(19, 1, 'UserK', 'SurNameK', 'k@k.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:23:07', 1, '2021-04-05 18:35:32', 1, b'1'),
(20, 1, 'UserL', 'SurNameL', 'l@l.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 14:30:24', 1, '2021-04-05 18:35:32', 1, b'1'),
(21, 1, 'UserM', 'SurNameM', 'm@m.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-25 14:32:43', 1, '2021-04-05 18:35:32', 1, b'1'),
(22, 1, 'UserN', 'SurNameN', 'n@n.com', '70b4269b412a8af42b1f7b0d26eceff2', b'0', '2021-02-25 15:55:11', 1, '2021-04-05 18:35:32', 1, b'1'),
(23, 1, 'abc', 'Patel', 'o@o.com', '70b4269b412a8af42b1f7b0d26eceff2', b'1', '2021-02-25 16:02:11', 1, '2021-04-05 18:35:32', 1, b'1'),
(24, 2, 'UserP', 'SurNameP', 'p@p.com', '4de93544234adffbb681ed60ffcfb941', b'1', '2021-03-31 14:22:35', 13, '2021-04-05 19:00:40', 1, b'1'),
(25, 2, 'USERQ', 'SurNameQ', 'q@q.com', '4de93544234adffbb681ed60ffcfb941', b'1', '2021-03-31 14:25:29', 13, '2021-04-06 16:14:21', 1, b'0'),
(26, 1, 'Shiva', 'Patel', 'patelgargi7560@gmail.com', 'd5f7b68ba6682a691cb19351685f3757', b'1', '2021-04-15 16:26:17', 1, '2021-04-15 16:26:17', 1, b'1');

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
-- Indexes for table `userprofiledetails`
--
ALTER TABLE `userprofiledetails`
  ADD PRIMARY KEY (`UserProfileDetailID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CountryID` (`CountryID`),
  ADD KEY `PhoneNumber_CountryID` (`PhoneNumber_CountryID`);

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
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `downloadnotes`
--
ALTER TABLE `downloadnotes`
  MODIFY `DownloadNoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notecategories`
--
ALTER TABLE `notecategories`
  MODIFY `NoteCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notedetails`
--
ALTER TABLE `notedetails`
  MODIFY `NoteDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `notesattachments`
--
ALTER TABLE `notesattachments`
  MODIFY `NotesAttachmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `notesreportedissues`
--
ALTER TABLE `notesreportedissues`
  MODIFY `NotesReportedIssuesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notesreviews`
--
ALTER TABLE `notesreviews`
  MODIFY `NotesReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notetypes`
--
ALTER TABLE `notetypes`
  MODIFY `NoteTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `ReferenceDataID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `systemconfiguration`
--
ALTER TABLE `systemconfiguration`
  MODIFY `SystemConfigurationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userprofiledetails`
--
ALTER TABLE `userprofiledetails`
  MODIFY `UserProfileDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `UserRoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
-- Constraints for table `userprofiledetails`
--
ALTER TABLE `userprofiledetails`
  ADD CONSTRAINT `userprofiledetails_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `userprofiledetails_ibfk_5` FOREIGN KEY (`CountryID`) REFERENCES `countries` (`CountryID`),
  ADD CONSTRAINT `userprofiledetails_ibfk_6` FOREIGN KEY (`PhoneNumber_CountryID`) REFERENCES `countries` (`CountryID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`UserRoleID`) REFERENCES `userroles` (`UserRoleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
